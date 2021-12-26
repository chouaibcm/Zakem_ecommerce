@extends('layouts.adminlayout')
@section('css')
    <style>
        #items a {
            text-decoration: none;
            color: gray;
        }

        #items a:hover {
            color: black;
        }

    </style>
@endsection
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
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('orders.index') }}">{{ trans('main_trans.orders') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('orders_trans.number') }}
                                    #{{ $order->id }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div id="items">
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

                            <div class="d-flex justify-content-between">
                                <div class="fw-bold fs-3">
                                    <span>
                                        <i class="bi bi-cart me-2"></i>{{ trans('orders_trans.order_detail') }}
                                    </span>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#factureModal">{{ trans('orders_trans.facture') }}</button>
                                    <button class="btn btn-warning text-white" data-bs-toggle="modal"
                                        data-bs-target="#statusModal">{{ trans('orders_trans.edit_status') }}</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr class="dropdown-divider mb-2" />
                                    <p class="text-muted mb-0"> {{ $order->created_at }} |
                                        {{ $order->products->count() }}
                                        {{ trans('orders_trans.items') }}
                                        | {{ trans('orders_trans.total') }}:
                                        {{ number_format($order->total_price, 2) }}
                                        {{ trans('products_trans.DA') }} |
                                        @if ($order->status == 1)
                                            <span class="badge bg-warning">{{ trans('orders_trans.new') }}</span>
                                        @else
                                            @if ($order->status == 2)
                                                <span class="badge bg-primary">{{ trans('orders_trans.pending') }}</span>
                                            @else
                                                @if ($order->status == 3)
                                                    <span
                                                        class="badge bg-success">{{ trans('orders_trans.shipped') }}</span>
                                                @endif
                                            @endif
                                        @endif | 
                                        @if ($order->paid == 0)
                                                <span class="badge bg-danger">{{ trans('orders_trans.not_paid') }}</span>
                                            @else
                                               <span class="badge bg-success">{{ trans('orders_trans.yes_paid') }}</span>
                                            @endif
                                    </p>
                                    <hr class="dropdown-divider mb-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold">{{ trans('orders_trans.items') }}</h5>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal">{{ trans('orders_trans.Edit') }}</a>
                                            </div>
                                            <hr class="dropdown-divider mb-2" />
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <td><img src="{{ $product->image_path }}"
                                                                        style="width: 100px" alt=""></td>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ number_format($product->price, 2) }}
                                                                    {{ trans('products_trans.DA') }}</td>
                                                                <td>{{ $product->pivot->quantity }}</td>
                                                                <td>
                                                                    {{-- product attribute --}}
                                                                    @if ($product->pivot->product_attribute)
                                                                        <?php
                                                                        $pa_array = unserialize($product->pivot->product_attribute);
                                                                        ?>
                                                                        @foreach ($pa_array as $pav)
                                                                            @foreach ($product->attr_values as $pa)
                                                                                @if ($pa->id == $pav)
                                                                                    <p class="mb-0">
                                                                                        {{ $pa->value }}</p>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endif

                                                                </td>
                                                                <td class="text-end">
                                                                    {{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                                    {{ trans('products_trans.DA') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold">{{ trans('orders_trans.total') }}:</h5>
                                                <h5 class="fw-bold">{{ number_format($order->total_price, 2) }}
                                                    {{ trans('products_trans.DA') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="customer_1">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <h5 class="fw-bold">{{ trans('orders_trans.customer') }}</h5>
                                                <hr class="dropdown-divider" />
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-4 text-end">
                                                        <img src="{{ $order->user->image_path }}"
                                                            class="img-fluid rounded-circle" style="width: 50px;" alt="">
                                                    </div>
                                                    <div class="col-8 text-start">
                                                        <p class="fw-bold">
                                                            {{ $order->user->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="fw-bold">{{ trans('orders_trans.customer_contact') }}</h5>
                                            <hr class="dropdown-divider mb-2" />
                                            <p class="fw-bold mb-0">{{ $order->user->name }}</p>
                                            <p class="mb-0">{{ $order->user->email }}</p>
                                            <p class="text-muted mb-0">{{ $order->mobile }}</p>

                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold">{{ trans('orders_trans.shipping_address') }}
                                                </h5>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#addressModal">{{ trans('orders_trans.Edit') }}</a>
                                            </div>
                                            <hr class="dropdown-divider mb-2" />
                                            <p class="mb-0">{{ $order->user->name }}<br>
                                                {{ $order->address }} <br>
                                                {{ $order->state }} <br>
                                                {{ $order->pincode }}, {{ $order->country }}
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
    </div>
    <!-- FactureModal add model -->
    <div class="modal fade" id="factureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('orders_trans.facture') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="print-area">
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

                            <div class="col-md-12 mb-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <div class="text-start">
                                        <h4 class="fw-bold">{{ trans('orders_trans.customer_contact') }}</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <p class="fw-bold mb-0">{{ $order->user->name }}</p>
                                        <p class="mb-0">{{ $order->user->email }}</p>
                                        <p class="text-muted mb-0">{{ $order->mobile }}</p>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fw-bold">{{ trans('orders_trans.shipping_address') }}</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <p class="mb-0">{{ $order->user->name }}<br>
                                            {{ $order->address }} <br>
                                            {{ $order->state }} <br>
                                            {{ $order->pincode }}, {{ $order->country }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="fw-bold">{{ trans('orders_trans.items') }}</h4>
                                        <hr class="dropdown-divider mb-2" />
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($order->products as $product)
                                                        <tr>
                                                            <td><img src="{{ $product->image_path }}"
                                                                    style="width: 100px" alt=""></td>
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
                                            <h5 class="fw-bold">{{ trans('orders_trans.total') }}:</h5>
                                            <h5 class="fw-bold">{{ number_format($order->total_price, 2) }}
                                                {{ trans('products_trans.DA') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                    <button type="submit" class="btn btn-primary print-btn">{{ trans('orders_trans.print') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- orderModal add model -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('orders_trans.edit_order') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="fw-bold">{{ trans('orders_trans.items') }}</h4>
                                    <hr class="dropdown-divider mb-2" />
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>{{ trans('products_trans.image') }}</th>
                                                    <th>{{ trans('products_trans.Name') }}</th>
                                                    <th>{{ trans('products_trans.price') }}</th>
                                                    <th>{{ trans('products_trans.quantity') }}</th>
                                                    <th>{{ trans('products_trans.attr') }}</th>
                                                    <th>{{ trans('products_trans.total') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                    <tr style="vertical-align: middle;">
                                                        <td><a href="" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $product->id }}"><i
                                                                    class="fa fa-trash"
                                                                    style="color: rgb(216, 17, 17)"></i></a></td>
                                                        <td><img src="{{ $product->image_path }}" style="width: 100px"
                                                                alt=""></td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ number_format($product->price, 2) }}
                                                            {{ trans('products_trans.DA') }}</td>
                                                        <form action="{{ route('order.change.qty', $order->id) }}"
                                                            method="POST">
                                                            {{ method_field('PUT') }}
                                                            @csrf
                                                            <td><input type="number" name="qty"
                                                                    value="{{ $product->pivot->quantity }}" min="1"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 80px" onchange="this.form.submit()">
                                                            </td>
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                        </form>
                                                        <td>

                                                            @if ($product->pivot->product_attribute)
                                                                <form action="{{ route('update_attr', $order->id) }}"
                                                                    method="POST">
                                                                    {{ method_field('PUT') }}
                                                                    @csrf
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    <?php
                                                                    $pa_array = unserialize($product->pivot->product_attribute);
                                                                    $i = 0;
                                                                    ?>
                                                                    @foreach ($product->attr_values->unique('product_att_id') as $av)
                                                                        <div class="row mt-2">
                                                                            <div class="col">
                                                                                <select name="p_att[]"
                                                                                    class="form-select" id=""
                                                                                    onchange="this.form.submit()">
                                                                                    @foreach ($av->productAtts->attr_values->where('product_id', $product->id) as $pav)
                                                                                        <option value="{{ $pav->id }}"
                                                                                            {{ $pav->id == $pa_array[$i] ? 'selected' : '' }}>
                                                                                            {{ $pav->value }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $i = $i + 1;
                                                                        ?>
                                                                    @endforeach
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            {{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                            {{ trans('products_trans.DA') }}</td>
                                                    </tr>
                                                    <!--Delete product from order-->
                                                    <div class="modal fade" id="delete{{ $product->id }}"
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
                                                                <form action="{{ route('delete_item', $order->id) }}"
                                                                    method="post">
                                                                    {{ method_field('put') }}
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        {{ trans('categories_trans.Warning_category') }}
                                                                    </div>
                                                                    <input id="id" type="hidden" name="product_id"
                                                                        class="form-control"
                                                                        value="{{ $product->id }}">
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
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold">{{ trans('orders_trans.total') }}:</h5>
                                        <h5 class="fw-bold">{{ number_format($order->total_price, 2) }}
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
                    <button type="submit"
                        class="btn btn-primary print-btn">{{ trans('categories_trans.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- addressModal add model -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('orders_trans.shipping_address') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('order_address_update', $order->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="modal-body">
                        {{-- body --}}
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $order->address }}" placeholder="1234 Main St" required>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{ $order->state }}" placeholder="State" required>
                            </div>
                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="pincode"
                                    value="{{ $order->pincode }}" placeholder="" required>
                            </div>
                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ $order->country }}" placeholder="Country" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('categories_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- statusModal add model -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('orders_trans.edit_status') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('order_status_update', $order->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="modal-body">
                        {{-- body --}}
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="text-muted mb-0">{{ trans('orders_trans.edit_status') }}</p>
                                <hr class="dropdown-divider" />
                                <label for="status" class="form-label">{{ trans('orders_trans.status') }} :</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                        {{ trans('orders_trans.new') }}</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>
                                        {{ trans('orders_trans.pending') }}</option>
                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>
                                        {{ trans('orders_trans.shipped') }}</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <p class="text-muted mb-0">{{ trans('orders_trans.paid') }}</p>
                                <hr class="dropdown-divider" />
                                <label for="paid" class="form-label">{{ trans('orders_trans.order_paid') }} :</label>
                                <select name="paid" id="paid" class="form-select">
                                    <option value="0" {{ $order->paid == 0 ? 'selected' : '' }}>
                                        {{ trans('orders_trans.not_paid') }}</option>
                                    <option value="1" {{ $order->paid == 1 ? 'selected' : '' }}>
                                        {{ trans('orders_trans.yes_paid') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('categories_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
