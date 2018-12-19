<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivatePartyGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'private_party_galleries';

	
}
