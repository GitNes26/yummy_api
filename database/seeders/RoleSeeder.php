<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([ 'role_name' => 'Administrador']);
        DB::table('roles')->insert([ 'role_name' => 'Gerente']);
        DB::table('roles')->insert([ 'role_name' => 'Empleado']);
        DB::table('roles')->insert([ 'role_name' => 'Mesa']);
    }
}
