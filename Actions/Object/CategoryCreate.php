<?php

namespace Modules\FinanceCategoryMod\Actions\Object;

use Modules\FinanceCategoryMod\Entities\Category;

/**
 * Store a new Category
 */
class CategoryCreate
{
    private Category $category;

    public function run()
    {
        return $this->category->save();
    }

    /**
     * @param Category $category
     * @return void
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
}
