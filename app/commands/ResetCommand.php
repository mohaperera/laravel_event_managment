<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\BufferedOutput;

class ResetCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tms:reset';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Performs a FULL reset of the TMS. Use with caution!';

    /**
     * Create a new command instance.
     *
     * @return \ResetCommand
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
        $confirm = $this->ask("This command does a FULL system reset. Are you sure? (yes/no) ");

        if ($confirm == 'yes') {
            $this->comment("\nRefreshing database schema");
            $output = new BufferedOutput();
            Artisan::call('migrate:refresh', [], $output);
            $this->info($output->fetch());

            $this->comment("Seeding database");
            $output = new BufferedOutput();
            Artisan::call('db:seed', [], $output);
            $this->info($output->fetch());

            $this->comment("Emptying ./public/assets and ./uploads folders");
            exec('rm -rf ' . base_path() . '/public/assets/*');
            exec('rm -rf ' . base_path() . '/uploads/*');
            $this->info("Done...");
        } else {
            $this->info("Leaving system unchanged.");
        }
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
		return [];
	}
}
