<?php

use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modelos')->insert([
            'nombre' => 'Fiorino',
            'marca_id' => 1
        ]);
        DB::table('modelos')->insert([
            'nombre' => 'Palio',
            'marca_id' => 1
        ]);
        DB::table('modelos')->insert([
            'nombre' => 'Focus',
            'marca_id' => 2
        ]);
        DB::table('modelos')->insert([
            'nombre' => 'Mondeo',
            'marca_id' => 2
        ]);
        DB::table('modelos')->insert([
            'nombre' => 'Corsa',
            'marca_id' => 3
        ]);
        DB::table('modelos')->insert([
            'nombre' => 'Astra',
            'marca_id' => 3
        ]);
    }
}
