<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Notificacao::insert([
            [
                'turma_id' => 1,
                'titulo' => 'Aula cancelada',
                'mensagem' => 'Não haverá aula na terça-feira.',
                'tipo' => 'Urgente'
            ],
            [
                'turma_id' => 1,
                'titulo' => 'Inscrição Monitoria',
                'mensagem' => 'Inscrições abertas até dia 20.',
                'tipo' => 'Institucional'
            ]
        ]);
    }
}
