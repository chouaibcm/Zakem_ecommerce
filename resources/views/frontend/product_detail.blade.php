@extends('layouts.frontendlay')

@section('content')

    <section id="home-icons1" class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h3 class="display-6">{{ $product->name }}</h3>
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
            <div class="card py-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4 text-center">
                            <img src="{{ $product->image_path }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <h3 class="text-warning mb-3">{{ $product->price }} DA</h3>
                            <h3 class="mb-2">Product title {{ $product->title }}</h3>
                            <p class="mb-2">Description : {{ $product->description }}</p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <div class="row mt-2">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <div class="col"
                                        style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                        <label for="qty" class="me-2">Quantity:</label>
                                        <input type="number" class="form-control"  min="1" value="1" name="qty">
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning text-white"> Add to Card</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
