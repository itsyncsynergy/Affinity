<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use Notifiable;
    
    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

	public $remember_token=false;

    protected $table = 'customers';

    /**
     * A Customer can have many interests.
     * Get interests associated with the customer.
     *
     * @return \Illuminate\Database\Eloquent\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToOne('App\User');
    }
	
}
