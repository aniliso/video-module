<?php

namespace Modules\Video\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Video\Presenters\CategoryPresenter;

class Category extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'video__categories';
    public $translatedAttributes = ['title', 'slug', 'description'];
    protected $fillable = ['title', 'slug', 'description', 'sorting', 'status'];
    protected $presenter = CategoryPresenter::class;

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function getUrlAttribute()
    {
        return route('video.category', [$this->slug]);
    }
}
