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
            $model->slug = Str::slug($model->{$model->getSluggableKeyName()});
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

    /**
     * Get the sluggable key for the model.
     *
     * @return string
     */
    public function getSluggableKeyName()
    {
        if (property_exists($this, 'sluggableKey')) {
            return $this->sluggableKey;
        }

        return 'title';
    }
}
