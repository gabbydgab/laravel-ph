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
     * Set the published_at attribute.
     *
     * @param string $value
     * @return void
     */
    public function setPublishedAtAttribute($value)
    {
        if ($value) {
            $value = Carbon::parse($value)->toDateTimeString();
        }

        $this->attributes['published_at'] = $value;
    }

    /**
     * Get the next record for this article.
     *
     * @return \App\Article|null
     */
    public function nextRecord()
    {
        return Article::where('id', '>', $this->id)
            ->whereNotNull('published_at')
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
        return Article::where('id', '<', $this->id)
            ->whereNotNull('published_at')
            ->orderByDesc('id')
            ->first();
    }
}
