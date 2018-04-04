<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=100; $i < 1000; $i += 9) {
        $code = strval($i).str_random(5);
        DB::table('devices')->insert([
          'id' => Uuid::generate()->string,
          'code' => $code
        ]);
      }

    }
}
