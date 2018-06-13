<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'customer_id',
    	'amount',
		'start_date',
		'end_date',
		'membership'
		
    ];


    protected $primaryKey = 'subscription_id';

    /**
     * An offer belongs to a merchant.
     * Get merchant associated with the offer.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    /*public function merchant()
    {
        return $this->belongsTo('App\Merchant');
    }
	*/


    public function customers()
    {
        return $this->belongsToMany('App\Customer','customer_id');
    }
}
