<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas';
    protected $fillable = ['nome', 'semestre', 'turno', 'curso_id'];

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

    public function getNomeCompletoAttribute(): string
    {
        $curso = $this->curso->nome ?? '';
        return "{$curso} - {$this->semestre} - {$this->turno}";
    }
}
