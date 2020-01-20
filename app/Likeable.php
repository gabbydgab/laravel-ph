<?php

namespace App;

trait Likeable
{
    /**
     * Boot the trait.
     */
    public static function bootLikeable()
    {
        parent::deleting(function ($model) {
            $model->likes()->detach();
        });
    }

    /**
     * Get the likes for this article.
     */
    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable');
    }

    /**
     * Like a resource.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function like($user)
    {
        if (! $this->likes()->whereUserId($user->id)->first()) {
            $this->likes()->attach($user);

            $this->increment('likes_count');
        }
    }

    /**
     * Unlike a resource.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function unlike($user)
    {
        if ($this->likes()->whereUserId($user->id)->first()) {
            $this->likes()->detach($user);

            $this->decrement('likes_count');
        }
    }

    /**
     * Determine if this resource has been liked by a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return boolean
     */
    public function isLiked($user = null)
    {
        return $this->likes()->whereUserId(optional($user)->id)->exists();
    }
}
