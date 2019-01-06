<?php

namespace Modules\Video\Repositories\Cache;

use Modules\Video\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'video.categories';
        $this->repository = $category;
    }
}
