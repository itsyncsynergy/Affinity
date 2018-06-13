<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'event_gallery';

	
}
