<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Turma::insert([
            ['nome' => 'SI-1A', 'semestre' => '1 Semestre', 'turno' => 'Matutino', 'curso_id' => 1],
            ['nome' => 'SI-2A', 'semestre' => '2 Semestre', 'turno' => 'Matutino', 'curso_id' => 1],
        ]);
    }
}
