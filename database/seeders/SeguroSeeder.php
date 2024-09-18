<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SeguroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seguros')->insert(['estado' => 'Activo','vencimiento'=>'24-09-01','tipo'=>'seguro','observaciones'=>'']);
        DB::table('seguros')->insert(['estado' => 'En trámite','vencimiento'=>'24-09-01','tipo'=>'seguro','observaciones'=>'']);
        DB::table('seguros')->insert(['estado' => 'Sin Seguro','vencimiento'=>'24-09-01','tipo'=>'seguro','observaciones'=>'']);
    }
}
