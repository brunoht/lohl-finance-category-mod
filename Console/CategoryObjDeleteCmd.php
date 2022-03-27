<?php

namespace Modules\FinanceCategoryMod\Console;

use Illuminate\Console\Command;
use Modules\FinanceCategoryMod\Actions\Object\CategoryDelete;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CategoryObjDeleteCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'finance:category-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a stored Category.';

    /**
     * Create a new command instance.
     *
     * @return void
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
    public function handle()
    {
        try {
            $action = new CategoryDelete();
            $action->setId( $this->argument('category-id') );
            $action->run();
            $this->info('SUCCESS');
        } catch (\Error $e) {
            $this->error('[ ERROR ] NOT FOUND');
        } finally {
            return 0;
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['category-id', InputArgument::REQUIRED, 'Category ID.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
