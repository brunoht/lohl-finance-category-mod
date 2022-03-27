<?php

namespace Modules\FinanceCategoryMod\Actions\Object;

use Modules\FinanceCategoryMod\Entities\Category;

/**
 * Update a stored Category by its ID
 */
class CategoryUpdate
{
    private Category $category;

    public function run()
    {
        $this->category->save();
        return $this->category;
    }

    /**
     * @param Category $category
     * @return void
     */
    public function setCategory( Category $category ) : void
    {
        $this->category = $category;
    }
}
