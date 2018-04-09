<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Link;
use App\User;
use App\Location;
use App\ChildName;

class AdminController extends Controller
{
  public function index(){
   return view('home')->with('wrongCode', null);
 }
}
