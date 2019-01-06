<?php

namespace Modules\Video\Events;

use Modules\Media\Contracts\DeletingMedia;

class MediaWasDeleted implements DeletingMedia
{
    private $mediaId;
    private $mediaClass;

    public function __construct($mediaId, $mediaClass)
    {

        $this->mediaId = $mediaId;
        $this->mediaClass = $mediaClass;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->mediaId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->mediaClass;
    }
}
