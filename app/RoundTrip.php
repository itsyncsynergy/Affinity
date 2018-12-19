<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundTrip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    protected $primaryKey = 'id';

    protected $table = 'roundtrip';  
    
}
