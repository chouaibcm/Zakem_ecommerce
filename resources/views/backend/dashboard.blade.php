@extends('layouts.adminlayout')

@section('css')
    <style>
        a {
            text-decoration: none;
            color: gray;
        }

        a:hover {
            color: black;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 fw-bold fs-3">
                {{ trans('main_trans.Dashboard_page') }}
            </div>
        </div>
        {{-- 4 cards orders clients categories products --}}
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="me-2 text-danger fw-bold fs-1">
                                <i class="bi bi-bookmarks"></i>
                            </span>
                            <div>
                                <h6 class="card-title">{{ trans('main_trans.categories') }}</h6>
                                <h3 class="text-end">{{ $categories_count }}</h3>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0"><a href="{{ route('categories.index') }}"><i
                                    class="bi bi-bookmarks"></i> {{ trans('main_trans.all_categories') }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="me-2 text-success fw-bold fs-1">
                                <i class="bi bi-people"></i>
                            </span>
                            <div>
                                <h6 class="card-title">{{ trans('main_trans.clients') }}</h6>
                                <h3 class="text-end">{{ $users_count }}</h3>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0"><a href="{{ route('clients.index') }}"><i class="bi bi-people"></i>
                                {{ trans('main_trans.all_clients') }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="me-2 text-primary fw-bold fs-1">
                                <i class="bi bi-shop"></i>
                            </span>
                            <div>
                                <h6 class="card-title">{{ trans('main_trans.products') }}</h6>
                                <h3 class="text-end">{{ $products_count }}</h3>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0"><a href="{{ route('products.index') }}"><i class="bi bi-shop"></i>
                                {{ trans('main_trans.all_products') }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="me-2 text-warning fw-bold fs-1">
                                <i class="bi bi-cart"></i>
                            </span>
                            <div>
                                <h6 class="card-title">{{ trans('main_trans.orders') }}</h6>
                                <h3 class="text-end">{{ $orders_count }}</h3>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0"><a href="{{ route('orders.index') }}"><i class="bi bi-cart"></i>
                                {{ trans('main_trans.all_orders') }}</a></p>
                    </div>
                </div>
            </div>

        </div>
        {{-- -------------------------------------- --}}
        {{-- monthly and daily royalties --}}
        <div class="row">

            <div class="col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <span class="text-success fw-bold" style="size: 70px">
                                    <i class="bi bi-cash-stack fa-4x"></i>
                                </span>
                            </div>
                            <div class="text-end">
                                <p class="card-text text-dark mb-0">{{ trans('main_trans.royalties_month') }}</p>
                                @php
                                    use Carbon\Carbon;
                                    $dateE = Carbon::now()->format('d-m-Y');
                                    $dateB = Carbon::now()
                                        ->startOfMonth()
                                        ->format('d-m-Y');
                                    
                                @endphp
                                <p class="card-text text-dark mb-0">{{ $dateB }} {{ trans('main_trans.to') }}
                                    {{ $dateE }}</p>
                                <h4>{{ number_format($month_price, 2) }} {{ trans('products_trans.DA') }}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fa fa-money mr-1" aria-hidden="true"></i>
                            {{ trans('main_trans.royalties_month') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <span class="text-success fw-bold" style="size: 70px">
                                    <i class="bi bi-cash-stack fa-4x"></i>
                                </span>
                            </div>
                            <div class="text-end">
                                <p class="card-text text-dark mb-0">{{ trans('main_trans.royalties_today') }}</p>
                                <p class="card-text text-dark mb-0">{{ $dateE }}</p>
                                <h4>{{ number_format($today_price, 2) }} {{ trans('products_trans.DA') }}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fa fa-money mr-1" aria-hidden="true"></i>
                            {{ trans('main_trans.royalties_today') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- -------------------------------------- --}}
        <hr>
        <div class="row mt-2 mb-2">
            <div class="col">

                <form action="{{ route('dashboard') }}" method="GET">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Order in this Period:</label></div>
                        <div class="col-md-10">
                            <div class="d-flex justify-content-inline">
                                <div class="input-group">
                                    <input type="text" name="date2" class="form-control anotherSelector" placeholder="{{ $dateBorder }} to {{ $dateEorder }}">
                                    <div class="input-group-append  me-2">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit"> apply</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row">
        <div class="col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <span class="text-warning fw-bold" style="size: 70px">
                                <i class="bi bi-cart fa-4x"></i>
                                
                            </span>
                        </div>
                        <div class="text-end">
                            <p class="card-text text-dark mb-0">Number Of Order between:</p>
                            <p class="card-text text-dark mb-0">{{ $dateBorder }} {{ trans('main_trans.to') }}
                                {{ $dateEorder }}</p>
                            <h3>{{$order_between->count()}} Order</h3>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-money mr-1" aria-hidden="true"></i>
                        <i class="bi bi-cart  mr-1"></i>
                        Orders
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <span class="text-warning fw-bold" style="size: 70px">
                                <i class="bi bi-cash-stack fa-4x"></i>
                            </span>
                        </div>
                        <div class="text-end">
                            <p class="card-text text-dark mb-0">Royalties in this period</p>
                            <p class="card-text text-dark mb-0">{{ $dateBorder }} {{ trans('main_trans.to') }}
                                {{ $dateEorder }}</p>
                            <h4>{{ number_format($between_price, 2) }} {{ trans('products_trans.DA') }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-money mr-1" aria-hidden="true"></i>
                        Royalties in this period
                    </p>
                </div>
            </div>
        </div>
        </div>
        <hr>
        {{-- order chart --}}
        <div class="row py-3 ">
            <div class="col-md-2 mt-2">
                <form action="{{ route('dashboard') }}" method="GET">
                    <select class="form-select" data-style="btn-info" name="choose" required
                        onchange="this.form.submit()">
                        <option value="0" selected>{{ trans('main_trans.this_month') }}</option>
                        
                        <option value="1" {{ request()->choose == 1 ? 'selected' : '' }}>
                            {{ trans('main_trans.last_three_month') }}</option>
                        <option value="2" {{ request()->choose == 2 ? 'selected' : '' }}>
                            {{ trans('main_trans.last_six_month') }}</option>
                    </select>
                </form>
            </div>
            <div class="col-md-10">
                {!! $chart->container() !!}
            </div>
        </div>
        {{-- -------------------------------------- --}}
        {{-- top selling --}}
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h4>Top 10 selling</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>{{ trans('categories_trans.category') }}</th>
                                        <th>{{ trans('products_trans.image') }}</th>
                                        <th>{{ trans('products_trans.Name') }}</th>
                                        <th>{{ trans('products_trans.quantity') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topsales as $offresel)
                                        @foreach ($products as $product)
                                            @if ($offresel->product_id == $product->id)
                                                <tr>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td><img src="{{ $product->image_path }}" class="img-fluid"
                                                            style="width: 70px" alt=""></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $offresel->total }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- -------------------------------------- --}}
    </div>
    {!! $chart->script() !!}
@endsection
