<?php

namespace Modules\Video\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Video\Presenters\MediaPresenter;

class Media extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'video__media';
    public $translatedAttributes = ['title', 'slug', 'description'];
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'video_link', 'sorting', 'status', 'embed'];

    protected $casts = [
      'embed' => 'array'
    ];

    protected $presenter = MediaPresenter::class;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getUrlAttribute()
    {
        return route('video.media.show', $this->slug);
    }
}
