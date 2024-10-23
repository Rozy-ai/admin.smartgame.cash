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
                                        <p class="text-muted mb-1">Регистрации</p>
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
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-3">Overview</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span> <span
                                            class="text-muted">Yearly<i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gy-4">
                            <div class="col-xxl-3">
                                <div>
                                    <div class="mt-3 mb-3">
                                        <p class="text-muted mb-1">This Month</p>

                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <h2 class="mb-0">$24,568</h2>
                                            <div class="badge rounded-pill font-size-13 badge-soft-success">+
                                                2.65%</div>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col-sm-6">
                                            <div class="border-bottom border-end p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Orders</p>
                                                <h5 class="text-truncate mb-0">5,643</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="border-bottom p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Sales</p>
                                                <h5 class="text-truncate mb-0">16,273</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-sm-6">
                                            <div class="border-bottom border-end p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Order Value</p>
                                                <h5 class="text-truncate mb-0">12.03 %</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="border-bottom p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Customers</p>
                                                <h5 class="text-truncate mb-0">21,456</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-sm-6">
                                            <div class="border-end p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Income</p>
                                                <h5 class="text-truncate mb-0">$35,652</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="p-3 h-100">
                                                <p class="text-muted text-truncate mb-1">Expenses</p>
                                                <h5 class="text-truncate mb-0">$12,248</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9">
                                <div>
                                    <div id="chart-column" class="apex-charts" data-colors='["#f1f3f7", "#3b76e1"]'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
             
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h5 class="card-title mb-3">User Activity</h5>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span id="filter-type">Monthly</span><i class="mdi mdi-chevron-down ms-1"></i></span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item filter-option" href="#" data-type="daily">Today</a>
                                                                    <a class="dropdown-item filter-option" href="#" data-type="weekly">Weekly</a>
                                                                    <a class="dropdown-item filter-option" href="#" data-type="monthly">Monthly</a>
                                                                    <a class="dropdown-item filter-option" href="#" data-type="yearly">Yearly</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        
                                                    <div>
                                                        <p class="text-muted mb-1" id="filter-label">This Month</p>
                                                        <h4 id="total-users">0</h4>
                                                    </div>
                                        
                                                    <div class="m-n3">
                                                        <div id="chart-area" data-colors='["#3b76e1", "#f56e6e"]' class="apex-charts"></div>
                                                    </div>
                                                </div>
                                            </div>
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
