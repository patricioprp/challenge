<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ServicioSeeder::class);
         $this->call(ColorSeeder::class);
         $this->call(MarcaSeeder::class);
         $this->call(ModeloSeeder::class);
         $this->call(PropietarioSeeder::class);
         $this->call(AutoSeeder::class);
    }
}
