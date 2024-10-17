@extends('layouts.app')

@section('content')
    
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-xxl-4 col-lg-4 col-md-6">
                <div class="row justify-content-center g-0">
                    <div class="col-xl-9">
                        <div class="p-4">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="auth-full-page-content rounded d-flex p-3 my-2">
                                        <div class="w-100">
                                            <div class="d-flex flex-column h-100">
                                                <div class="mb-4 mb-md-5">
                                                    <a href="index.html" class="d-block auth-logo">
                                                        <img src="assets/images/logo-dark.png" alt="" height="22" class="auth-logo-dark me-start">
                                                        <img src="assets/images/coin.png" alt="" height="22" class="auth-logo-light me-start">
                                                    </a>
                                                </div>
                                                <div class="auth-content my-auto">
                                                    <div class="text-center">
                                                        <h5 class="mb-0">Добро пожаловать!</h5>
                                                        <p class="text-muted mt-2">Войдите, чтобы продолжить</p>
                                                    </div>
                                                    <form class="mt-4 pt-2" action="{{ route('authenticate') }}" method="post">
                                                        @csrf
                                                        <div class="form-floating form-floating-custom mb-4">
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" name="email" value="{{ old('email') }}" placeholder="Enter User Email">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <label for="input-username">Почта</label>
                                                            <div class="form-floating-icon">
                                                                <i data-eva="people-outline"></i>
                                                            </div>
                                                        </div>
                
                                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" id="password-input" name="password" placeholder="Enter Password">
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                            </button>
                                                            <label for="input-password">Пароль</label>
                                                            <div class="form-floating-icon">
                                                                <i data-eva="lock-outline"></i>
                                                            </div>
                                                        </div>
                
                                                        <div class="row mb-4">
                                                            <div class="col">
                                                                <div class="form-check font-size-15">
                                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                                    <label class="form-check-label font-size-13" for="remember-check">
                                                                        Запомнить меня
                                                                    </label>
                                                                </div>  
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="mb-3">
                                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Войти</button>
                                                        </div>
                                                    </form>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-8 col-lg-8 col-md-6">
                @if ($message = Session::get('success'))
                <div class="alert alert-danger text-center">
                    {{ $message }}
                </div>     
                @endif
                <div class="auth-bg bg-white py-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-white"></div>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-8">
                            <div class="mt-4">
                                <img src="assets/images/login-img.png" class="img-fluid" alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
@endsection