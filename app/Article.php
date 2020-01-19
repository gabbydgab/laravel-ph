<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * Get the author of this post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the tags for this post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    /**
     * Get the first article after this post.
     *
     * @return \App\Article|null
     */
    public function nextArticle()
    {
        return Article::where('id', '>', $this->id)
            ->orderBy('id')
            ->first();
    }

    /**
     * Get the first article before this post.
     *
     * @return \App\Article|null
     */
    public function previousArticle()
    {
        return Article::where('id', '<', $this->id)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Sync tags for this post.
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
}
