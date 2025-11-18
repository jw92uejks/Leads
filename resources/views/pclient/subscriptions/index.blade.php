@extends('layouts.app')
@section('title', 'Planos de Assinatura')
@section('subscriptions', 'active')

@section('headlocal') @includeIf('pclient.subscriptions.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.subscriptions.jscss.javascript') @endsection

@section('content')
<div class="container">
    <div class="row">
        @foreach($subscriptions as $subscription)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $subscription->name }}</h5>
                    <h3>R$ {{ number_format($subscription->price, 2, ',', '.') }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $subscription->description }}</p>
                    <ul>
                        @foreach($subscription->features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100"
                            onclick="createPaymentLink({{ $subscription->id }})">
                        Assinar Agora
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
