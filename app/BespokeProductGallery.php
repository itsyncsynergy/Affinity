<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BespokeProductGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'bespoke_product_gallery';

	
}
