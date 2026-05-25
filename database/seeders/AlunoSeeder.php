<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Aluno::insert([
            ['nome' => 'Gabriel Santos', 'matricula' => '202127814', 'turma_id' => 1],
            ['nome' => 'Maria Souza', 'matricula' => '2023002', 'turma_id' => 1],
        ]);
    }
}
