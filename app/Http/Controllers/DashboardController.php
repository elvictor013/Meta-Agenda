<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $coordenador = Auth::guard('coordenador')->user();

        if ($coordenador->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('coord.dashboard');
    }
}
