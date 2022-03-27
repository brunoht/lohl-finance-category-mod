<?php

namespace Modules\FinanceCategoryMod\Console;

use Illuminate\Console\Command;
use Modules\FinanceCategoryMod\Actions\Bulk\CategoryBulkDelete;
use Symfony\Component\Console\Input\InputOption;

class CategoryBulkDeleteCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'finance:category-bulk-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all stored Categories.';

    /**
     * @var CategoryBulkDelete
     */
    private CategoryBulkDelete $categoryBulkDelete;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryBulkDelete $categoryBulkDelete)
    {
        parent::__construct();
        $this->categoryBulkDelete = $categoryBulkDelete;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->categoryBulkDelete->run();
        $this->info('SUCCESS');
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
