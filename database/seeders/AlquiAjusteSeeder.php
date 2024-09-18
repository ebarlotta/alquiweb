<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlquiAjusteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alqui_ajustes')->insert(['ajustedescripcion' => 'Semestral']);
        DB::table('alqui_ajustes')->insert(['ajustedescripcion' => 'IPC']);
        DB::table('alqui_ajustes')->insert(['ajustedescripcion' => 'Banco Central']);
    }
}
