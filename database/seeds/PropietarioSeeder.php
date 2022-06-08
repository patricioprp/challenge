<?php

use Illuminate\Database\Seeder;

class PropietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('propietarios')->insert([
            'nombre' => 'Patricio',
            'apellido' => 'Polito'
        ]);
        DB::table('propietarios')->insert([
            'nombre' => 'Marcela',
            'apellido' => 'Gonzalez'
        ]);
        DB::table('propietarios')->insert([
            'nombre' => 'Ricardo',
            'apellido' => 'Ruiz'
        ]);
    }
}
