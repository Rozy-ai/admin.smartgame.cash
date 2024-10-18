@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h1>Данные пользователя</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $user->username }}</h2> <!-- Display user's name -->
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>first_name:</strong> {{ $user->first_name }}</p>
            <p><strong>last_name:</strong> {{ $user->last_name }}</p>
            <p><strong>username:</strong> {{ $user->username }}</p>
            <p><strong>language_code:</strong> {{ $user->language_code }}</p>
            <p><strong>hash:</strong> {{ $user->hash }}</p>
            <p><strong>tdata:</strong> {{ $user->tdata }}</p>
            <p><strong>score:</strong> {{ $user->score }}</p> 
            <p><strong>balance:</strong> {{ $user->balance }}</p> 
            <p><strong>energy:</strong> {{ $user->energy }}</p> 
            <p><strong>multitap:</strong> {{ $user->multitap }}</p>
            <p><strong>Level:</strong> {{ $user->energyLimit }}</p>
            <p><strong>rechargingSpeed:</strong> {{ $user->rechargingSpeed }}</p>
            <p><strong>referrals:</strong> {{ $user->referrals }}</p>
            <p><strong>inviter_id:</strong> {{ $user->inviter_id }}</p>
            <p><strong>lastTapTime:</strong> {{ $user->lastTapTime }}</p>
            <p><strong>totalReferralsRewards:</strong> {{ $user->totalReferralsRewards }}</p>
            <p><strong>Created At:</strong> {{ $user->joining_date->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <!-- Optionally, add a back button or other links -->
    <a href="/users" class="btn btn-primary mt-3">Вернуться к списку пользователей</a>
</div>
</div>
@endsection