<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
    <!--- Style css -->
    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @endif
    @toastr_css
    <title>ZAKEM</title>
</head>
<body>
    
   <!-- START HERE -->
  <nav class="navbar navbar-expand-sm navbar-light fixed-top py-4" id="main-nav">
    <div class="container">
      <a href="#home" class="navbar-brand">
        {{-- <img src="img/mlogo.png" width="50" height="50" alt=""> --}}
        <h3 class="d-inline align-middle">Mizuxe</h3>
      </a>
      
      <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="#home" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="nav-link">Shop</a>
          </li>
          <li class="nav-item">
            <a href="#authors" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">contact</a>
          </li>
        </ul>
      </div>
      {{-- button ta carte li nhato fiha les produit --}}
      
      <a class="nav-item cartcho" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <i class="bi bi-cart3">
        <span class="position-absolute top-20 start-25 translate-middle badge rounded-pill bg-danger" style="font-size: 12px">
          9
        </span></i>
      </a>
      
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div>
            Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
          </div>
          <div class="dropdown mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
              Dropdown button
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
        </div>
      </div>
      {{-- end of button carte --}}

      <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="#home" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
              <a href="#about" class="nav-link">Register</a>
            </li>
          </ul>
      </div>
    </div>
  </nav>
  <main class="">
    @yield('content')
  </main>
  <footer id="main-footer" class="p-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h4>Contact Us</h4>
          <hr class="dropdown-divider" />
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
          <span><i class="bi bi-geo-alt-fill">  abed brahim hammam debagh</i></span><br>
          <span><i class="bi bi-telephone-fill">  +213 7 94 02 42 89</i></span><br>
          <span><i class="bi bi-send-fill">  Chochouaib@gmail.com</i></span>
        </div>
        <div class="col-md-2">
          <h4>Follow Us</h4>
          <hr class="dropdown-divider" />
          <a href="#"><i class="bi bi-facebook">  facebook</i></a><br>
          <a href="#"><i class="bi bi-instagram">  instagram</i></a><br>
          <a href="#"><i class="bi bi-google">  Google+</i></a><br>
          <a href="#"><i class="bi bi-twitter">  Twitter</i></a><br>
          <a href="#"><i class="bi bi-pinterest">  Pinterest</i></a><br>
          <a href="#"><i class="bi bi-youtube">  Youtube</i></a><br>
        </div>
        <div class="col-md-2">
          <p>Copyright &copy; <span id="year"></span> ZAKEM</p>
        </div>
        <div class="col-md-4">
          <p>Copyright &copy; <span id="year"></span> ZAKEM</p>
        </div>
      </div>
    </div>
  </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ URL::asset('DataTables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('js/script.js') }}"></script>
    @if (App::getLocale() == 'ar')
        <script src="{{ URL::asset('DataTables/rtlscript.js') }}"></script>
    @endif
    @toastr_js
    @toastr_render
    <script>
      $('.carousel'), carousel({
      interval: 6000,
      pause: 'hover'
    });
        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());
        $(document).ready(function () {
            // // image preview
        $(".image").change(function () {
        
            if (this.files && this.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(this.files[0]);
            }
        
        });
        });//end of ready

    </script>
</body>
</html>