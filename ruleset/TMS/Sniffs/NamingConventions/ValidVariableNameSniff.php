<?php
/**
 * TMS_Sniffs_NamingConventions_ValidVariableNameSniff.
 */

if (class_exists('PHP_CodeSniffer_Standards_AbstractVariableSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_AbstractVariableSniff not found');
}

/**
 * TMS_Sniffs_NamingConventions_ValidVariableNameSniff.
 */
class TMS_Sniffs_NamingConventions_ValidVariableNameSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{
    /**
     * containsUppercase
     */
    protected function containsUppercase($string)
    {
        if (preg_match("/[A-Z]/", $string) === 0) {
            return true;
        }
        return false;
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     */
    protected function processVariable(PHP_CodeSniffer_File $phpcs_file, $stack_ptr)
    {
        $tokens = $phpcs_file->getTokens();
        $var_name = ltrim($tokens[$stack_ptr]['content'], '$');

        $php_reserved_vars =
            ['_SERVER', '_GET', '_POST', '_REQUEST', '_SESSION', '_ENV', '_COOKIE', '_FILES', 'GLOBALS'];

        // If it's a php reserved var, then its ok.
        if (in_array($var_name, $php_reserved_vars) === true) {
            return;
        }

        $obj_operator = $phpcs_file->findNext(array(T_WHITESPACE), ($stack_ptr + 1), null, true);
        if ($tokens[$obj_operator]['code'] === T_OBJECT_OPERATOR) {
            // Check to see if we are using a variable from an object.
            $var = $phpcs_file->findNext(array(T_WHITESPACE), ($obj_operator + 1), null, true);
            if ($tokens[$var]['code'] === T_STRING) {
                // Either a var name or a function call, so check for bracket.
                $bracket = $phpcs_file->findNext(array(T_WHITESPACE), ($var + 1), null, true);

                if ($tokens[$bracket]['code'] !== T_OPEN_PARENTHESIS) {
                    $obj_var_name = $tokens[$var]['content'];

                    if ($this->containsUppercase($obj_var_name) === false) {
                        $error = 'Variable "%s" is not in valid underscore_format';
                        $data = array($obj_var_name);
                        $phpcs_file->addError($error, $var, 'NotUnderscore', $data);
                    } elseif (preg_match('|\d|', $obj_var_name)) {
                        $warning = 'Variable "%s" contains numbers but this is discouraged';
                        $data = array($obj_var_name);
                        $phpcs_file->addWarning($warning, $stack_ptr, 'ContainsNumbers', $data);
                    }
                }
            }
        }

        if (substr($var_name, 0, 1) === '_') {
            $obj_operator = $phpcs_file->findPrevious(array(T_WHITESPACE), ($stack_ptr - 1), null, true);
            if ($tokens[$obj_operator]['code'] === T_DOUBLE_COLON) {
                // The variable lives within a class, and is referenced like
                // this: MyClass::$_variable, so we don't know its scope.
                $in_class = true;
            } else {
                $in_class = $phpcs_file->hasCondition($stack_ptr, array(T_CLASS, T_INTERFACE, T_TRAIT));
            }

            if ($in_class === true) {
                $var_name = substr($var_name, 1);
            }
        }

        if ($this->containsUppercase($var_name) === false) {
            $error = 'Variable "%s" is not in valid underscore_format';
            $data = array($var_name);
            $phpcs_file->addError($error, $stack_ptr, 'NotUnderscore', $data);
        } elseif (preg_match('|\d|', $var_name)) {
            $warning = 'Variable "%s" contains numbers but this is discouraged';
            $data = array($var_name);
            $phpcs_file->addWarning($warning, $stack_ptr, 'ContainsNumbers', $data);
        }
    }

    /**
     * Processes class member variables.
     */
    protected function processMemberVar(PHP_CodeSniffer_File $phpcs_file, $stack_ptr)
    {
        $tokens = $phpcs_file->getTokens();
        $var_name = ltrim($tokens[$stack_ptr]['content'], '$');

        if ($this->containsUppercase($var_name) === false) {
            $error = 'Variable "%s" is not in valid underscore_format';
            $data = array($var_name);
            $phpcs_file->addError($error, $stack_ptr, 'MemberVarNotUnderscore', $data);
        } elseif (preg_match('|\d|', $var_name)) {
            $warning = 'Variable "%s" contains numbers but this is discouraged';
            $data = array($var_name);
            $phpcs_file->addWarning($warning, $stack_ptr, 'MemberVarContainsNumbers', $data);
        }
    }

    /**
     * Processes the variable found within a double quoted string.
     */
    protected function processVariableInString(PHP_CodeSniffer_File $phpcs_file, $stack_ptr)
    {
        $tokens = $phpcs_file->getTokens();
        $php_reserved_vars =
            ['_SERVER', '_GET', '_POST', '_REQUEST', '_SESSION', '_ENV', '_COOKIE', '_FILES', 'GLOBALS'];

        $re = '|[^\\\]\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)|';
        if (preg_match_all($re, $tokens[$stack_ptr]['content'], $matches) !== 0) {
            foreach ($matches[1] as $var_name) {
                // If it's a php reserved var, then its ok.
                if (in_array($var_name, $php_reserved_vars) === true) {
                    continue;
                }

                if ($this->containsUppercase($var_name) === false) {
                    $var_name = $matches[0];
                    $error = 'Variable "%s" is not in valid underscore_format';
                    $data = array($var_name);
                    $phpcs_file->addError($error, $stack_ptr, 'StringVarNotUnderscore', $data);
                } elseif (preg_match('|\d|', $var_name)) {
                    $warning = 'Variable "%s" contains numbers but this is discouraged';
                    $data = array($var_name);
                    $phpcs_file->addWarning($warning, $stack_ptr, 'StringVarContainsNumbers', $data);
                }
            }
        }
    }
}
