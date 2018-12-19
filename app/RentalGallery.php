<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'rental_gallery';

	
}
