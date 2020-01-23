<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use \App\Likeable,
        \App\Taggable,
        \App\Sluggable,
        \App\HasExcerpt;

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
    protected $dates = ['published_at'];

    /**
     * Get the author of this article.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope the query to only include articles that are visible.
     */
    public function scopeVisible($query)
    {
        return $query->where('published_at', '<=', now());
    }

    /**
     * Get the next record for this article.
     *
     * @return \App\Article|null
     */
    public function nextRecord()
    {
        return Article::visible()
            ->where('id', '>', $this->id)
            ->orderBy('id')
            ->first();
    }

    /**
     * Get the previous record for this article.
     *
     * @return \App\Article|null
     */
    public function previousRecord()
    {
        return Article::visible()
            ->where('id', '<', $this->id)
            ->orderByDesc('id')
            ->first();
    }
}
