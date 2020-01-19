<?php

namespace App;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Boot the trait.
     */
    public static function bootSluggable()
    {
        parent::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
