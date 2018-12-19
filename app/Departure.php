<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    protected $primaryKey = 'id';

    protected $table = 'departures';  
    
}
