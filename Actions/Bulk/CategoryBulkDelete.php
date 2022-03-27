<?php

namespace Modules\FinanceCategoryMod\Actions\Bulk;

use Modules\FinanceCategoryMod\Entities\Category;

/**
 * Delete all stored Categories
 */
class CategoryBulkDelete
{
    public function run()
    {
        Category::truncate();
    }
}
