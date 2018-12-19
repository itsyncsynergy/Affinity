<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuxuryExperience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'experience_name',
    	'price',
		'overview',
		'details',
		'ntk',
		'overview',
		'country',
		'state',
		'start_date',
		'end_date',
		'avatar'
    ];


    protected $primaryKey = 'experience_id';

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
        return $this->belongsToMany('App\Customer','customer_experiences', 'experience_id','customer_id');
    }
}
