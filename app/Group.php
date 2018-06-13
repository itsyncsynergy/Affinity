<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'creator_id',
    	'details',
    	'group_head_id',
    	'avatar'
    ];


    protected $primaryKey = 'group_id';

    /**
     * A group has many events.
     * Get events associated with the group.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event','group_id');
    }

    /**
     * A group belongs to many customers.
     * Get customers associated with the group.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('App\Customer','customer_group','group_id','customer_id');
    }
}
