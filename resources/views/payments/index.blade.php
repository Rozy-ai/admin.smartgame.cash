@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Список выплат <span class="text-muted fw-normal ms-2">({{count($payments)}})</span></h5>
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
                                    <th scope="col">Id</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">username</th>
                                    <th scope="col">F N</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">external_id</th>
                                    <th scope="col">card_number</th>
                                    <th scope="col">status</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">url</th>
                                    <th scope="col">provider</th>
                                    {{-- <th scope="col" style="width: 200px;">Action</th> --}}
                                  </tr>
                            </thead>

                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>
                                        <a href="#" class="text-body">{{ $payment->user_id }}</a>
                                    </td>
                                    <td>
                                        @if(isset($payment->user->username))
                                        <a href="#" class="text-body">{{ $payment->user->username }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($payment->user->first_name) && isset($payment->user->last_name))
                                        <span class="badge badge-soft-success mb-0">{{ $payment->user->first_name }} {{ $payment->user->last_name }}</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $payment->amount }}</span></td>
                                    <td>{{ $payment->external_id }}</td>
                                    <td>{{ $payment->card_number }}</td>
                                    <td><span class="badge @if($payment->status == 'Completed') badge-soft-success @elseif($payment->status == 'Failed') badge-soft-warning @else  badge-soft-info @endif  mb-0">{{ $payment->status }}</span></td>
                                    <td>{{ $payment->created_at }}</td>
                                    <td>{{ $payment->url }}</td>
                                    <td>{{ $payment->provider }}</td>
                                        {{-- <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class="bx bx-trash-alt font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                            
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td> --}}
                                </tr>       
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        {{ $payments->links() }}
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