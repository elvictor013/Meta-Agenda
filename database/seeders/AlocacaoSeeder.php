<?php

namespace Database\Seeders;

use App\Models\Alocacao;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\Sala;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class AlocacaoSeeder extends Seeder
{
    public function run()
    {
        $prof1 = Professor::first();
        $prof2 = Professor::skip(1)->first() ?? $prof1;
        $disc1 = Disciplina::first();
        $disc2 = Disciplina::skip(1)->first() ?? $disc1;
        $sala1 = Sala::first();
        $sala2 = Sala::skip(1)->first() ?? $sala1;
        $turma1 = Turma::first();
        $turma2 = Turma::skip(1)->first() ?? $turma1;

        if (!$prof1 || !$disc1 || !$sala1 || !$turma1) return;

        $a1 = Alocacao::create([
            'professor_id'  => $prof1->id,
            'disciplina_id' => $disc1->id,
            'sala_id'       => $sala1->id,
            'dia_semana'    => 'Segunda',
            'hora_inicio'   => '19:00',
            'hora_fim'      => '20:30',
            'observacao'    => null,
        ]);
        $a1->turmas()->attach([$turma1->id]);

        $a2 = Alocacao::create([
            'professor_id'  => $prof2->id,
            'disciplina_id' => $disc2->id,
            'sala_id'       => $sala2->id,
            'dia_semana'    => 'Segunda',
            'hora_inicio'   => '20:30',
            'hora_fim'      => '22:00',
            'observacao'    => null,
        ]);
        $a2->turmas()->attach([$turma1->id]);

        $a3 = Alocacao::create([
            'professor_id'  => $prof1->id,
            'disciplina_id' => $disc1->id,
            'sala_id'       => $sala1->id,
            'dia_semana'    => 'Quarta',
            'hora_inicio'   => '19:00',
            'hora_fim'      => '20:30',
        ]);
        if ($turma2) $a3->turmas()->attach([$turma1->id, $turma2->id]);
        else $a3->turmas()->attach([$turma1->id]);
    }
}
