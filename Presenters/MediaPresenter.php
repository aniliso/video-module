<?php

namespace Modules\Video\Presenters;

use Modules\Core\Presenters\BasePresenter;
use Modules\Video\Services\EmbedService;

class MediaPresenter extends BasePresenter
{
    protected $zone     = 'videoMedia';
    protected $slug     = 'slug';
    protected $transKey = 'video::routes.media.slug';
    protected $routeKey = 'media.slug';

    public function embedImage($width, $height, $mode='fit', $quality=80)
    {
        $embed = new EmbedService($this->entity, [
           'width'   => $width,
           'height'  => $height,
           'mode'    => $mode,
           'quality' => $quality
        ]);
        return $embed->getThumb();
    }
}
