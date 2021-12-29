@extends('layouts.frontendlay')

@section('css')
    <style>
        .modal-body {
            overflow-x: auto;
        }
    </style>
@endsection

@section('content')

    <section id="home-icons1" class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">

                </div>
                <div class="col-md-6 mb-4 text-center">
                    <i class="bi bi-shop fa-3x mb-2"></i>
                    <h3 class="display-6">{{ trans('main_trans.my_orders') }}</h3>
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <section id="home-icons" class="py-5">
        <div class="container">
            <h3 class="display-6 text-center mb-5">{{ auth()->user()->orders()->count() }} Order Effected</h3>
            <div class="table-responsive">
                <table class="table data-table">
                    <thead class="table-primary">
                        <tr>
                            <th>{{ trans('orders_trans.number') }}</th>
                            <th>{{ trans('orders_trans.status') }}</th>
                            <th>{{ trans('orders_trans.total') }}</th>
                            <th>{{ trans('orders_trans.items') }}</th>
                            <th>{{ trans('orders_trans.order_date') }}</th>
                            <th>{{ trans('orders_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr style="vertical-align: middle;">
                                <td>{{ $order->id }}</td>
                                @if ($order->status == 1)
                                    <td><span class="badge bg-warning">{{ trans('orders_trans.new') }}</span>
                                    </td>
                                @else
                                    @if ($order->status == 2)
                                        <td><span class="badge bg-primary">{{ trans('orders_trans.pending') }}</span>
                                        </td>
                                    @else
                                        @if ($order->status == 3)
                                            <td><span class="badge bg-success">{{ trans('orders_trans.shipped') }}</span>
                                            </td>
                                        @endif
                                    @endif
                                @endif
                                <td>{{ number_format($order->total_price, 2) }} {{ trans('products_trans.DA') }}</td>
                                <td>{{ $order->products->count() }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#order{{ $order->id }}"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--Edit Category-->
    @foreach ($orders as $order)
    <div class="modal fade" id="order{{ $order->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ trans('categories_trans.edit_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <hr class="dropdown-divider mb-2" />
                            <p class="text-muted mb-0"> {{ $order->created_at }} |
                                {{ $order->products->count() }}
                                items
                                | Total: {{ number_format($order->total_price, 2) }} DA </p>
                            <hr class="dropdown-divider mb-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="fw-bold">
                                        {{ trans('orders_trans.items') }}</h4>
                                    <hr class="dropdown-divider mb-2" />
                                    <div class="table-responsive">
                                        <table class="table" style="overflow: auto">
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                    <tr>
                                                        <td><img src="{{ $product->image_path }}"
                                                                style="width: 100px" alt="">
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ number_format($product->price, 2) }}
                                                            {{ trans('products_trans.DA') }}
                                                        </td>
                                                        <td>{{ $product->pivot->quantity }}
                                                        </td>
                                                        <td class="text-end">
                                                            {{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                            {{ trans('products_trans.DA') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold">
                                            {{ trans('orders_trans.total') }}:</h5>
                                        <h5 class="fw-bold">
                                            {{ number_format($order->total_price, 2) }}
                                            {{ trans('products_trans.DA') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
