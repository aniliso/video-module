<?php

namespace Modules\Video\Repositories\Cache;

use Modules\Video\Repositories\MediaRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMediaDecorator extends BaseCacheDecorator implements MediaRepository
{
    public function __construct(MediaRepository $media)
    {
        parent::__construct();
        $this->entityName = 'video.media';
        $this->repository = $media;
    }
}
