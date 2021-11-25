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
            <img class="img-fluid" src="{{ asset('uploads/carousel/image1.jpg') }}" alt="">
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
            <img class="img-fluid" src="{{ asset('uploads/carousel/image2.jpg') }}" alt="">
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
            <img class="img-fluid" src="{{ asset('uploads/carousel/image3.jpg') }}" alt="">
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
<section id="about" class="text-center py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="info-header">
          <h1 class="text-primary mb-5">New Arrived Products</h1>
        </div>
      </div>      
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="{{ asset('uploads/carousel/image1.jpg') }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="{{ asset('uploads/carousel/image2.jpg') }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="{{ asset('uploads/carousel/image3.jpg') }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="{{ asset('uploads/carousel/image1.jpg') }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
