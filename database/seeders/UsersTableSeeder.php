<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('users')->insert([[
            'name' => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "1",
        ],[
            'name' => 'nhuaman',
            'email'     => 'nhuamancerva@gmail.com',
            'password'  => bcrypt('12345678'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "2",
        ],[
            'name' => 'nena',
            'email'     => 'nena@gmail.com',
            'password'  => bcrypt('nena'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "1",
        ],[
            'name' => 'marielena',
            'email'     => 'marielena@gmail.com',
            'password'  => bcrypt('marielena'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "1",
        ],[
            'name' => 'anita',
            'email'     => 'anita@gmail.com',
            'password'  => bcrypt('anita'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "1",
        ],[
            'name' => 'edith',
            'email'     => 'edith@gmail.com',
            'password'  => bcrypt('edith'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "1",
        ],[
            'name' => 'clarita',
            'email'     => 'clarita@gmail.com',
            'password'  => bcrypt('clarita'),
            'role'     => 'ROLE_SGTI',
            'estado'     => 'ACTIVADO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
            'areas_id'=> "2",
        ]]);
    }
}
