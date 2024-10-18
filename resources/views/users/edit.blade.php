@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <h2>Изменить Пользователя</h2>
    
    <!-- Сообщение об успешном обновлении статуса -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма для изменения статуса платежа -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-first_name" class="form-label">first_name</label>
                <input type="text" class="form-control"  name="first_name" placeholder="first_name" value="{{$user->first_name}}">
                @error('first_name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-last_name" class="form-label">last_name</label>
                <input type="text" class="form-control"  name="last_name" placeholder="first_name" value="{{$user->last_name}}">
                @error('last_name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-username" class="form-label">username</label>
                <input type="text" class="form-control" name="username" placeholder="username" value="{{$user->username}}">
                @error('username')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-balance" class="form-label">balance</label>
                <input type="number" min="0" class="form-control"  name="balance" placeholder="balance" value="{{$user->balance}}">
                @error('balance')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-energy" class="form-label">energy</label>
                <input type="number" min="0"  class="form-control" name="energy" placeholder="energy" value="{{$user->energy}}">
                @error('energy')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="mb-3">
                <label for="formrow-multitap" class="form-label">multitap</label>
                <input type="number" min="0" class="form-control" name="multitap" placeholder="energy" value="{{$user->multitap}}">
                @error('multitap')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-energyLimit" class="form-label">Level</label>
                <input type="number" min="1" class="form-control" name="energyLimit" placeholder="energyLimit" value="{{$user->energyLimit}}">
                @error('energyLimit')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-joining_date" class="form-label">joining_date</label>
                <input type="text" class="form-control" disabled="disabled" name="joining_date" placeholder="joining_date" value="{{$user->joining_date}}">
                @error('joining_date')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-referrals" class="form-label">referrals</label>
                <input type="number" min="0" class="form-control" name="referrals" placeholder="referrals" value="{{$user->referrals}}">
                @error('referrals')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-inviter_id" class="form-label">inviter_id</label>
                <input type="number" min="0" class="form-control" name="inviter_id" placeholder="inviter_id" value="{{$user->inviter_id}}">
                @error('inviter_id')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="formrow-totalReferralsRewards" class="form-label">totalReferralsRewards</label>
                <input type="number" min="0" class="form-control" name="totalReferralsRewards" placeholder="totalReferralsRewards" value="{{$user->totalReferralsRewards}}">
                @error('totalReferralsRewards')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

        <!-- Кнопка для сохранения -->
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
</div>
@endsection