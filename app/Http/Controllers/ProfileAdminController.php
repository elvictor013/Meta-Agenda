<?php

namespace App\Http\Controllers;

use App\Models\Coordenador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('coordenador')->user();
        return view('admin.perfil', compact('admin'));
    }

    public function update(Request $request, $perfil = null)
    {
        $admin = Auth::guard('coordenador')->user();

        $rules = [
            'nome' => ['required', 'string', 'max:255'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
        }

        $request->validate($rules);

        $data = ['nome' => $request->nome];
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        Coordenador::where('id', $admin->id)->update($data);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
