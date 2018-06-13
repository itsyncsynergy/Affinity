<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'merchant_id',
    	'category_id',
    	'name',
    	'address',
    	'contact',
    	'email',
    	'longlat',
    	'verification_pin',
    	'avatar',
		'country',
		'state',
		'city'
		
    ];


    protected $primaryKey = 'merchant_id';

    public $incrementing = false;

    /**
     * A Merchant has many reviews.
     * Get reviews associated with the merchant.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    /*public function reviews()
    {
        return $this->hasMany('App\Review','merchant_id');
    }*/

    /**
     * A merchant has many transactions.
     * Get transactions associated with the merchant.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    /*public function transactions()
    {
        return $this->hasMany('App\Transaction','merchant_id');
    }*/

    /**
     * A merchant belongs to a category.
     * Get category associated with the merchant.
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    /*public function category()
    {
        return $this->belongsTo('App\MerchantCategory','merchant_id');
    }*/

    /**
     * A merchant has many offers.
     * Get offers associated with the merchant.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    /*public function offers()
    {
        return $this->hasMany('App\MerchantOffer','merchant_id');
    }
	public function users()
    {
        return $this->hasMany('App\User','merchant_id');
    }*/
}
