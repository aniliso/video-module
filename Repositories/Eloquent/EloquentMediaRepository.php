<?php

namespace Modules\Video\Repositories\Eloquent;

use Modules\Video\Events\MediaWasCreated;
use Modules\Video\Events\MediaWasDeleted;
use Modules\Video\Events\MediaWasUpdated;
use Modules\Video\Repositories\MediaRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Video\Services\EmbedService;

class EloquentMediaRepository extends EloquentBaseRepository implements MediaRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new MediaWasCreated($model, $data));

        $embed = new EmbedService($model);
        $embed->update()->createEmbed()->getThumb();

        return $model;
    }

    public function update($model, $data)
    {
        $update = isset($data['updateImage']) ? false : true;

        $model->update($data);

        event(new MediaWasUpdated($model, $data));

        $embed = new EmbedService($model);
        $embed->update($update)->createEmbed()->getThumb();

        return $model;
    }

    public function destroy($model)
    {
        event(new MediaWasDeleted($model->id, get_class($model)));

        $embed = new EmbedService($model);
        $embed->deleteEmbed();

        return $model->delete();
    }

    public function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->where('status', 1)->orderBy('created_at', 'DESC')->paginate($perPage);
        }

        return $this->model->orderBy('created_at', 'DESC')->where('status', 1)->paginate($perPage);
    }


}
