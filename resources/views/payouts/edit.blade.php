@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h2>Изменить статус выплаты</h2>
    
    <!-- Сообщение об успешном обновлении статуса -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма для изменения статуса платежа -->
    <form action="{{ route('payouts.update', $payout->payout_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Поле для изменения статуса -->
        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="status" class="form-label font-size-13 text-muted">Статус выплаты:</label>
                <select class="form-control" name="status">
                    <option value="Pending" {{ $payout->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $payout->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Failed" {{ $payout->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
        </div>

        <!-- Кнопка для сохранения -->
        <button type="submit" class="btn btn-primary">Обновить статус</button>
    </form>
</div>
</div>
@endsection