<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([ 'os_name' => 'En cola' ]);
        DB::table('order_status')->insert([ 'os_name' => 'Recibida' ]);
        DB::table('order_status')->insert([ 'os_name' => 'En Proceso' ]);
        DB::table('order_status')->insert([ 'os_name' => 'Lista' ]);
        DB::table('order_status')->insert([ 'os_name' => 'Entregada' ]);
        DB::table('order_status')->insert([ 'os_name' => 'Cancelada' ]);
    }
}
