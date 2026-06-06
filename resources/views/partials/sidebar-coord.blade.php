@section('sidebar-role', auth()->guard('coordenador')->user()->is_admin ? 'Administrador' : 'Coordenação')
@section('user-name', auth()->guard('coordenador')->user()->nome ?? 'Usuário')
@section('user-role', auth()->guard('coordenador')->user()->is_admin ? 'Administrador' : 'Coordenador(a)')
@section('user-initial', auth()->guard('coordenador')->user()->nome ?? 'C')

@section('sidebar-logout')
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Sair">
        <span class="ms text-lg">logout</span>
    </button>
</form>
@endsection

@section('sidebar-nav')
@php $current = request()->route()->getName(); @endphp
<a href="{{ route('dashboard.index') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'dashboard') ? 'active' : '' }}">
    <span class="ms text-xl">grid_view</span> Dashboard
</a>
<a href="{{ route('coord.alocacoes') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.alocacoes') ? 'active' : '' }}">
    <span class="ms text-xl">calendar_month</span> Alocações
</a>
<a href="{{ route('coord.turmas') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.turmas') ? 'active' : '' }}">
    <span class="ms text-xl">groups</span> Turmas
</a>
<a href="{{ route('coord.professores') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.professores') ? 'active' : '' }}">
    <span class="ms text-xl">person_search</span> Professores
</a>
<a href="{{ route('coord.disciplinas') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.disciplinas') ? 'active' : '' }}">
    <span class="ms text-xl">menu_book</span> Disciplinas
</a>
<a href="{{ route('coord.salas') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.salas') ? 'active' : '' }}">
    <span class="ms text-xl">meeting_room</span> Salas
</a>
<a href="{{ route('coord.notificacoes') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'coord.notificacoes') ? 'active' : '' }}">
    <span class="ms text-xl">notifications</span> Notificações
</a>
@if(auth()->guard('coordenador')->user()->is_admin)
<div class="pt-2 mt-2 border-t border-slate-100">
    <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Administração</p>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors {{ str_starts_with($current, 'admin') ? 'active' : '' }}">
        <span class="ms text-xl">admin_panel_settings</span> Painel Admin
    </a>
</div>
@endif
@endsection
