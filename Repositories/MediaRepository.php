<?php

namespace Modules\Video\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface MediaRepository extends BaseRepository
{
    public function latest($limit=6);
}
