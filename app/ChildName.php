<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Traits\Uuids;
use Mpociot\Firebase\SyncsWithFirebase;

class ChildName extends Model
{
  use Uuids;
  // use SyncsWithFirebase;

  protected $table = "child_names";

  protected $fillable = [
      'name', 'label', 'device_id'
  ];
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
}
