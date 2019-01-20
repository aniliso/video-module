<?php

namespace Modules\Video\Widgets;

use Modules\Video\Repositories\CategoryRepository;
use Modules\Video\Repositories\MediaRepository;

class VideoWidgets
{
    /**
     * @var MediaRepository
     */
    private $media;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(MediaRepository $media, CategoryRepository $category)
    {
        $this->media = $media;
        $this->category = $category;
    }

    public function latest($limit=6, $view='last-video')
    {
        if($limit > 1) {
            $medias = $this->media->latest($limit);
            if($medias) {
                return view('video::widgets.'.$view, compact('medias'));
            }
        } else {
            $media = $this->media->latest($limit)->first();
            if($media) {
                return view('video::widgets.'.$view, compact('media'));
            }
        }
        return null;
    }

    public function categories($limit=20, $view='categories')
    {
        $categories = $this->category->all()->take($limit);
        if($categories->count()>0) {
            return view('video::widgets.'.$view, compact('categories'));
        }
        return null;
    }
}
