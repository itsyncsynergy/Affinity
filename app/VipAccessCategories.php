<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipAccessCategories extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    protected $primaryKey = 'category_id';

    protected $table = 'vip_access_categories';
  
    
}