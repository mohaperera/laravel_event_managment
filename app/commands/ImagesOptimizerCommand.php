<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImagesOptimizerCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'images:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs image optimization on PNG and JPG images in the given folder.';

    /**
     * Create a new command instance.
     *
     * @return \ImagesOptimizerCommand
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
        $this->info("Optimizing images...");
        $path = $this->option('path');
        ImageOptimizer::optimize($path);
        $this->info("Done...");
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
            ['path', null, InputOption::VALUE_REQUIRED, 'The path containing images to be optimized'],
        ];
    }

}
