<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provincias')->insert(['provinciadescripcion' => 'Mendoza']);
        DB::table('provincias')->insert(['provinciadescripcion' => 'San Luis']);
        DB::table('provincias')->insert(['provinciadescripcion' => 'San Juan']);
        DB::table('provincias')->insert(['provinciadescripcion' => 'Córdoba']);
        DB::table('provincias')->insert(['provinciadescripcion' => 'Buenos Aires']);
    }
}
