<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([ 'role_name' => 'Administrador']);
        DB::table('roles')->insert([ 'role_name' => 'Gerente']);
        DB::table('roles')->insert([ 'role_name' => 'Empleado']);
        DB::table('roles')->insert([ 'role_name' => 'Mesa']);

        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Master',
            'email' => 'admin@yummy.mx',
            'username' => 'admin_yummy',
            'password' => Hash::make('admin_yummy'),
            'phone' => '(871)122-33-44',
            'role_id' => 1,
        ]);
    }
}