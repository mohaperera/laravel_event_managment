<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ParseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tms:parse';

    protected $description = 'Parses the template indicated by the alias argument.';

    private $recipient_name;
    private $recipient_email;

    /**
     * Create a new command instance.
     *
     * @return \ParseCommand
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $alias = $this->option('alias');
        $filename = Config::get('tms.upload_path') . "/{$alias}.7z";

        $template = Template::where('alias', '=', $alias)->first();
        if (is_null($template)) {
            $this->error("The given alias could not be found in the database!");
            return null;
        }

        if (file_exists($filename)) {
            $template->state = 'extracting';
            $template->save();

            $extracted_path = Archive7zHelper::extract($filename);

            $template->state = 'parsing';
            $template->save();

            $psd = new PhotoshopHelper();
            $template->design_data = $psd->parsePath($extracted_path, $alias);
            $template->save();

            // Remove the uploaded archives and it's extracted .PSD files to keep the server clean.
            if (!$this->option('keep')) {
                unlink($filename);
                exec("rm -rf {$extracted_path}");
            }
        } else {
            $template->state = "error";
            $template->save();
            $this->error("The archives associated with the given alias, '{$alias}' does not exist!");
        }

        if (!$this->option('skip-notification')) {
            $template->state = 'notifying';
            $template->save();

            if (!$this->option('notify')) {
                $psd_template = Template::where('alias', '=', $this->option('alias'))->first();
                $this->recipient_email = $psd_template->user->email;
                $this->recipient_name = $psd_template->user->username;
            } else {
                $this->recipient_email = $this->option('notify');
                $this->recipient_name = '';
            }
            $this->sendNotification($template->alias);
        }

        $template->state = 'ready';
        $template->save();

        return null;
    }

    /**
     * Send a notification of processing to the given email address.
     */
    protected function sendNotification($template_alias)
    {
        Mail::send(
            'emails.psd_notification',
            ['template_alias' => $template_alias],
            function ($message) {
                $message
                    ->to($this->recipient_email, $this->recipient_name)
                    ->subject('Your template has been processed!');
            }
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['alias', null, InputOption::VALUE_REQUIRED, 'The alias name is required'],
            ['notify', null, InputOption::VALUE_OPTIONAL, 'The notify option is not required'],
            ['skip-notification', null, InputOption::VALUE_NONE, ''],
            ['keep', null, InputOption::VALUE_NONE, '']
        ];
    }
}
