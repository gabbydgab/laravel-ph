<?php

namespace App;

trait Taggable
{
    /**
     * Boot the trait.
     */
    public static function bootTaggable()
    {
        parent::deleting(function ($model) {
            $model->tags()->detach();
        });
    }

    /**
     * Get the tags for this resource.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Sync tags for this resource.
     *
     * @param array $tags
     * @return array
     */
    public function syncTags($tags)
    {
        return $this->tags()->sync(collect($tags)->map(function ($name) {
            return Tag::firstOrCreate(compact('name'))->id;
        }));
    }

    /**
     * Get the names of the tags for this resource.
     *
     * @return void
     */
    public function getTagNames()
    {
        return $this->tags->pluck('name')->toArray();
    }
}
