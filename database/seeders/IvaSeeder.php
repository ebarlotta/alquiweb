<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ivas')->insert(['ivadescripcion' => 'Responsable Inscripto']);
        DB::table('ivas')->insert(['ivadescripcion' => 'Responsable Monotributo']);
        DB::table('ivas')->insert(['ivadescripcion' => 'Consumidor Final']);
        DB::table('ivas')->insert(['ivadescripcion' => 'Exento']);
    }
}
