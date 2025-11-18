@extends('layouts.app')
@section('title', 'Configurações')
@section('config', 'active')

@section('headlocal') @includeIf('pclient.config.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.config.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Configurações</h1>
                <span class="text-muted">Painel Principal</span>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid"></div>
</div>
@endsection
