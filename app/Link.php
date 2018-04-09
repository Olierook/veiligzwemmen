<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Traits\Uuids;
use Mpociot\Firebase\SyncsWithFirebase;


class Link extends Model
{

  use Uuids;
  // use SyncsWithFirebase;

  protected $table = "links";

  protected $fillable = [
      'user_id', 'device_id', 'alert'
  ];

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;


  public function device(){
    return $this->belongsTo('App\Device', 'device_id', 'id');
  }
  public function user(){
    return $this->belongsTo('App\User', 'user_id', 'id');
  }
}
