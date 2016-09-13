<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'id' => 'CC',
            'name' => 'Cédula de ciudanía colombiana',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'id' => 'CE',
            'name' => 'Cédula de extranjería',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'id' => 'NIT',
            'name' => 'Número de identificación tributaria',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'id' => 'PPN',
            'name' => 'Pasaporte',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'id' => 'SSN',
            'name' => 'Social Security Number',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'id' => 'TI',
            'name' => 'Tarjeta de identidad',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
