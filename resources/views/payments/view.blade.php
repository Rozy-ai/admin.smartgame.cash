@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h1>Данные Платежи</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $payment->id }}</h2> <!-- Display user's name -->
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $payment->id }}</p>
            <p><strong>user_id:</strong> {{ $payment->user_id }}</p>
            <p><strong>amount:</strong> {{ $payment->amount }}</p>
            <p><strong>external_id:</strong> {{ $payment->external_id }}</p>
            <p><strong>card_number:</strong> {{ $payment->card_number }}</p>
            <p><strong>status:</strong> {{ $payment->status }}</p>
            <p><strong>url:</strong> {{ $payment->url }}</p>
            <p><strong>created_at:</strong> {{ $payment->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <!-- Optionally, add a back button or other links -->
    <a href="/payments" class="btn btn-primary mt-3">Вернуться к списку Платеж</a>
</div>
</div>
@endsection