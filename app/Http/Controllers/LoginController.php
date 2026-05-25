<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Coordenador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginProcess(LoginRequest $request)
    {
        $request->validated();

        $authenticated = Auth::guard('coordenador')->attempt([
            'cpf' => $request->cpf,
            'password' => $request->password,
        ]);

        if (!$authenticated) {
            return back()
                ->withInput()
                ->with('error', 'CPF ou senha inválidos');
        }

        // pega usuário logado
        $coordenador = Auth::guard('coordenador')->user();

        // bloqueia se estiver inativo
        if (!$coordenador->ativo) {
            Auth::guard('coordenador')->logout();

            return back()->with('error', 'Usuário desativado');
        }

        // redirecionamento inteligente
        if ($coordenador->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard.index');
    }

    public function destroy()
    {
        Auth::guard('coordenador')->logout();

        return redirect()
            ->route('login.coordenador')
            ->with('success', 'Deslogado com sucesso');
    }

    public function create()
    {
        return view('login.create');
    }

    public function store(LoginRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            Coordenador::create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'password' => bcrypt($request->password),
                'ativo' => true,
                'is_admin' => false
            ]);

            DB::commit();

            return redirect()
                ->route('login.coordenador')
                ->with('success', 'Coordenador cadastrado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar coordenador!');
        }
    }

    public function forgot()
    {
        return view('login.forgot');
    }
}
