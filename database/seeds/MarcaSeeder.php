<?php

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
            'nombre' => 'Fiat'
        ]);

        DB::table('marcas')->insert([
            'nombre' => 'Ford'
        ]);

        DB::table('marcas')->insert([
            'nombre' => 'Chevrolet'
        ]);
    }
}
