<?php

namespace Modules\Video\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'videoCategory';
    protected $slug     = 'slug';
    protected $transKey = 'video::routes.category';
    protected $routeKey = 'video.category';
}
