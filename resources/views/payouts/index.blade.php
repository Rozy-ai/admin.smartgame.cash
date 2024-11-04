@extends('layouts.home')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Список выплат <span class="text-muted fw-normal ms-2">({{count($payouts)}})</span></h5>
                </div>
            </div>

            <form action="{{ route('payouts.index') }}" method="GET">
                <div class="row">
                <div class="col-lg-4 p-0">
                    <div class="mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Поиск выплат..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-2 p-0" style="margin-left: -60px;">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
                <div class="offset-lg-4 col-lg-2">
                    <div class="form-group">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="" {{ request('status') === '' ? 'selected' : '' }}>All</option>
                            <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Failed" {{ request('status') === 'Failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                </div>
            </div>
            </form>
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
                                    <th scope="col">payout_id</th>
                                    <th scope="col">payment_id</th>
                                    <th scope="col">user id</th>
                                    <th scope="col">username</th>
                                    <th scope="col">F N</th>
                                    <th scope="col">card_number</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">payout_date</th>
                                    <th scope="col">status</th>
                                    {{-- <th scope="col">provider_id</th> --}}
                                    {{-- <th scope="col" style="width: 200px;">Action</th> --}}
                                  </tr>
                            </thead>

                            <tbody>
                                @foreach ($payouts as $payout)
                                <tr>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ url('/payouts/' . $payout->payout_id. '/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ url('/payouts/' . $payout->payout_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="px-2"><i class="fa fa-eye font-size-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>{{ $payout->payout_id }}</td>
                                    <td>
                                        <a href="{{ url('/payments/' . $payout->payment_id) }}" class="text-body">{{ $payout->payment_id }}</a>
                                    </td>
                                    <td>
                                        @if(isset($payout->payment->user_id))
                                        <a href="{{ url('/users/' . $payout->payment->user_id) }}" class="text-body">{{ $payout->payment->user_id }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($payout->payment->user->username))
                                        <a href="{{ url('/users/' . $payout->payment->user->id) }}" class="text-body">{{ $payout->payment->user->username }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($payout->payment->user->first_name) || isset($payout->payment->user->last_name))
                                        <span class="badge badge-soft-success mb-0">
                                            {{ \Illuminate\Support\Str::limit($payout->payment->user->first_name . ' ' . $payout->payment->user->last_name, 25) }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($payout->payment->card_number))
                                        {{ $payout->payment->card_number }}
                                    @endif
                                    </td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $payout->amount }}</span></td>
                                    <td>{{ $payout->payout_date }}</td>
                                    <td><span class="badge @if($payout->status == 'Completed') badge-soft-success @elseif($payout->status == 'Failed') badge-soft-warning @else  badge-soft-info @endif  mb-0">{{ $payout->status }}</span></td>
                                    {{-- <td>{{ $payout->provider }}</td> --}}
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
        {{ $payouts->links() }}
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