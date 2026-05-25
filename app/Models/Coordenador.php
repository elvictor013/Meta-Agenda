<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coordenador extends Authenticatable
{
    protected $table = 'coordenadores';
    protected $fillable = ['nome','cpf','password','is_admin','ativo'];
    protected $hidden   = ['password','remember_token'];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'coordenador_curso');
    }
}
