<?php

use Illuminate\Database\Seeder;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('person_types')->insert([
            'id' => '0',
            'name' => 'BANCA PERSONAS',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('person_types')->insert([
            'id' => '1',
            'name' => 'BANCA EMPRESAS',
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
