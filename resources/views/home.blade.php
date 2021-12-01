@extends('layouts.frontendlay')

@section('content')
    <!-- showcase-->
    <section id="showcase">
        {{-- another one --}}
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php $i = 0; ?>
                @foreach ($sliders as $slider)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                    class="{{ $i == 0 ? 'active' : '' }}" aria-current="true"></button>
                    <?php $i++; ?>
                @endforeach
            </div>
            <div class="carousel-inner">
                {{--  --}}
                <?php $i = 0; ?>
                @foreach ($sliders as $slider)
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <img src="{{ $slider->image_path }}" class="img-fluid" alt="">
                        <div class="carousel-caption d-none d-md-block {{$slider->position}}">
                            <h1 class="display-3">{{ $slider->heading }}</h1>
                            <p>{{ $slider->description }}</p>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
                {{--  --}}
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- end --}}
    </section>
    <section id="home-icons" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 text-center">
                </div>
                <div class="col-md-6 mb-4 text-center">
                    <i class="bi bi-shop fa-3x mb-2"></i>
                    <h3>Feature Products</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, animi?</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <!-- about \ why section -->
    <section id="products_s" class="text-center py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="info-header">
                        <h1 class="text-primary mb-5">New Arrived Products</h1>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                @foreach ($products as $product)
                    <div class="col-md-3  mb-2">
                        <div class="card">
                            <img class="card-img-top" src="{{ $product->image_path }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->title }}</p>
                                <p class="fw-bold text-uppercase price" style="color: gray">{{ $product->price }} DA</p>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="btn btn-warning text-white">Add to carte</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
