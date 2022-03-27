<?php

namespace Modules\FinanceCategoryMod\Actions\Object;

/**
 * Delete a stored Category
 */
class CategoryDelete
{
    private $id;

    public function run()
    {
        $fetch = new CategoryFetch();
        $fetch->setId( $this->id );
        $category = $fetch->run();
        return $category->delete();
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
