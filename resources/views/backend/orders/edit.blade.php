@extends('layouts.adminlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 fw-bold">
                <div class="card mb-2">
                    <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><span class="me-2"><i
                                            class="bi bi-speedometer2"></i></span><a
                                        href="{{ route('dashboard') }}">{{ trans('main_trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('orders.index') }}">{{ trans('main_trans.orders') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('orders_trans.number') }}
                                    #{{ $order->id }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                    <i class="bi bi-cart"></i>
                                </span>
                                {{ trans('orders_trans.order_detail') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr class="dropdown-divider mb-2" />
                                <p class="text-muted mb-0"> {{ $order->created_at }} | {{ $order->products->count() }}
                                    items
                                    | Total: {{ number_format($order->total_price,2) }} DA </p>
                                <hr class="dropdown-divider mb-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="fw-bold">Items</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($order->products as $product)
                                                        <tr>
                                                            <td><img src="{{ $product->image_path }}" style="width: 100px"
                                                                    alt=""></td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ number_format($product->price, 2) }}
                                                                {{ trans('products_trans.DA') }}</td>
                                                            <td>{{ $product->pivot->quantity }}</td>
                                                            <td class="text-end">
                                                                {{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                                {{ trans('products_trans.DA') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h5 class="fw-bold">Total:</h5>
                                            <h5 class="fw-bold">{{ number_format($order->total_price,2) }}
                                                {{ trans('products_trans.DA') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="fw-bold">Customer</h4>
                                        <hr class="dropdown-divider" />
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-4 text-end">
                                                <img src="{{ $order->user->image_path }}"
                                                    class="img-fluid rounded-circle"
                                                    style="width: 50px;" alt="">
                                            </div>
                                            <div class="col-8 text-start">
                                                <p class="fw-bold">
                                                    {{ $order->user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="fw-bold">Customer Contact</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <p class="fw-bold mb-0">{{ $order->user->name }}</p>
                                        <p class="mb-0">{{ $order->user->email }}</p>
                                        <p class="text-muted mb-0">{{ $order->mobile }}</p>

                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="fw-bold">Shipping Address</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <p class="mb-0">{{ $order->user->name }}<br>
                                           {{ $order->address }} <br>
                                           {{ $order->state}} <br>
                                           {{ $order->pincode}}, {{ $order->country}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
