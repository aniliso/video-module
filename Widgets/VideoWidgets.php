<?php

namespace Modules\Video\Widgets;

use Modules\Video\Repositories\MediaRepository;

class VideoWidgets
{
    /**
     * @var MediaRepository
     */
    private $media;

    public function __construct(MediaRepository $media)
    {
        $this->media = $media;
    }

    public function latest($limit=6, $view='last-video')
    {
        if($limit > 1) {
            $media = $this->media->latest($limit);
        } else {
            $media = $this->media->latest($limit)->first();
        }
        if($media) {
            return view('video::widgets.'.$view, compact('media'));
        }
        return null;
    }
}
