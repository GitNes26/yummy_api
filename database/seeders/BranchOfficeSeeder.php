<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch_offices')->insert([
            'bo_name' => 'Galerias',
            'bo_country' => 'MX - Mexico',
            'bo_state' => 'Coahuila',
            'bo_city' => 'Torreon',
            'bo_address' => 'Periferico Raul Lopez'
        ]);
    }
}
