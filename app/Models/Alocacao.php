<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alocacao extends Model
{
    protected $table = 'alocacoes';

    protected $fillable = [
        'professor_id',
        'disciplina_id',
        'sala_id',
        'dia_semana',
        'hora_inicio',
        'hora_fim',
        'observacao',
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'alocacao_turma');
    }
}
