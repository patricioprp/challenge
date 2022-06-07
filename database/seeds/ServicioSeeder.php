<?php

use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios')->insert([
            'nombre' => 'Cambio de Aceite',
            'costo' => 100.00
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Cambio de Filtro',
            'costo' => 150.00
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Cambio de Correa',
            'costo' => 200.00
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Revisión General',
            'costo' => 250.00
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Pintura',
            'costo' => 300.00
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Otro',
            'costo' => 1000.00
        ]);
    }
}
