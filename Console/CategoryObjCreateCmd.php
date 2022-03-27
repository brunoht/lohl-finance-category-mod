<?php

namespace Modules\FinanceCategoryMod\Console;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Modules\App\Helpers\Command\InputValidator;
use Modules\App\Helpers\Command\MenuCreateUpdate;
use Modules\FinanceCategoryMod\Entities\Category;
use Symfony\Component\Console\Input\InputOption;
use Modules\FinanceCategoryMod\Actions\Object\CategoryCreate;

class CategoryObjCreateCmd extends Command
{
    use MenuCreateUpdate, InputValidator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'finance:category-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and store a new Category.';

    private $categoryCreate;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryCreate $categoryCreate)
    {
        parent::__construct();
        $this->categoryCreate = $categoryCreate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $create = function ( $category ) {
            try {
                $this->categoryCreate->setCategory($category);
                $this->categoryCreate->run();
                $category->printAttributes();
                $this->info('[ SUCCESS ] SUCCESSFULLY CREATED');
            } catch (QueryException $e) {
                if ( $e->getCode() === '23505' ) $this->error('[ ERROR ] ALREADY EXISTS');
                else dd( $e );
            }
        };

        $this->menu( Category::getInstance(), $create );
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
