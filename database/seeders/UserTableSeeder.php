<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre' => 'John',
            'apellidos' => 'Doe',
            'dni' => '11111112L',
            'email' => 'seguridadweb@campusviu.es',
            'password' => Hash::make('S3gur1d4d?W3b'),
            'telefono' => '+34666666666',
            'pais' => 'Spain',
            'iban' => 'ES9121000418450200051332',
            'about' => 'Usuario de prueba',
        ]);
    }
}
