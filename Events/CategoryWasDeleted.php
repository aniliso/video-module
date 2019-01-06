<?php

namespace Modules\Video\Events;


use Modules\Media\Contracts\DeletingMedia;

class CategoryWasDeleted implements DeletingMedia
{
    private $categoryId;
    private $categoryClass;

    public function __construct($categoryId, $categoryClass)
    {
        $this->categoryId = $categoryId;
        $this->categoryClass = $categoryClass;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->categoryId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->categoryClass;
    }
}
