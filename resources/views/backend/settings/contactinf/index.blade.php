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
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ trans('settings_trans.contactinformation') }}
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
                                    <i class="bi bi-briefcase"></i>
                                </span>
                                {{ trans('settings_trans.contactinformation') }}
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    @if (auth()->user()->hasPermission('create_settings'))
                                        <a href="{{ Route('settings.create') }}" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#socialModal"><i
                                                class="fa fa-plus"></i>{{ trans('settings_trans.edit_link') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('settings_trans.edit_link') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('settings_trans.contactinf') }}</th>
                                        <th>{{ trans('settings_trans.information') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ trans('settings_trans.address') }}</td>
                                        <td>{{ $contactinf->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>{{ trans('settings_trans.phone') }}</td>
                                        <td>{{ $contactinf->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>{{ trans('settings_trans.email') }}</td>
                                        <td>{{ $contactinf->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>{{ trans('settings_trans.logo1') }}</td>
                                        <td><img src="{{ $contactinf->logo1_path }}" style="width: 100px;"
                                                class="img-thumbnail" alt=""></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>{{ trans('settings_trans.logo2') }}</td>
                                        <td><img src="{{ $contactinf->logo2_path }}" style="width: 100px;"
                                                class="img-thumbnail" alt=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- socialModal add model -->
    <div class="modal fade" id="socialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('settings_trans.contactinformation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contact.update', 'test') }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('settings_trans.contactinf') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        {{-- address --}}
                        <label for="address" class="mr-sm-2">{{ trans('settings_trans.address') }}:</label>
                        <input id="address" type="text" name="address" value="{{ $contactinf->address }}"
                            class="form-control mb-2">
                        {{-- phone --}}
                        <label for="phone" class="mr-sm-2">{{ trans('settings_trans.phone') }}:</label>
                        <input id="phone" type="text" name="phone" value="{{ $contactinf->phone }}"
                            class="form-control mb-2">
                        {{-- email --}}
                        <label for="email" class="mr-sm-2">{{ trans('settings_trans.email') }}:</label>
                        <input id="email" type="email" name="email" value="{{ $contactinf->email }}"
                            class="form-control mb-2">
                             <!-- logo image-->
                             <div class="text-muted small fx-bold text-uppercase px-3">{{ trans('settings_trans.logo_image') }}
                            </div>
                            <hr class="dropdown-divider mb-2" />
                        {{-- logo1 image 1--}}
                            {{-- hna hna --}}
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="logo1" class="form-label">{{ trans('settings_trans.logo1') }}:</label>
                                        <input class="form-control image" name="logo1" type="file" id="logo1">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <img src="{{ $contactinf->logo1_path }}" style="width: 100px;" class="img-thumbnail image-preview" alt="">
                                    </div>
                                </div>
                            </div>
                        {{-- logo2 image 2--}}
                            {{-- hna hna --}}
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="logo2" class="form-label">{{ trans('settings_trans.logo2') }}:</label>
                                        <input class="form-control image2" name="logo2" type="file" id="logo2">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <img src="{{ $contactinf->logo2_path }}" style="width: 100px;" class="img-thumbnail image-preview2" alt="">
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('coupons_trans.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('coupons_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
