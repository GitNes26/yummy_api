<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Master',
            'email' => 'admin@yummy.mx',
            'username' => 'admin_yummy',
            'password' => Hash::make('admin_yummy'),
            'phone' => '(871)122-33-44',
            'role_id' => 1, //Administrador
        ]);
        DB::table('users')->insert([
            'name' => 'Gerente 1',
            'last_name' => 'Yummy',
            'email' => 'gerente@yummy.mx',
            'username' => 'gerente',
            'password' => Hash::make('gerente'),
            'phone' => '(871)122-33-44',
            'role_id' => 2, //Gerente
        ]);
        DB::table('users')->insert([
            'name' => 'Empleado 1',
            'last_name' => 'Yummy',
            'email' => 'empleado@yummy.mx',
            'username' => 'empleado',
            'password' => Hash::make('empleado'),
            'phone' => '(871)122-33-44',
            'role_id' => 3, //Empleado
        ]);
        DB::table('users')->insert([
            'name' => 'Mesa 1',
            'last_name' => 'Yummy',
            'email' => 'mesa1@yummy.mx',
            'username' => 'mesa1',
            'password' => Hash::make('mesa1'),
            'phone' => '(871)122-33-44',
            'role_id' => 4, //Mesa
        ]);
    }
}
