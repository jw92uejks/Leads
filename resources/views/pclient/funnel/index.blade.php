@extends('layouts.app')
@section('title', 'Funil de Vendas')
@section('funnel', 'active')
@section('headlocal')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="user-authenticated" content="{{ auth()->check() ? 'true' : 'false' }}" />
    @if(auth()->check())
        <meta name="user-id" content="{{ auth()->id() }}" />
        <meta name="user-name" content="{{ auth()->user()->name }}" />
    @endif
    @includeIf('pclient.funnel.jscss.css')
@endsection
@section('jslocal') @includeIf('pclient.funnel.jscss.javascript') @endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            </div>
        </div>
    </div>
    {{--
        <div id="kt_docs_jkanban_rich"></div>
    --}}

    <div id="root" class="px-5">
    </div>
@endsection
