@extends('layouts.app')
@section('title', 'Painel da Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Minhas Equipes</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Início</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Painel da Equipe</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container">
            <div class="row g-6 py-4">
                @foreach($teams as $team)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0" style="box-shadow: 0 10px 20px rgba(0,0,0,0.06), 0 6px 6px rgba(0,0,0,0.04); transform: translateZ(0); transition: transform .2s ease, box-shadow .2s ease;">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center mb-5">
                                    <div class="symbol symbol-60px me-4">
                                        <span class="symbol-label bg-light">
                                            <i class="ki-duotone ki-profile-user fs-1" style="color: #DA1D75;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('team-panel.single-team.show', $team->id) }}" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{ $team->team_name ?? ('Equipe #' . $team->id) }}</a>
                                        <span class="text-muted">{{ $team->members_count ?? 0 }} membros</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2 mb-6">
                                    <span class="badge badge-light">ID {{ $team->id }}</span>
                                </div>
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('team-panel.single-team.show', $team->id) }}" class="btn btn-sm btn-primary">Abrir</a>
                                    <a href="{{ route('team-panel.single-team.edit', $team->id) }}" class="btn btn-sm btn-light">Gerenciar</a>
                                </div>
                            </div>
                        </div>
                        <script>
                            // efeito 3D simples (hover)
                            (function(){
                                const card = document.currentScript.previousElementSibling;
                                if(card){
                                    card.addEventListener('mouseenter', ()=>{
                                        card.style.transform = 'translateY(-4px)';
                                        card.style.boxShadow = '0 18px 30px rgba(0,0,0,0.08), 0 10px 10px rgba(0,0,0,0.05)';
                                    });
                                    card.addEventListener('mouseleave', ()=>{
                                        card.style.transform = 'translateY(0)';
                                        card.style.boxShadow = '0 10px 20px rgba(0,0,0,0.06), 0 6px 6px rgba(0,0,0,0.04)';
                                    });
                                }
                            })();
                        </script>
                    </div>
                @endforeach

                {{-- Slot vazio para criar nova equipe --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('team-panel.single-team.create') }}" class="card h-100 border-dashed border-2 border-gray-300 hover-elevate-up text-center text-decoration-none">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-6">
                            <div class="symbol symbol-60px mb-4">
                                <span class="symbol-label bg-light">
                                    <i class="ki-duotone ki-plus fs-1 text-gray-700"></i>
                                </span>
                            </div>
                            <div class="fs-6 fw-bold text-gray-900">Nova equipe</div>
                            <div class="text-muted">Adicionar mais um slot de equipe</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection 