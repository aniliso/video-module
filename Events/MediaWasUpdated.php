<?php

namespace Modules\Video\Events;


use Modules\Media\Contracts\StoringMedia;
use Modules\Video\Entities\Media;

class MediaWasUpdated implements StoringMedia
{
    /**
     * @var Media
     */
    private $media;
    /**
     * @var array
     */
    private $data;

    public function __construct(Media $media, array $data)
    {

        $this->media = $media;
        $this->data = $data;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->media;
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
