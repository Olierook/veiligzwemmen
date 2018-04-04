<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'id' => Uuid::generate()->string,
          'name' => 'Robbert Olierook',
          'email' => 'robbert_olierook@hotmail.com',
          'password' => bcrypt('123o'),
          'role' => 'admin'
      ]);
      DB::table('users')->insert([
          'id' => Uuid::generate()->string,
          'name' => 'Rick Heemskerk',
          'email' => 'rick.heemskerk@hotmail.com',
          'password' => bcrypt('123h'),
          'role' => 'guard'
      ]);
      DB::table('users')->insert([
          'id' => Uuid::generate()->string,
          'name' => 'Marcellino Stroosnijder',
          'email' => 'marcellinostroosnijder@gmail.com',
          'password' => bcrypt('123s'),
          'role' => 'parent'
      ]);
      DB::table('users')->insert([
          'id' => Uuid::generate()->string,
          'name' => 'Melissa Julsing',
          'email' => 'mels1999@live.nl',
          'password' => bcrypt('123j'),
          'role' => 'parent'
      ]);
    }
}
