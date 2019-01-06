<?php

namespace Modules\Video\Repositories\Eloquent;

use Modules\Video\Events\CategoryWasCreated;
use Modules\Video\Events\CategoryWasDeleted;
use Modules\Video\Events\CategoryWasUpdated;
use Modules\Video\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new CategoryWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new CategoryWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new CategoryWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

}
