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

    public function latest($limit = 6)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.latest.{$limit}", $this->cacheTime,
                function () use ($limit) {
                    return $this->repository->latest($limit);
                }
            );
    }
}
