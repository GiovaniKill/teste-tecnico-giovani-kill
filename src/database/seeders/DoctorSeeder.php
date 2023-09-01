<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = [
            ['name' => 'Mônica Torres da Silva'],
            ['name' => 'Heitor Gomes Vieira'],
        ];

        DB::table('doctors')->insert($doctors);
    }
}
