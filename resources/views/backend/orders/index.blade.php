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
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.orders') }}
                                </li>
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
                                {{ trans('orders_trans.List_order') }}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('orders_trans.number') }}</th>
                                        <th>{{ trans('orders_trans.order_date') }}</th>
                                        <th>{{ trans('orders_trans.client') }}</th>
                                        <th>{{ trans('orders_trans.total') }}</th>
                                        <th>{{ trans('orders_trans.paid') }}</th>
                                        <th>{{ trans('orders_trans.status') }}</th>
                                        <th>{{ trans('orders_trans.items') }}</th>
                                        <th>{{ trans('orders_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ number_format($order->total_price, 2) }}
                                                {{ trans('products_trans.DA') }}</td>
                                            @if ($order->paid == 0)
                                                <td><span class="badge bg-danger">{{ trans('orders_trans.no') }}</span>
                                                </td>
                                            @else
                                                <td><span class="badge bg-success">{{ trans('orders_trans.yes') }}</span>
                                                </td>
                                            @endif
                                            @if ($order->status == 1)
                                                <td><span class="badge bg-warning">{{ trans('orders_trans.new') }}</span>
                                                </td>
                                            @else
                                                @if ($order->status == 2)
                                                    <td><span
                                                            class="badge bg-primary">{{ trans('orders_trans.pending') }}</span>
                                                    </td>
                                                @else
                                                    @if ($order->status == 3)
                                                        <td><span
                                                                class="badge bg-success">{{ trans('orders_trans.shipped') }}</span>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                            <td>{{ $order->products->count() }}</td>
                                            <td>
                                                <!--update order-->
                                                @if (auth()->user()->hasPermission('update_orders'))
                                                    <a href="{{ route('orders.edit', $order->id) }}" type="button"
                                                        class="btn btn-primary btn-sm"
                                                        title="{{ trans('orders_trans.Edit') }}"><i
                                                            class="fa fa-edit"></i></a>
                                                @else
                                                    <button class="btn btn-primary btn-sm"
                                                        title="{{ trans('orders_trans.Edit') }}" disabled><i
                                                            class="fa fa-edit"></i></button>
                                                @endif
                                                <!--Delete order-->
                                                @if (auth()->user()->hasPermission('delete_orders'))
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $order->id }}"
                                                        title="{{ trans('orders_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        title="{{ trans('orders_trans.Delete') }}" disabled><i
                                                            class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!--Edit order-->
                                        <!--Delete order-->
                                        <!--Delete product from order-->
                                        <div class="modal fade" id="delete{{ $order->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('products_trans.delete_product') }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('orders.destroy', $order->id) }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('categories_trans.Warning_category') }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('categories_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
