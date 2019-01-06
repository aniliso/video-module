<?php

namespace Modules\Video\Events;


use Modules\Media\Contracts\StoringMedia;
use Modules\Video\Entities\Category;

class CategoryWasUpdated implements StoringMedia
{
    /**
     * @var Category
     */
    private $category;
    /**
     * @var array
     */
    private $data;

    public function __construct(Category $category, array $data)
    {
        $this->category = $category;
        $this->data = $data;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->category;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
