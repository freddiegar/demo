<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Poblar tablas por defecto
        $this->call(DocumentTypeSeeder::class);
        $this->call(PersonTypeSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
