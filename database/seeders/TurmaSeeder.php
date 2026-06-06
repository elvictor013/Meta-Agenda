<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turma;

class TurmaSeeder extends Seeder
{
    public function run(): void
    {
        Turma::insert([
            [
                'nome' => 'TSI 1º Semestre',
                'semestre' => '1º Semestre',
                'turno' => 'Noite',
                'curso_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'TSI 2º Semestre',
                'semestre' => '2º Semestre',
                'turno' => 'Noite',
                'curso_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'TSI 1º Semestre',
                'semestre' => '1º Semestre',
                'turno' => 'Manhã',
                'curso_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Redes 1º Semestre',
                'semestre' => '1º Semestre',
                'turno' => 'Noite',
                'curso_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}