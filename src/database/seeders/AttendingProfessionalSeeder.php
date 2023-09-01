<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendingProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attending_professionals = [
            ['name' => 'Giovani Souza Kill'],
            ['name' => 'Eduardo Pereira Santos'],
            ['name' => 'Soraia da Mata Rios'],
            ['name' => 'Jacinto Miguel Lima'],
        ];

        DB::table('attending_professionals')->insert($attending_professionals);
    }
}
