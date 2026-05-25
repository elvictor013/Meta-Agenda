<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('coordenador')->user();

        if (!$user || !$user->is_admin) {
            return redirect()->route('coord.dashboard')
                ->with('error', 'Acesso restrito ao administrador.');
        }

        return $next($request);
    }
}
