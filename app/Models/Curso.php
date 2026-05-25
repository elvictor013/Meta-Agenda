<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $fillable = ['nome'];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function coordenadores()
    {
        return $this->belongsToMany(Coordenador::class, 'coordenador_curso');
    }
}
