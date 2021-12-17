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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/rtlstyle.css') }}">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif
    @toastr_css
    <title>ZAKEM ADMIN</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2 fixed-top">
        <!-- offcarvas trigger-->
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- offcarvas trigger-->
        <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">zakem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="form-inline ms-auto">
                <ul class="navbar-nav mb-2 mb-lg-0">
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
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-fill me-2"></i>{{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">{{ trans('main_trans.home') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                            {{ trans('main_trans.logout') }}
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- navbar -->
    <!-- offcarvas -->
    <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li>
                        <div class="text-muted small fx-bold text-uppercase px-3">{{ trans('main_trans.Dashboard') }}
                        </div>
                    </li>
                    <li>
                        <a class="nav-link px-3 {{ $main_sidebar == 1 ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <span class="me-2">
                                <i class="bi bi-speedometer2"></i>
                            </span>
                            <span>{{ trans('main_trans.Dashboard_page') }}</span>
                        </a>
                    </li>
                    <li class="my-2">
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <div class="text-muted small fx-bold text-uppercase px-3">{{ trans('main_trans.interface') }}
                        </div>
                    </li>
                    <!-- categories -->
                    @if (auth()->user()->hasPermission('read_categories'))
                        <li>
                            <a class="nav-link px-3 sidebar-link {{ $main_sidebar == 2 ? 'active' : '' }}"
                                href="{{ route('categories.index') }}">
                                <span class="me-2">
                                    <i class="bi bi-bookmarks"></i>
                                </span>
                                <span>{{ trans('main_trans.categories') }}</span>
                            </a>
                        </li>
                    @endif
                    <!-- Products -->
                    <li>
                        <a class="nav-link px-3 sidebar-link  {{ $main_sidebar == 3 ? 'active' : '' }}" data-bs-toggle="collapse" href="#collapseproduct" role="button"
                            aria-expanded="false" aria-controls="collapseproduct">
                            <span class="me-2">
                                <i class="bi bi-shop"></i>
                            </span>
                            <span>{{ trans('main_trans.products') }}</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="collapseproduct">
                             <div>
                                 <ul class="navbar-nav ps-3">
                                    <a href="{{ route('products.create') }}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="bi bi-bag-plus"></i>
                                        </span>
                                        <span>{{ trans('products_trans.add_product') }}</span>
                                     </a>
                                     <a href="{{ route('products.index') }}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="bi bi-list-ul"></i>
                                        </span>
                                        <span>{{ trans('products_trans.List_product') }}</span>
                                     </a>
                                     <a href="{{ route('productsatts.index') }}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        <span>{{ trans('products_trans.attr') }}</span>
                                     </a>
                                 </ul>
                             </div>
                        </div>
                    </li>
                    <!-- Orders -->
                    <li>
                        <a class="nav-link px-3 sidebar-link {{ $main_sidebar == 4 ? 'active' : '' }}"
                           href="{{ route('orders.index') }}">
                            <span class="me-2">
                                <i class="bi bi-cart"></i>
                            </span>
                            <span>{{ trans('main_trans.orders') }}</span>
                        </a>
                    </li>
                    <!-- Clients -->
                    <li>
                        <a class="nav-link px-3 sidebar-link {{ $main_sidebar == 5 ? 'active' : '' }}"
                            href="{{ route('clients.index') }}">
                            <span class="me-2">
                                <i class="bi bi-people"></i>
                            </span>
                            <span>{{ trans('main_trans.clients') }}</span>
                        </a>
                    </li>
                    <!-- Coupons -->
                    <li>
                        <a class="nav-link px-3 sidebar-link {{ $main_sidebar == 6 ? 'active' : '' }}" 
                         href="{{ route('coupons.index') }}">
                            <span class="me-2">
                                <i class="bi bi-ticket-perferated"></i>
                            </span>
                            <span>{{ trans('main_trans.coupons') }}</span>
                        </a>
                    </li>
                    <!-- admins-->
                    @if (auth()->user()->hasPermission('read_users'))
                        <li class="my-2">
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <div class="text-muted small fx-bold text-uppercase px-3">
                                {{ trans('main_trans.admins') }}
                            </div>
                        </li>
                        <li>
                            <a class="nav-link px-3 {{ $main_sidebar == 7 ? 'active' : '' }}"
                                href="{{ route('users.index') }}">
                                <span class="me-2">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                <span>{{ trans('main_trans.admins') }}</span>
                            </a>
                        </li>
                    @endif
                    <!-- Settings -->
                    <li class="my-2">
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <div class="text-muted small fx-bold text-uppercase px-3">{{ trans('main_trans.setting') }}
                        </div>
                    </li>
                    
                    {{--  --}}
                    <li>
                        <a class="nav-link px-3 sidebar-link {{ $main_sidebar == 8 ? 'active' : '' }}" data-bs-toggle="collapse" href="#collapsesetting" role="button"
                            aria-expanded="false" aria-controls="collapsesetting">
                            <span class="me-2">
                                <i class="bi bi-gear"></i>
                            </span>
                            <span>{{ trans('main_trans.setting') }}</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="collapsesetting">
                             <div>
                                 <ul class="navbar-nav ps-3 mb-5">
                                    <a href="{{route('settings.index')}}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="bi bi-tv"></i>
                                        </span>
                                        <span>{{ trans('settings_trans.slider_info') }}</span>
                                     </a>
                                     <a href="{{route('socialmedia.index')}}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="bi bi-link"></i>
                                        </span>
                                        <span>{{ trans('settings_trans.socialmedialinks') }}</span>
                                     </a>
                                     <a href="{{route('contact.index')}}" class="nav-link px-3">
                                        <span class="me-2">
                                            <i class="bi bi-briefcase"></i>
                                        </span>
                                        <span>{{ trans('settings_trans.contactinformation') }}</span>
                                     </a>
                                 </ul>
                             </div>
                        </div>
                    </li>
                    {{--  --}}
                </ul>
            </nav>
        </div>
    </div>
    <!-- offcarvas -->
    <main class="mt-5 pt-3">
        @yield('content')
    </main>


{{-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ URL::asset('DataTables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('js/script.js') }}"></script>
    <script src="{{ URL::asset('js/plugins-jquery.js') }}"></script>
    <script src="{{ URL::asset('js/printThis.js') }}"></script>
    @if (App::getLocale() == 'ar')
        <script src="{{ URL::asset('DataTables/rtlscript.js') }}"></script>
    @endif
    @toastr_js
    @toastr_render
    <script>
        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());

    </script>
</body>

</html>
