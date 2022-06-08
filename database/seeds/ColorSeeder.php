<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'nombre' => 'Blanco'
        ]);

        DB::table('colors')->insert([
            'nombre' => 'Negro'
        ]);

        DB::table('colors')->insert([
            'nombre' => 'Gris'
        ]);

        DB::table('colors')->insert([
            'nombre' => 'Azul'
        ]);

        DB::table('colors')->insert([
            'nombre' => 'Verde'
        ]);

        DB::table('colors')->insert([
            'nombre' => 'Celeste'
        ]);
    }
}
