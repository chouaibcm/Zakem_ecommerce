@extends('layouts.frontendlay')

@section('css')
    <style>
        #chng-color a {
            text-decoration: none;
            color: gray;
        }

        #chng-color a:hover {
            color: black;
        }

    </style>
@endsection

@section('content')

    <section id="home-icons1" class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">

                </div>
                <div class="col-md-6 mb-4 text-center">
                    <i class="bi bi-person fa-3x mb-2"></i>
                    <h3 class="display-6">{{ trans('main_trans.my_profile') }}</h3>
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <section id="home-icons" class="py-2">
        <div class="container">
            <form action="{{route('update_profile',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
            <div class="d-flex justify-content-center mb-2">
                <div class="image-upload imghov">
                    <img src="{{ $user->image_path }}" style="width: 200px" id="photo" class="image-preview img-fluid">
                    <input class="form-control image" type="file" name="image" id="file">
                    <label for="file" id="uploadBtn">{{ trans('clients_trans.update_img') }}</label>
                </div>
            </div>
            <div class="fw-bold fs-3 text-center mb-2">{{ $user->name }}</div>
            <div class="row">
                <div class="col"> 
                    <div class="text-muted small fx-bold text-uppercase px-3">
                        {{ trans('clients_trans.show') }}
                    </div>
                    <hr class="dropdown-divider mb-2" />
                    
                    <label class="mr-sm-2">{{ trans('clients_trans.Name') }} :</label>
                    <input type="text" class="form-control mb-2" name="name" value="{{ $user->name }}">  
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
                            type="submit">{{ trans('categories_trans.save') }}</button>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </section>

@endsection
