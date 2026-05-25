<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professores';
    protected $fillable = ['nome','cpf'];

    public function alocacoes() { return $this->hasMany(Alocacao::class); }
}
