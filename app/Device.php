<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Traits\Uuids;
use Mpociot\Firebase\SyncsWithFirebase;

class Device extends Model
{
  use Uuids;
  // use SyncsWithFirebase;

  protected $table = "devices";

  protected $fillable = [
      'code',
  ];

  protected $hidden = [
      'code',
  ];

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;


  public function deviceLink(){
    return $this->hasMany('App\Link', 'device_id', 'id');
  }
  public function location(){
    return $this->hasMany('App\Location', 'device_id', 'id');
  }
  public function childNames(){
    return $this->hasOne('App\ChildName', 'device_id', 'id');
  }


}
