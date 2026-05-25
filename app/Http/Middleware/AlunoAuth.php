<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlunoAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('aluno_id')) {
            return redirect()->route('aluno.consulta')->with('error', 'Informe sua matrícula.');
        }
        return $next($request);
    }
}
