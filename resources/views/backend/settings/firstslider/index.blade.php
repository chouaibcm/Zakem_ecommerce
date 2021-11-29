@extends('layouts.adminlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 fw-bold">
                <div class="card mb-2">
                    <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><span class="me-2"><i
                                            class="bi bi-speedometer2"></i></span><a
                                        href="{{ route('dashboard') }}">{{ trans('main_trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('settings_trans.title_page') }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
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
                        <div class="row mb-2">
                            <div class="col-md-6 fw-bold fs-3">
                                <span class="me-2">
                                    <i class="bi bi-gear"></i>
                                </span>
                                {{ trans('settings_trans.title_page') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-muted small fx-bold text-uppercase p-0">
                                    {{ trans('settings_trans.preview') }}
                                </div>
                            </div>
                        </div>
                        <hr class="dropdown-divider" />

                        {{-- card --}}
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="text-uppercase">{{ trans('settings_trans.slider_privew') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-end">
                                            {{-- crud sliders --}}
                                        <a href="{{ Route('settings.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>{{ trans('settings_trans.edit_setting') }}</a></div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- another one --}}
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <?php $i = 0; ?>
                                        @foreach ($sliders as $slider)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"
                                                aria-current="true"></button>
                                            <?php $i++; ?>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        {{--  --}}
                                        <?php $i = 0; ?>
                                        @foreach ($sliders as $slider)
                                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                <img src="{{ $slider->image_path }}" class="img-fluid" alt="">
                                                <div class="carousel-caption d-none d-md-block">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
