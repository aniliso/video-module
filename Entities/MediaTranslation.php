<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;

class MediaTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description'];
    protected $table = 'video__media_translations';
}
