<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Device;
use App\Link;
use App\User;
use App\Location;
use App\ChildName;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function jsonfx()
    // {
    //   $modulejson = array();
    //   $usr = \Auth::user();
    //   $cijfers = $usr->cijfers()->where('user_id', $usr->id)->get();
    //   foreach ($cijfers as $cif) {
    //     $vaardigheden= array();
    //     $mod = $cif->module()->where('id', $cif->module_id)->get()[0];
    //     $vaardigheid = $mod->vaardigheid()->where('module_id', $mod->id)->get();
    //     foreach ($vaardigheid as $vhd) {
    //       array_push($vaardigheden, $vhd->vaardigheden);
    //     }
    //     $part = array(
    //       "module" => $mod->modulenaam,
    //       "cijfer" => $cif->cijfer,
    //       "vaardigheden" => $vaardigheden
    //     );
    //     array_push($modulejson, $part);
    //   }
    //   if($par !== false){
    //     $json = json_encode($modulejson[$par]);
    //   }else{
    //     $json = json_encode($modulejson);
    //   }
    //   return $json;
    // }


    public function index()
    {
      return view('home')->with('wrongCode', null);
    }

    public function maps(){
      $devices = array();
      $locations = array();
      $childnames = array();

      $linked_devices = Auth::user()->userLink()->where('user_id', Auth::user()->id)->get();
      foreach ($linked_devices as $ld) {
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
    public function link(Request $request)
    {
      $device_id = 'unset';
      $user_id = Auth::user()->id;
      foreach (Device::all() as $device) {
        if ($device->code == $request->code) {
          $device_id = $device->id;
          break;
        }
      }
      if ($device_id == 'unset') {
        return view('home')->with('wrongCode', '');
      }
      Link::firstOrCreate([
        'user_id' => $user_id,
        'device_id' => $device_id
      ]);
      ChildName::firstOrCreate([
        'device_id' => $device_id,
        'name' => $request->name,
        'label' => $request->label
      ]);
      return redirect()->route('maps');
    }
    // public function addNameIndex(){
    //   $devices = array();
    //   $locations = array();
    //   $linked_devices = Auth::user()->userLink()->where('user_id', $id)->get();
    //   foreach ($linked_devices as $ld) {
    //     $device = $ld->device()->get()[0];
    //     array_push($devices, $device);
    //     $loc = $device->location()->get();
    //     array_push($locations, $loc);
    //   }
    //   $devices = json_encode($devices);
    //   $locations = json_encode($locations);
    //   return view('maps', compact('devices', 'locations'));
    // }
}
