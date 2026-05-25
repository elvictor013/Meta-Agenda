<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplinas';
    protected $fillable = ['nome', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function alocacoes()
    {
        return $this->hasMany(Alocacao::class);
    }
}
