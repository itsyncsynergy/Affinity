<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalVipEventGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'vip_event_galleries';

	
}
