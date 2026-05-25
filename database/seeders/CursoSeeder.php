<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Curso::insert([
            ['nome' => 'Sistemas para Internet'],
            ['nome' => 'Engenharia de Software'],
        ]);
    }
}
