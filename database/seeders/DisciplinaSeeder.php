<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\Disciplina::insert([
        ['nome' => 'Algoritmos', 'curso_id' => 1],
        ['nome' => 'Arquitetura de Software', 'curso_id' => 1],
        ['nome' => 'Cálculo Diferencial I', 'curso_id' => 1],
        ['nome' => 'Inteligência Artificial', 'curso_id' => 2],
    ]);
}
}
