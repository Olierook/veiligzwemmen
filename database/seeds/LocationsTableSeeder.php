<?php

use Illuminate\Database\Seeder;
use App\Device;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $devices = Device::all();
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[0]->id,
          'latitude' => 52.2064931,
          'longitude' => 4.395843,
          'isWet' => 0
      ]);
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[0]->id,
          'latitude' => 52.2129310,
          'longitude' => 4.391843,
          'isWet' => 1
      ]);
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[0]->id,
          'latitude' => 52.2023101,
          'longitude' => 4.381843,
          'isWet' => 0
      ]);
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[1]->id,
          'latitude' => 52.2029310,
          'longitude' => 4.401843,
          'isWet' => 0
      ]);
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[1]->id,
          'latitude' => 53.2129310,
          'longitude' => 5.391843,
          'isWet' => 0
      ]);
      DB::table('locations')->insert([
          'id' => Uuid::generate()->string,
          'device_id' => $devices[1]->id,
          'latitude' => 52.2129310,
          'longitude' => 5.391843,
          'isWet' => 1
      ]);
    }
}
