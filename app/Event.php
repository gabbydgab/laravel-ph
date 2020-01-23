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
     * Get the address information for the event.
     */
    public function getAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->attributes['address_line_1'],
            $this->attributes['address_line_2'],
            $this->attributes['city'],
            $this->attributes['state'],
            $this->attributes['country'],
            $this->attributes['postal_code'],
        ]));
    }
}
