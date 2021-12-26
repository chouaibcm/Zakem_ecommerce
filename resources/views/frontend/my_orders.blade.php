@extends('layouts.frontendlay')

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
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>{{ trans('orders_trans.number') }}</th>
                            <th>{{ trans('orders_trans.order_date') }}</th>
                            <th>{{ trans('orders_trans.total') }}</th>
                            <th>{{ trans('orders_trans.status') }}</th>
                            <th>{{ trans('orders_trans.items') }}</th>
                            <th>{{ trans('orders_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->orders as $order)
                            <tr style="vertical-align: middle;">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>{{ number_format($order->total_price, 2) }} {{ trans('products_trans.DA') }}</td>
                                
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
                                <td>{{ $order->products->count() }}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-secondary btn-sm"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
