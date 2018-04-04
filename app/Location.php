<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Traits\Uuids;
use Mpociot\Firebase\SyncsWithFirebase;


class Location extends Model
{
  use Uuids;
  // use SyncsWithFirebase;

  protected $table = "locations";

  protected $fillable = [
      'device_id','longitude', 'latitude', 'isWet',
  ];

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  public function isWet(){
    if($this->isWet === 1){
      return true;
    }else{
      return false;
    }
  }
}
