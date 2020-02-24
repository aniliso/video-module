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
    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|EloquentBaseRepository
     */
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new MediaWasCreated($model, $data));

        $embed = new EmbedService($model);
        $embed->update()->createEmbed()->getThumb();

        return $model;
    }

    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, $data)
    {
        $update = isset($data['updateImage']) ? true : false;

        $model->update($data);

        event(new MediaWasUpdated($model, $data));

        $embed = new EmbedService($model);
        $embed->update($update)->createEmbed()->getThumb();

        return $model;
    }

    /**
     * @param $model
     * @return bool
     */
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

    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function latest($limit = 6)
    {
        return $this->model->orderBy('created_at', 'DESC')->with(['translations', 'category'])->take($limit)->get();
    }
}
