<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //OPCION 1
        // DB::table('roles')->insert(
        //     [ 'role_name' => 'Administrador'],
        //     [ 'role_name' => 'Gerente'],
        //     [ 'role_name' => 'Empleado'],
        //     [ 'role_name' => 'Mesa'] 
        // );

        //OPCION 2
        // DB::table('roles')->insert([ 'role_name' => 'Administrador']);
        // DB::table('roles')->insert([ 'role_name' => 'Gerente']);
        // DB::table('roles')->insert([ 'role_name' => 'Empleado']);
        // DB::table('roles')->insert([ 'role_name' => 'Mesa']);
    }
}
