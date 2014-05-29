<?php

class UsersController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    /**
     * getLogin
     */
    public function getLogin()
    {
        return View::make('users.login');
    }

    /**
     * postSignin
     */
    public function postSignin()
    {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            return Redirect::to('profile')
                ->with('flash_notice', 'You have successfully logged in.');
        }
        return Redirect::to('users/login')
            ->with('flash_error', 'Your username/password combination was incorrect!')
            ->withInput();
    }

    /**
     * getLogout
     */
    public function getLogout()
    {
        Auth::logout();

        return Redirect::to('/')
            ->with('flash_notice', "You have successfully logged out.");
    }
}
