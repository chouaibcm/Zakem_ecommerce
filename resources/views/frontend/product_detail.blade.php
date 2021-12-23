@extends('layouts.frontendlay')

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
                                        <button type="submit" class="btn btn-danger text-white"><i class="bi bi-cart"></i> Add to Card</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <p class="mb-2">Description : {!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
