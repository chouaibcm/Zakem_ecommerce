@extends('layouts.frontendlay')

@section('content')
<!-- showcase-->
<section id="showcase">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item  carousel-image-1 active">
            <img src="{{ asset('uploads/carousel/image1.jpg') }}" alt="">
          <div class="container">
            <div class="carousel-caption d-none d-sm-block text-right mb-5">
              <h1 class="display-3">Heading one</h1>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In unde voluptatum ab adipisci ipsa hic nulla
                illum. Laudantium, pariatur quasi.</p>
              <a href="#" class="btn btn-danger btn-lg">Sign Up Now</a>
            </div>
          </div>
        </div>

        <div class="carousel-item carousel-image-2">
            <img src="{{ asset('uploads/carousel/image2.jpg') }}" alt="">
          <div class="container">
            <div class="carousel-caption d-none d-sm-block mb-5">
              <h1 class="display-3">Heading two</h1>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In unde voluptatum ab adipisci ipsa hic nulla
                illum. Laudantium, pariatur quasi.</p>
              <a href="#" class="btn btn-primary btn-lg">Learn More</a>
            </div>
          </div>
        </div>

        <div class="carousel-item carousel-image-3">
            <img src="{{ asset('uploads/carousel/image3.jpg') }}" alt="">
          <div class="container">
            <div class="carousel-caption d-none d-sm-block text-right mb-5">
              <h1 class="display-3">Heading Three</h1>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In unde voluptatum ab adipisci ipsa hic nulla
                illum. Laudantium, pariatur quasi.</p>
              <a href="#" class="btn btn-success btn-lg">Take a Look</a>
            </div>
          </div>
        </div>
      </div>

      <a href="#myCarousel" data-bs-slide="prev" class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a href="#myCarousel" data-bs-slide="next" class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </section>
@endsection
