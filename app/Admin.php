<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

	public $remember_token=false;

    
    public function users()
    {
        return $this->belongsToOne('App\User');
    }
	
}
