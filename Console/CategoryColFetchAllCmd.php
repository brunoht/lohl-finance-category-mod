<?php

namespace Modules\FinanceCategoryMod\Console;

use Illuminate\Console\Command;
use Modules\App\Helpers\Command\CollectionListHandler;
use Modules\FinanceCategoryMod\Actions\Collection\CategoryFecthAll;
use Symfony\Component\Console\Input\InputOption;

class CategoryColFetchAllCmd extends Command
{
    use CollectionListHandler;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'finance:category-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all stored Categories.';

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
        $action = new CategoryFecthAll();
        $this->listHandler( $action->run() );
        return 0;
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
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
