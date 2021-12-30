<!DOCTYPE html>
<html lang="en" {{ App::getLocale() == 'ar' ? 'dir=rtl' : '' }}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" />

    <!--- Style css -->
    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/frontend/rtlstyle.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">


    @else
        <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @endif
    @yield('css')
    @toastr_css
    <title>ZAKEM</title>
</head>

<body>

    <!-- START HERE -->
    <div id="main-nav">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('uploads/logo/logo.png') }}" class="img-fluid" width="50" height="50" alt="">
                <h3 class="d-inline align-middle">ZAKEM</h3>
            </a>

            {{-- button ta carte li nhato fiha les produit --}}
            <ul class="navbar-nav cartcho">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                        aria-controls="offcanvasExample">
                        <i class="bi bi-cart3">
                            <span class="position-absolute start-25 translate-middle badge rounded-pill bg-dark"
                                style="font-size: 12px">
                                {{ Cart::content()->count() }}
                            </span>
                        </i>
                    </a>
                </li>
            </ul>

            <div class="offcanvas offcanvas-end " style="width: 700px" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">My Carte</h3>

                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <hr class="dropdown-divider mb-3" />
                    <h5 class="display-6 text-center mb-3">In Your Shopping Cart: {{ Cart::content()->count() }} Items
                    </h5>
                    @if (Cart::content()->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Product</th>
                                        <th>price</th>
                                        <th>Quantity</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Cart::content()->count()>0)
                                        
                                        @foreach (Cart::content() as $product)
                                            <tr style="vertical-align: middle;">
                                                <td>
                                                    <a href="{{ route('cart.delete', $product->rowId) }}"><i
                                                            class="fa fa-trash"
                                                            style="color: rgb(216, 17, 17)"></i></a>
                                                    <img src="{{ $product->model->image_path }}"
                                                        class="img-fluid text-center" style="width: 100px;" alt="">
                                                    {{ $product->name }}
                                                </td>
                                                <td>{{ number_format($product->price,2) }} DA</td>
                                                <form action="{{ route('cart.change.qty') }}" method="GET">
                                                    <td><input type="number" name="qty" value="{{ $product->qty }}" min="1"
                                                            class="form-control form-control-sm" style="width: 80px"
                                                            onchange="this.form.submit()">
                                                    </td>
                                                    <input type="hidden" name="product_id" value="{{ $product->rowId }}">
                                                </form>
                                                <td>{{ number_format($product->total(),2) }} DA</td>
                                            </tr>
                                        @endforeach
                                        
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <h3>Total : {{ number_format(Cart::total(),2) }} {{ trans('products_trans.DA') }}</h3>

                        </div>
                    @endif
                </div>
                <div class="offcanvas-footer">
                    <div class="container">
                        @if (Cart::content()->count() > 0)
                            <hr class="dropdown-divider" />
                            <div class="row mb-3">
                                <div class="col text-end">
                                    <a href="{{route('mycart')}}" class="btn btn-outline-primary">Expand cart</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- end of button carte --}}

            <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link {{ $main_nav = 1 ? 'active' : '' }}">{{ trans('main_trans.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('shop')}}" class="nav-link">{{ trans('main_trans.shop') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                {{ LaravelLocalization::getCurrentLocaleName() }}
                            @else
                                {{ LaravelLocalization::getCurrentLocaleName() }}
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (auth()->user()->isAdmin())
                                    <!-- if you are admin-->
                                    @if (auth()->user()->hasPermission('read_dashboards'))
                                        <!-- if you have access to dashboard-->
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                    @else
                                        @if (auth()->user()->hasPermission('read_categories'))
                                            <!-- if you have access to categories-->
                                            <a class="dropdown-item"
                                                href="{{ route('categories.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                        @else
                                            @if (auth()->user()->hasPermission('read_products'))
                                                <!-- if you have access to products-->
                                                <a class="dropdown-item"
                                                    href="{{ route('products.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                            @else
                                                @if (auth()->user()->hasPermission('read_orders'))
                                                    <!-- if you have access to orders-->
                                                    <a class="dropdown-item"
                                                        href="{{ route('orders.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                                @else
                                                    @if (auth()->user()->hasPermission('read_clients'))
                                                        <!-- if you have access to clients-->
                                                        <a class="dropdown-item"
                                                            href="{{ route('clients.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                                    @else
                                                        @if (auth()->user()->hasPermission('read_coupons'))
                                                            <!-- if you have access to coupons-->
                                                            <a class="dropdown-item"
                                                                href="{{ route('coupons.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                                        @else
                                                            @if (auth()->user()->hasPermission('read_users'))
                                                                <!-- if you have access to users-->
                                                                <a class="dropdown-item"
                                                                    href="{{ route('users.index') }}">{{ trans('main_trans.Dashboard_page') }}</a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                                <a class="dropdown-item" href="{{ route('my_orders', auth()->user()->id) }}">
                                    {{ trans('main_trans.my_orders') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ trans('main_trans.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>


        </div>
    </nav>
</div>
    <main class="">
        @yield('content')
    </main>
    <footer id="main-footer" class="p-4">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <hr class="dropdown-divider" />
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    <span><i class="bi bi-geo-alt-fill"> {{ $contactinf->address }}</i></span><br>
                    <span><i class="bi bi-telephone-fill"> {{ $contactinf->phone }}</i></span><br>
                    <span><i class="bi bi-send-fill"> {{ $contactinf->email }}</i></span><br>
                </div>
                @if ($socialmedia->facebook or $socialmedia->instagram or $socialmedia->google or $socialmedia->twitter or $socialmedia->pinterest or $socialmedia->youtube)
                    <div class="col">
                        <h4>Follow Us</h4>
                        <hr class="dropdown-divider" />
                        @if ($socialmedia->facebook)
                            <a href="#"><i class="bi bi-facebook"> facebook</i></a><br>
                        @endif
                        @if ($socialmedia->instagram)
                            <a href="#"><i class="bi bi-instagram"> instagram</i></a><br>
                        @endif
                        @if ($socialmedia->google)
                            <a href="#"><i class="bi bi-google"> Google+</i></a><br>
                        @endif
                        @if ($socialmedia->twitter)
                            <a href="#"><i class="bi bi-twitter"> Twitter</i></a><br>
                        @endif
                        @if ($socialmedia->pinterest)
                            <a href="#"><i class="bi bi-pinterest"> Pinterest</i></a><br>
                        @endif
                        @if ($socialmedia->youtube)
                            <a href="#"><i class="bi bi-youtube"> Youtube</i></a><br>
                        @endif
                    </div>
                @endif
                <div class="col">

                </div>
                <div class="col d-flex justify-content-end">
                    <div>
                        <img src="{{ asset('uploads/logo/logo1.png') }}" style="width: 200px;" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
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
    
    <script src="{{ URL::asset('plugins/ckeditor/ckeditor.js') }}"></script>
    @toastr_js
    @toastr_render
    <script>
        $('.carousel'), carousel({
            interval: 6000,
            pause: 'hover'
        });
        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());
        $(document).ready(function() {
            // // image preview
            $(".image").change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });
            CKEDITOR.config.language =  '{{ app()->getLocale() }}';
        }); //end of ready
    </script>
</body>

</html>
