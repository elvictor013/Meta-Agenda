<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas';
    protected $fillable = ['nome', 'semestre', 'turno', 'curso_id'];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function alocacoes()
    {
        return $this->belongsToMany(Alocacao::class, 'alocacao_turma');
    }

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class);
    }
}
