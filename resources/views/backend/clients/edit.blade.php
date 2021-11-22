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
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('clients.index') }}">{{ trans('main_trans.clients') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

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
                    <i class="bi bi-people"></i>
                </span>
                {{ $user->name }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('clients.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('put') }}
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="image-upload imghov">
                                            <img src="{{ $user->image_path }}" style="width: 200px" id="photo" class="image-preview">
                                            <input class="form-control image" type="file" name="image" id="file">
                                            <label for="file" id="uploadBtn">{{ trans('clients_trans.update_img') }}</label>
                                        </div>
                                    </div>
                                    <div class="text-muted small fx-bold text-uppercase px-3">
                                        {{ trans('clients_trans.show') }}
                                    </div>
                                    <hr class="dropdown-divider mb-2" />
                                    
                                    <label class="mr-sm-2">{{ trans('clients_trans.Name') }} :</label>
                                    <input type="text" class="form-control mb-2" name="name" value="{{ $user->name }}">
                                    <label class="mr-sm-2">{{ trans('users_trans.email') }} :</label>
                                    <input type="email" class="form-control mb-2" name="email" value="{{ $user->email }}">    
                                    <label class="mr-sm-2">{{ trans('clients_trans.mobile') }} :</label>
                                    <input type="text" class="form-control mb-2" name="mobile" value="{{ $user->mobile }}">                                
                                </div>
                                <div class="col">
                                    <div class="text-muted small fx-bold text-uppercase px-3">
                                        {{ trans('clients_trans.address') }}
                                    </div>
                                    <hr class="dropdown-divider mb-2" />
                                    <label class="mr-sm-2">{{ trans('clients_trans.address') }} :</label>
                                    <input type="text" class="form-control mb-2" name="address" value="{{ $user->address }}">
                                    <label class="mr-sm-2">{{ trans('clients_trans.city') }} :</label>
                                    <input type="text" class="form-control mb-2" name="city" value="{{ $user->city }}">
                                    <label class="mr-sm-2">{{ trans('clients_trans.state') }} :</label>
                                    <input type="text" class="form-control mb-2" name="state" value="{{ $user->state }}">
                                    <label class="mr-sm-2">{{ trans('clients_trans.country') }} :</label>
                                    <input type="text" class="form-control mb-2" name="country" value="{{ $user->country }}">
                                    <label class="mr-sm-2">{{ trans('clients_trans.pincode') }} :</label>
                                    <input type="text" class="form-control mb-4" name="pincode" value="{{ $user->pincode }}">
                                    <hr class="dropdown-divider mb-2" />
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary"
                                            type="submit">{{ trans('products_trans.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
