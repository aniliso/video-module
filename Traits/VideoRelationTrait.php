<?php

namespace Modules\Video\Traits;

use Modules\Video\Entities\Media;

trait VideoRelationTrait
{
    public function videos()
    {
        return $this->morphToMany(Media::class, 'relation', 'video__relations');
    }
}
