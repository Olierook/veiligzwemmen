<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Link;
use App\User;
use App\Location;
use App\ChildName;

class GuardController extends Controller
{
    public function index(){
      return view('home');
    }

    public function maps(){
      $devices = array();
      $locations = array();
      $childnames = array();

      foreach (Link::all() as $ld) {
        $device = $ld->device()->get()[0];
        array_push($devices, $device);
        $loc = $device->location()->get();
        array_push($locations, $loc);
        $child = $device->childNames()->get()[0];
        array_push($childnames, $child);
      }
      $devices = json_encode($devices);
      $locations = json_encode($locations);
      $childnames = json_encode($childnames);
      return view('maps', compact('devices', 'locations', 'childnames'));
    }
}
