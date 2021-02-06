<?php

namespace Modules\Video\Composers;

use Illuminate\Contracts\View\View;
use Modules\Video\Repositories\MediaRepository;

class VideoList
{
    /**
     * @var MediaRepository
     */
    private $media;

    public function __construct(MediaRepository $media)
    {
        $this->media = $media;
    }

    public function compose(View $view)
    {
        $view->with('videoLists', $this->media->all()->pluck('title', 'id'));
    }
}