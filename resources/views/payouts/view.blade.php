@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h1>Данные Выплаты</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $payout->id }}</h2> <!-- Display user's name -->
        </div>
        <div class="card-body">
            <p><strong>payout_id:</strong> {{ $payout->payout_id }}</p>
            <p><strong>payment_id:</strong> {{ $payout->payment_id }}</p>
            <p><strong>amount:</strong> {{ $payout->amount }}</p>
            <p><strong>status:</strong> {{ $payout->status }}</p>
            <p><strong>provider_id:</strong> {{ $payout->provider_id }}</p>
            <p><strong>payout_date:</strong> {{ $payout->payout_date->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <!-- Optionally, add a back button or other links -->
    <a href="/payouts" class="btn btn-primary mt-3">Вернуться к списку Выплаты</a>
</div>
</div>
@endsection