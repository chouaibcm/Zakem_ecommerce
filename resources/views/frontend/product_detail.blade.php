@extends('layouts.frontendlay')
@section('css')
    <style>
        .fa.fa-star{
            color: #e52;
        }
        .far.fa-star{
            color: #e52;
        }
    </style>
@endsection
@section('content')

    <section id="home-icons1" class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    {{-- <h3 class="display-6">{{ $product->name }}</h3> --}}
                </div>
                <div class="col-md-3 mb-4 text-center">
                    {{-- <i class="bi bi-shop fa-3x mb-2"></i>
                <h3>Product Detail</h3> --}}
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <section id="home-icons" class="py-5">
        <div class="container">
            <h3 class="display-6">{{ $product->name }}</h3>
            <div class="card py-5">
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
                    <div class="row">
                        <div class="col-md-6 mb-4 text-center">
                            <img src="{{ $product->image_path }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <h3 class="mb-2">{{ $product->title }}</h3>
                            <hr>
                            <h3 class="mb-2" style="color: gray">{{ number_format($product->price, 2) }} DA</h3>
                            <p class="mb-2">Availability :
                                @if ($product->stock == 0)
                                    <span class="badge bg-success">{{ trans('products_trans.in_stock') }}</span>
                                @else
                                    <span class="badge bg-warning">{{ trans('products_trans.out_stock') }}</span>
                                @endif
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                @if ($product->attr_values->count() > 0)
                                    @foreach ($product->attr_values->unique('product_att_id') as $av)
                                        <div class="row mt-2">
                                            <div class="col-sm-4">
                                                <p>{{ $av->productAtts->name }} :</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <select name="p_att[]" class="form-select" id="" required>
                                                    <option selected>Select {{ $av->productAtts->name }}</option>
                                                    @foreach ($av->productAtts->attr_values->where('product_id', $product->id) as $pav)
                                                        <option value="{{ $pav->id }}">{{ $pav->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row mt-2">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="col-md-4"
                                        style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                        <label for="qty" class="me-2">Quantity:</label>
                                        <input type="number" class="form-control" min="1" value="1" name="qty">
                                    </div>
                                    <div class="col-md-8 text-end">
                                        <div class="form-group d-grid gap-2">
                                            <button type="submit" class="btn btn-danger text-white"><i
                                                    class="bi bi-cart"></i> Add to Card</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <p class="mb-2">Description : {!! $product->description !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-inline">
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

                            @for ($i = 0; $i < 5; $i++)
                                @if ($review_rating_global > 0)
                                    @if ($i < $rating_moyen)
                                        <span class="fa fa-star"></span>
                                    @else
                                        <span class="far fa-star"></span>
                                    @endif
                                @else
                                    <span class="far fa-star"></span>
                                @endif
                            @endfor
                            <h6 class="ms-2">({{ $product->reviews->count() }}) Reviews</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h6>Comments</h6>
                            <hr>
                            <ul class="list-unstyled">
                                @foreach ($product->reviews as $review)
                                    <li class="media">
                                        <div class="d-flex justify-content-inline">
                                            <img class="mr-3 img-fluid rounded-circle"
                                                src="{{ $review->user->image_path }}" style="width: 100px">
                                            <div class="media-body ms-5">
                                                <h5>{{ $review->user->name }}</h5>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $review->rating)
                                                        <span class="fa fa-star checked" style="color: "></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                                {!! $review->review !!}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
