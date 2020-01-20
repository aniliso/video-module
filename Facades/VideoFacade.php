<?php

namespace Modules\Video\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Video\Services\VideoRelation;

class VideoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VideoRelation::class;
    }
}
