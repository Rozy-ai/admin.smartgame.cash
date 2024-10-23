@extends('layouts.home')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xxl-9">
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <i data-eva="pie-chart-2" class="fill-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Платежи в этот месяц</p>
                                        <h4 class="mb-0">₸ {{ $currentMonthAmount }}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        <div class="badge rounded-pill font-size-13 badge-soft-success">+ {{$percentChange}}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <i data-eva="people" class="fill-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Регистрации в месяц</p>
                                        <h4 class="mb-0">{{$currentMonthUsers}}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        <div class="badge rounded-pill font-size-13 badge-soft-success"> {{$percentChangeUsers}}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <i data-eva="shopping-bag" class="fill-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Выплаты в этот месяц</p>
                                        <h4 class="mb-0">{{$currentMonthPayouts}}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        <div class="badge rounded-pill font-size-13 badge-soft-success">{{$percentChangePayouts}}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

                <!-- end row -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
                <!-- End Page-content -->
@endsection
