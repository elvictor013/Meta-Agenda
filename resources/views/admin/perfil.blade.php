@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title', 'Meu Perfil')
@section('page-title', 'Meu Perfil')
@section('page-subtitle', 'Gerencie suas informações de acesso')

@section('content')
<div class="pt-2 max-w-xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-16 h-16 rounded-2xl bg-brand-900 flex items-center justify-center text-white font-extrabold text-2xl">
                {{ strtoupper(substr($admin->nome, 0, 1)) }}
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg">{{ $admin->nome }}</h3>
                <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Administrador</span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.update', $admin->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $admin->nome) }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('nome')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">CPF</label>
                <input type="text" value="{{ $admin->cpf }}" disabled
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 font-mono text-slate-500 cursor-not-allowed">
                <p class="text-xs text-slate-400 mt-1">O CPF não pode ser alterado.</p>
            </div>

            <hr class="border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alterar Senha <span class="font-normal normal-case text-slate-400">(deixe em branco para manter a atual)</span></p>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nova Senha</label>
                <input type="password" name="password"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"
                    placeholder="Mínimo 6 caracteres">
                @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Confirmar Senha</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"
                    placeholder="Repita a senha">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-brand-900 hover:bg-brand-800 text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <span class="ms">save</span> Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
