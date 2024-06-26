@extends('layouts.frontendlay')

@section('css')
    <style>
        #shop .nav {
            border-top: 1px solid rgba(83, 83, 83, 0.678);
            border-bottom: 1px solid rgba(83, 83, 83, 0.678);
        }

        #shop .nav .nav-link {
            color: rgba(83, 83, 83, 0.938);
        }

        #shop .nav .nav-link:hover {
            color: black;
        }

    </style>
@endsection

@section('content')
    <section id="shop-bar" class="py-2 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 text-center">
                </div>
                <div class="col-md-6 mb-4 text-center">
                    <i class="bi bi-shop fa-3x mb-2"></i>
                    <h3>{{ trans('main_trans.products') }}</h3>
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <section id="shop" class="">
        <div class="container">
            <ul class="nav justify-content-center mb-2">
                @foreach ($categories as $category)
                    <form action="{{ route('shop') }}" method="GET">
                        {{-- onclick="this.form.submit()" --}}
                        <input type="hidden" class="form-control" name="category_id" value="{{ $category->id }}">

                        <li class="nav-item"><a href="" class="nav-link"
                                onclick="this.closest('form').submit();return false;">{{ $category->name }}</a>
                        </li>
                    </form>
                @endforeach
            </ul>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <h4 class="fw-bold"> Products</h4>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Order by
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">New</a></li>
                                <li><a class="dropdown-item" href="#">Features</a></li>
                                <li><a class="dropdown-item" href="#">Old</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="mb-2">
                    <div class="row">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                @php
                                    $review_rating_global = 0;
                                    $nb_review = $product->reviews->count();
                                    foreach ($product->reviews as $review) {
                                        $review_rating_global = $review_rating_global + $review->rating;
                                    }
                                    if ($review_rating_global > 0) {
                                        $rating_moyen = $review_rating_global / $nb_review;
                                    }
                                @endphp
                                <div class="col-md-3  mb-2">
                                    <div class="card product-card h-100">
                                        <a href="{{ route('product_detail', $product->id) }}"><img
                                                class="img-fluid card-img-top" src="{{ $product->image_path }}"
                                                alt="Card image cap">
                                        </a>
                                        <div class="card-body text-start pb-0">
                                            <a href="{{ route('product_detail', $product->id) }}">
                                                <p class="text-muted mb-0">{{ $product->name }}</p>
                                            </a>
                                            {{-- eda ydirlak moyen ta njom --}}
                                            @if ($product->reviews->count() > 0)
                                                <div class="col d-flex justify-content-inline">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($review_rating_global > 0)
                                                            @if ($rating_moyen > $i and $rating_moyen < $i + 1)
                                                                <span><i class="bi bi-star-half"></i></span>
                                                            @else
                                                                @if ($i <= $rating_moyen)
                                                                    <span><i class="bi bi-star-fill"></i></span>
                                                                @else
                                                                    <i class="bi bi-star"></i>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                        @endif
                                                    @endfor
                                                    <h6 class="ms-2">({{ $product->reviews->count() }})</h6>
                                                </div>
                                            @endif
                                            {{-- --------------------------------- --}}
                                            <a href="{{ route('product_detail', $product->id) }}">
                                                <p class="card-text fw-bold">{{ $product->title }}</p>
                                            </a>
                                            @if ($product->discount)
                                                <div class="d-flex justify-content-inline">
                                                    <p class="fw-bold text-uppercase me-2" style="color: rgb(99, 99, 99)">
                                                        <del>{{ number_format($product->price, 2) }}{{ trans('products_trans.DA') }}</del>
                                                    </p>
                                                    <p class="fw-bold text-uppercase" style="color: rgb(89, 153, 250)">
                                                        {{ number_format($product->discount, 2) }}
                                                        {{ trans('products_trans.DA') }}</p>
                                                </div>
                                            @else

                                                <p class="fw-bold text-uppercase" style="color: rgb(89, 153, 250)">
                                                    {{ number_format($product->price, 2) }}
                                                    {{ trans('products_trans.DA') }}</p>
                                            @endif
                                        </div>
                                        <div class="card-footer d-flex justify-content-center" style="background: white">
                                            <a href="{{ route('product_detail', $product->id) }}"
                                                class="btn btn-dark text-white" style="width: 200px">View More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {{ $products->appends(request()->query())->links() }}
                            </div>

                        @else
                            <div class="d-flex justify-content-center">
                                <h4>No Data</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
