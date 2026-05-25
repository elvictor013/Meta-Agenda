<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';
    protected $fillable = ['nome', 'capacidade', 'tipo'];

    public function alocacoes()
    {
        return $this->hasMany(Alocacao::class);
    }
}
