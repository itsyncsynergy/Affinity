<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelConcierge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    protected $primaryKey = 'id'; 

    protected $table = 'travel_concierges'; 
    
}