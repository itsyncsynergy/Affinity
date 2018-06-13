<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','remarks'];


    protected $primaryKey = 'category_id';

    /**
     * A Category has many merchants.
     * Get merchants associated with the category.
     *
     * @return \Illuminate\Database\Eloquent\HasMany
     */
    public function merchants()
    {
        return $this->hasMany('App\Merchant','category_id');
    }
}
