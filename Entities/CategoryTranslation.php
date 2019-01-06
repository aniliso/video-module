<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description'];
    protected $table = 'video__category_translations';
}
