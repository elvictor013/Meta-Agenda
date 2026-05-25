<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfessorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('professor_id')) {
            return redirect()->route('professor.consulta')->with('error', 'Informe seu CPF.');
        }
        return $next($request);
    }
}
