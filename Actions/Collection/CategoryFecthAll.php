<?php

namespace Modules\FinanceCategoryMod\Actions\Collection;

use Illuminate\Database\Eloquent\Collection;
use Modules\FinanceCategoryMod\Entities\Category;

/**
 * Fetch all stored Categories
 */
class CategoryFecthAll
{
    public function run() : Collection
    {
        return Category::all()->sortBy('id');
    }
}
