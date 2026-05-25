<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CursoSeeder::class,
            CoordenadorSeeder::class,
            TurmaSeeder::class,
            ProfessorSeeder::class,
            DisciplinaSeeder::class,
            SalaSeeder::class,
            AlunoSeeder::class,
            AlocacaoSeeder::class,
            NotificacaoSeeder::class,
        ]);
    }
}
