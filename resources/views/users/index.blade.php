@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Список<span class="text-muted fw-normal ms-2">({{count($users)}})</span></h5>
                </div>
            </div>

            <div class="col-md-6">


            </div>
        </div>

        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 200px;">Просмотр</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">F N</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Energy</th>
                                    <th scope="col">Multitap</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">RechargingSpeed</th>
                                    <th scope="col">Referrals</th>
                                    <th scope="col">Inviter_id</th>
                                    <th scope="col">Joining_date</th>
                                    {{-- <th scope="col" style="width: 200px;">Action</th> --}}
                                  </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ url('/users/' . $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="px-2"><i class="fa fa-eye font-size-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ url('/users/' . $user->id) }}">{{ $user->id }}</a></td>
                                    <td>
                                        <a href="{{ url('/users/' . $user->id) }}" class="text-body">{{ $user->username }}</a>
                                    </td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $user->first_name }} {{ $user->last_name }}</span></td>
                                    <td>{{ $user->score }}</td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $user->balance }}</span></td>
                                    <td>{{ $user->energy }}</td>
                                    <td>{{ $user->multitap }}</td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $user->energyLimit }}</span></td>
                                    <td>{{ $user->rechargingSpeed }}</td>
                                    <td>{{ $user->referrals }}</td>
                                    <td>{{ $user->inviter_id }}</td>
                                    <td>{{ $user->joining_date }}</td>
                                </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        {{ $users->links() }}
        {{-- <div class="row g-0 align-items-center pb-4">
            <div class="col-sm-6">
                <div>
                    <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-end">
                    <ul class="pagination mb-sm-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
@endsection