<?php

namespace Modules\Video\Services;

use Modules\Video\Repositories\MediaRepository;

class VideoRelation
{
    public static function update($model, $request)
    {
        if($videos = $request->input('videos')) {
            $model->videos()->whereNotIn('id', $videos)->detach();
            foreach ($videos as $video) {
                $media = app(MediaRepository::class)->find($video);
                $model->videos()->save($media);
            }
        } else {
            $model->videos()->detach();
        }
    }
}
