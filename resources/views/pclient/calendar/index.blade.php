@extends('layouts.app')
@section('title', 'Agenda')
@section('calendar', 'active')

@section('headlocal') @includeIf('pclient.calendar.jscss.css') @endsection

@includeIf('pclient.calendar.modal.view')
@includeIf('pclient.calendar.modal.create')
@includeIf('pclient.calendar.modal.edit')
@section('jslocal') @includeIf('pclient.calendar.jscss.javascript') @endsection

@includeIf('pclient.calendar.modal.view')
@includeIf('pclient.calendar.modal.create')
@includeIf('pclient.calendar.modal.edit')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Agenda da Secretária</h1>
                <span class="text-muted">Painel Principal</span>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-0">
                    <div id="kt_docs_fullcalendar_basic"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@includeIf('pclient.calendar.modal.view')
@includeIf('pclient.calendar.modal.create')
@includeIf('pclient.calendar.modal.edit')
