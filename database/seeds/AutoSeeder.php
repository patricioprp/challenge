<?php

use Illuminate\Database\Seeder;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autos')->insert([
            'anio' => 2021,
            'patente' => 'ADF234',
            'marca_id' => 1,
            'modelo_id' => 1,
            'color_id' => 1
        ]);
        DB::table('autos')->insert([
            'anio' => 2021,
            'patente' => 'HYG425',
            'marca_id' => 1,
            'modelo_id' => 2,
            'color_id' => 2
        ]);
        DB::table('autos')->insert([
            'anio' => 2021,
            'patente' => 'RET477',
            'marca_id' => 2,
            'modelo_id' => 1,
            'color_id' => 4
        ]);
        DB::table('autos')->insert([
            'anio' => 2021,
            'patente' => 'UIO589',
            'marca_id' => 2,
            'modelo_id' => 1,
            'color_id' => 1
        ]);
        DB::table('autos')->insert([
            'anio' => 2021,
            'patente' => 'YUI547',
            'marca_id' => 3,
            'modelo_id' => 1,
            'color_id' => 1
        ]);


        DB::table('auto_propietario')->insert([
            'auto_id' => 1,
            'propietario_id' => 1
        ]);
        DB::table('auto_propietario')->insert([
            'auto_id' => 2,
            'propietario_id' => 1
        ]);
        DB::table('auto_propietario')->insert([
            'auto_id' => 3,
            'propietario_id' => 1
        ]);
        DB::table('auto_propietario')->insert([
            'auto_id' => 4,
            'propietario_id' => 2
        ]);
        DB::table('auto_propietario')->insert([
            'auto_id' => 5,
            'propietario_id' => 3
        ]);
    }
}
