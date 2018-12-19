<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantOffer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'merchant_id',
    	'details',
    	'tagline',
    	'period'
    ];


    protected $primaryKey = 'offer_id';

    /**
     * An offer belongs to a merchant.
     * Get merchant associated with the offer.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function merchant()
    {
        return $this->belongsTo('App\Merchant');
    }
}
