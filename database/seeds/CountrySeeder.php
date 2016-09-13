<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'id' => 'CO',
            'name' => 'COLOMBIA',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('countries')->insert([
            'id' => 'PE',
            'name' => 'PERU',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('countries')->insert([
            'id' => 'AR',
            'name' => 'ARGENTINA',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
