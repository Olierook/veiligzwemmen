<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Traits\Uuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Firebase\SyncsWithFirebase;

class User extends Authenticatable
{
    use Uuids;
    use Notifiable;
    // use SyncsWithFirebase;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function userLink(){
      return $this->hasMany('App\Link', 'user_id', 'id');
    }

    public function hasRole($p){
      if ($p == $this->role){return true;};
    }
}
