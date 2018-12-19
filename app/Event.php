<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'group_id',
    	'name',
    	'description',
    	'location',
    	'duration'
    ];

    protected $primaryKey = 'event_id';

    /**
     * An event belongs to a group.
     * Get group associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * An event can be attended by many customers.
     * Get customers associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('App\Customer','customer_event','event_id','customer_id')->withTimestamps();
    }
}
