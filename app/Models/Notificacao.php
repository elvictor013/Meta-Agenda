<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    protected $fillable = [
        'turma_id',
        'titulo',
        'mensagem',
        'tipo'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
