@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h2>Изменить статус платежа</h2>
    
    <!-- Сообщение об успешном обновлении статуса -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма для изменения статуса платежа -->
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Поле для изменения статуса -->
        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="status" class="form-label font-size-13 text-muted">Статус платежа:</label>
                <select class="form-control" name="status">
                    <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $payment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Failed" {{ $payment->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                    <option value="Refunded" {{ $payment->status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
        </div>

        <!-- Кнопка для сохранения -->
        <button type="submit" class="btn btn-primary">Обновить статус</button>
    </form>
</div>
</div>
@endsection