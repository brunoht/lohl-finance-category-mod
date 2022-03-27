<?php

namespace Modules\FinanceCategoryMod\Console;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Modules\App\Helpers\Command\InputValidator;
use Modules\App\Helpers\Command\MenuCreateUpdate;
use Modules\FinanceCategoryMod\Actions\Object\CategoryFetch;
use Modules\FinanceCategoryMod\Actions\Object\CategoryUpdate;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CategoryObjUpdateCmd extends Command
{
    use MenuCreateUpdate, InputValidator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'finance:category-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a stored Category.';

    /**
     * @var CategoryFetch
     */
    private $categoryFetch;

    /**
     * @var CategoryUpdate
     */
    private $categoryUpdate;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct (
        CategoryFetch $categoryFetch,
        CategoryUpdate $categoryUpdate
    ) {
        parent::__construct();
        $this->categoryFetch = $categoryFetch;
        $this->categoryUpdate = $categoryUpdate;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : int
    {
        // fetch the Category object
        $this->categoryFetch->setId( $this->argument('category-id') );
        $category = $this->categoryFetch->run();

        // prepare the function to update client
        $store = function ( $category ) {
            try {
                $this->categoryUpdate->setCategory( $category );
                $this->categoryUpdate->run();
                $category->printAttributes();
                $this->info('[ SUCCESS ] SUCCESSFULLY UPDATED');
            } catch (QueryException $e) {
                if ( $e->getCode() === '23505' ) $this->error('[ ERROR ] ALREADY EXISTS');
                else dd( $e );
            }
        };

        // starts the menu on terminal
        return $this->menu( $category, $store );
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
