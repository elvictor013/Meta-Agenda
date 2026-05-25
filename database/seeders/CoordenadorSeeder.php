<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coordenador;
use App\Models\Curso;

class CoordenadorSeeder extends Seeder
{
    public function run()
    {
        // 🔹 Buscar cursos (já devem existir)
        $sistemas = Curso::where('nome', 'Sistemas para Internet')->first();
        $engenharia = Curso::where('nome', 'Engenharia de Software')->first();

        // =========================
        // 👑 ADMIN
        // =========================
        $admin = Coordenador::create([
            'nome' => 'Victor Gabriel',
            'cpf' => '03395672280',
            'password' => bcrypt('123456'),
            'is_admin' => true,
            'ativo' => true,
        ]);

        // vincula todos os cursos ao admin
        if ($sistemas && $engenharia) {
            $admin->cursos()->attach([
                $sistemas->id,
                $engenharia->id
            ]);
        }

        // =========================
        // 👩‍💼 COORDENADOR NORMAL
        // =========================
        $coord = Coordenador::create([
            'nome' => 'João Silva',
            'cpf' => '12345678900',
            'password' => bcrypt('123456'),
            'is_admin' => false,
            'ativo' => true,
        ]);

        // vincula só 1 curso
        if ($sistemas) {
            $coord->cursos()->attach([$sistemas->id]);
        }
    }
}
