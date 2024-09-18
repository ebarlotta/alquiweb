<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlquiActualizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alqui_actualizacions')->insert(['actualizaciondescripcion' => 'Trimestral','cantmeses'=>3]);
        DB::table('alqui_actualizacions')->insert(['actualizaciondescripcion' => 'Cuatrimestral','cantmeses'=>4]);
        DB::table('alqui_actualizacions')->insert(['actualizaciondescripcion' => 'Semestral','cantmeses'=>6]);
        DB::table('alqui_actualizacions')->insert(['actualizaciondescripcion' => 'Anual','cantmeses'=>12]);
    }
}
