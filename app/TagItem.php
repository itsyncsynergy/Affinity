<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    protected $primaryKey = 'id';

    protected $table = 'tag_item';
  
    
}