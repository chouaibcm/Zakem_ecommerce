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
                                    {{ trans('settings_trans.socialmedia') }}
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
                                        <th>{{ trans('settings_trans.socialmedia') }}</th>
                                        <th>{{ trans('settings_trans.link') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-facebook"></i></td>
                                        <td>{{ trans('settings_trans.facebook') }}</td>
                                        <td><a target="_blank" href="{{ $socialmedia->facebook }}">{{ $socialmedia->facebook }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-instagram"></i></td>
                                        <td>{{ trans('settings_trans.instagram') }}</td>
                                        <td><a href="{{ $socialmedia->instagram }}">{{ $socialmedia->instagram }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-google"></i></td>
                                        <td>{{ trans('settings_trans.google') }}</td>
                                        <td><a href="{{ $socialmedia->google }}">{{ $socialmedia->google }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-twitter"></i></td>
                                        <td>{{ trans('settings_trans.twitter') }}</td>
                                        <td><a href="{{ $socialmedia->twitter }}">{{ $socialmedia->twitter }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-pinterest"></i></td>
                                        <td>{{ trans('settings_trans.pinterest') }}</td>
                                        <td><a href="{{ $socialmedia->pinterest }}">{{ $socialmedia->pinterest }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-center"><i class="bi bi-youtube"></i></td>
                                        <td>{{ trans('settings_trans.youtube') }}</td>
                                        <td><a href="{{ $socialmedia->youtube }}">{{ $socialmedia->youtube }}</a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('settings_trans.socialmedia') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('socialmedia.update', 'test') }}" method="POST">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('settings_trans.social_info') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        {{-- facebook --}}
                        <label for="facebook" class="mr-sm-2">{{ trans('settings_trans.facebook') }}:</label>
                        <input id="facebook" type="text" name="facebook" value="{{$socialmedia->facebook}}" class="form-control mb-2">
                        {{-- instagram --}}
                        <label for="instagram" class="mr-sm-2">{{ trans('settings_trans.instagram') }}:</label>
                        <input id="instagram" type="text" name="instagram" value="{{$socialmedia->instagram}}" class="form-control mb-2">
                        {{-- google --}}
                        <label for="google" class="mr-sm-2">{{ trans('settings_trans.google') }}:</label>
                        <input id="google" type="text" name="google" value="{{$socialmedia->google}}" class="form-control mb-2">
                        {{-- twitter --}}
                        <label for="twitter" class="mr-sm-2">{{ trans('settings_trans.twitter') }}:</label>
                        <input id="twitter" type="text" name="twitter" value="{{$socialmedia->twitter}}" class="form-control mb-2">
                        {{-- pinterest --}}
                        <label for="pinterest" class="mr-sm-2">{{ trans('settings_trans.pinterest') }}:</label>
                        <input id="pinterest" type="text" name="pinterest" value="{{$socialmedia->pinterest}}" class="form-control mb-2">
                        {{-- youtube --}}
                        <label for="youtube" class="mr-sm-2">{{ trans('settings_trans.youtube') }}:</label>
                        <input id="youtube" type="text" name="youtube" value="{{$socialmedia->youtube}}" class="form-control mb-2">
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
