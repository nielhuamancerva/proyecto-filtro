<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('areas')->insert([[
            'name_area'     => 'SUB GERENCIA DE CONTABILIDAD',
            'estado_area'     => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'name_area'     => 'GERENCIA DE ADMINISTRACION',
            'estado_area'     => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);
    }
}
