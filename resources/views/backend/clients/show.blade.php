@extends('layouts.adminlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12 fw-bold">
                 <div class="card mb-2">
                     <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><span class="me-2"><i class="bi bi-speedometer2"></i></span><a href="{{ route('dashboard')}}">{{ trans('main_trans.Dashboard') }}</a></li>
                              <li class="breadcrumb-item" aria-current="page"><a href="{{ route('clients.index') }}">{{ trans('main_trans.clients') }}</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                            </ol>
                          </nav>
                     </div>
                </div>                
            </div>
        </div>
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row mb-2">
        <div class="col-md-6 fw-bold fs-3">
            <span class="me-2">
                <i class="bi bi-people"></i>
            </span>
            {{ $user->name }}
        </div>
    </div>
        <div class="row">
            <div class="col-md-4">                
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-2">
                            <img src="{{$user->image_path}}" style="width: 100px" class="rounded-circle" alt="">
                            
                        </div>
                        <div class="d-flex justify-content-center">
                            <h6 class="fw-bold">{{ $user->name }} </h6>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h6  style="color: darkcyan">{{ $user->email }} </h6>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <p class="text-muted">{{ $user->mobile }} </p>
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row">
                            <div class="col">
                                <label for="">{{ trans('clients_trans.average') }} :</label>
                                <p class="text-muted">222 DA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">                
                <div class="card mb-2">
                    <div class="card-body">
                        <h4 class="fw-bold">{{ trans('orders_trans.title_page') }}</h4>
                        <hr class="dropdown-divider mb-2" />
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ trans('orders_trans.number') }}</th>   
                                        <th>{{ trans('orders_trans.order_date') }}</th>                                        
                                        <th>{{ trans('orders_trans.client') }}</th>
                                        <th>{{ trans('orders_trans.paid') }}</th>
                                        <th>{{ trans('orders_trans.status') }}</th>
                                        <th>{{ trans('orders_trans.items') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->client()->name }}</td>
                                            <td>{{ $order->paid}}</td>
                                        </tr>
                                        <!--Edit client-->
                                        <!--Delete client-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold">{{ trans('clients_trans.address') }}</h4>
                        <hr class="dropdown-divider mb-2" />
                        <h6 style="color: gray"> {{ $user->address }}- {{ $user->city}} - {{ $user->state}} - {{ $user->country}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
