<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    protected $primaryKey = 'tag_id';

    protected $table = 'tags';
  
    
}