<?php

namespace Modules\FinanceCategoryMod\Actions\Object;

use Modules\FinanceCategoryMod\Entities\Category;

/**
 * Fetch a Category by its ID
 */
class CategoryFetch
{
    private $id;

    public function run()
    {
        return Category::where('id', $this->id)->first();
    }

    /**
     * @param $id
     * @return void
     */
    public function setId( $id ) : void
    {
        $this->id = $id;
    }
}
