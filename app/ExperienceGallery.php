<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienceGallery extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    public $remember_token=false;
    
    protected $table = 'experience_gallery';

	
}
