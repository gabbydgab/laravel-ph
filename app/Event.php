<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
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
    protected $dates = ['started_at', 'ended_at'];

    /**
     * The reference column of the slug.
     *
     * @var string
     */
    protected $sluggableKey = 'name';

    /**
     * Set the started_at attribute.
     *
     * @param string $value
     * @return void
     */
    public function setStartedAtAttribute($value)
    {
        if ($value) {
            $value = Carbon::parse($value)->toDateTimeString();
        }

        $this->attributes['started_at'] = $value;
    }

    /**
     * Set the ended_at attribute.
     *
     * @param string $value
     * @return void
     */
    public function setEndedAtAttribute($value)
    {
        if ($value) {
            $value = Carbon::parse($value)->toDateTimeString();
        }

        $this->attributes['ended_at'] = $value;
    }
}
