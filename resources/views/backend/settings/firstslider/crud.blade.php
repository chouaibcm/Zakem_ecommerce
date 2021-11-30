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
                                    {{ trans('settings_trans.title_page') }}
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
                                    <!-- add coupon button-->
                                    @if (auth()->user()->hasPermission('create_settings'))
                                        <a href="{{ Route('settings.create') }}" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#couponModal"><i
                                                class="fa fa-plus"></i>{{ trans('settings_trans.add_slider') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('settings_trans.add_slider') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('settings_trans.image') }}</th>
                                        <th>{{ trans('settings_trans.heading') }}</th>
                                        <th>{{ trans('settings_trans.description') }}</th>
                                        <th>{{ trans('coupons_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{ $slider->image_path }}" style="width: 150px;"
                                                    class="img-thumbnail" alt=""></td>
                                            <td>{{ $slider->heading }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td>
                                                <!--update coupon-->
                                                @if (auth()->user()->hasPermission('update_coupons'))
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $slider->id }}"
                                                        title="{{ trans('coupons_trans.Edit') }}"><i
                                                            class="fa fa-edit"></i></button>
                                                @else
                                                    <button class="btn btn-primary btn-sm"
                                                        title="{{ trans('coupons_trans.Edit') }}" disabled><i
                                                            class="fa fa-edit"></i></button>
                                                @endif
                                                <!--Delete coupon-->
                                                @if (auth()->user()->hasPermission('delete_coupons'))
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $slider->id }}"
                                                        title="{{ trans('coupons_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        title="{{ trans('coupons_trans.Delete') }}" disabled><i
                                                            class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!--Edit coupon-->
                                        <div class="modal fade" id="edit{{ $slider->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('settings_trans.slider_info') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('settings.update', 'test') }}" method="POST" enctype="multipart/form-data">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <div class="row">
                                                                {{-- english info --}}
                                                                <div class="col">
                                                                    <div
                                                                        class="text-muted small fx-bold text-uppercase px-3">
                                                                        {{ trans('settings_trans.slider_info_en') }}
                                                                    </div>
                                                                    <hr class="dropdown-divider mb-2" />

                                                                    <label for="name_ar"
                                                                        class="mr-sm-2">{{ trans('settings_trans.heading_en') }}:</label>
                                                                    <input id="name_ar" type="text" name="heading_en"
                                                                        value="{{ $slider->getTranslation('heading', 'en') }}"
                                                                        class="form-control mb-2">
                                                                    <div class="form-floating mb-2">
                                                                        <textarea class="form-control"
                                                                            name="description_en"
                                                                            placeholder="Leave a comment here"
                                                                            id="floatingTextarea">{{ $slider->getTranslation('description', 'en') }}</textarea>
                                                                        <label
                                                                            for="floatingTextarea">{{ trans('settings_trans.description_en') }}</label>
                                                                    </div>
                                                                </div>
                                                                {{-- arabic info --}}
                                                                <div class="col">
                                                                    <div
                                                                        class="text-muted small fx-bold text-uppercase px-3">
                                                                        {{ trans('settings_trans.slider_info_ar') }}
                                                                    </div>
                                                                    <hr class="dropdown-divider mb-2" />

                                                                    <label for="name_ar"
                                                                        class="mr-sm-2">{{ trans('settings_trans.heading_ar') }}:</label>
                                                                    <input id="name_ar" type="text" name="heading_ar"
                                                                        value="{{ $slider->getTranslation('heading', 'ar') }}"
                                                                        class="form-control mb-2">
                                                                    <div class="form-floating mb-2">
                                                                        <textarea class="form-control"
                                                                            name="description_ar"
                                                                            placeholder="Leave a comment here"
                                                                            id="floatingTextarea">{{ $slider->getTranslation('description', 'ar') }}</textarea>
                                                                        <label
                                                                            for="floatingTextarea">{{ trans('settings_trans.description_ar') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- slider position --}}
                                                            <hr class="dropdown-divider mb-2" />
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label
                                                                        class="control-label">{{ trans('settings_trans.position') }}
                                                                        :</label>
                                                                    <br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" value="text-start"
                                                                            type="radio" name="position"
                                                                            id="flexRadioDefault1">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault1">
                                                                            {{ trans('settings_trans.left') }}
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" value="text-center"
                                                                            type="radio" name="position"
                                                                            id="flexRadioDefault2" checked>
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            {{ trans('settings_trans.center') }}
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" value="text-end"
                                                                            type="radio" name="position"
                                                                            id="flexRadioDefault2">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            {{ trans('settings_trans.right') }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- slider image-->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('settings_trans.image') }}
                                                            </div>
                                                            <hr class="dropdown-divider mb-2" />
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="formFile"
                                                                            class="form-label">{{ trans('products_trans.import') }}:</label>
                                                                        <input class="form-control image" name="image"
                                                                            type="file" id="formFile">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <img src="{{ $slider->image_path }}"
                                                                            style="width: 300px;"
                                                                            class="img-thumbnail image-preview" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $slider->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ trans('coupons_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ trans('coupons_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Delete coupon-->
                                        <div class="modal fade" id="delete{{ $slider->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('coupons_trans.delete_coupon') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('coupons.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('categories_trans.Warning_category') }}
                                                        </div>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $slider->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ trans('coupons_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('coupons_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- couponModal add model -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('settings_trans.slider_info_en') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="row">
                            {{-- english info --}}
                            <div class="col">
                                <div class="text-muted small fx-bold text-uppercase px-3">
                                    {{ trans('settings_trans.slider_info_en') }}
                                </div>
                                <hr class="dropdown-divider mb-2" />

                                <label for="name_ar"
                                    class="mr-sm-2">{{ trans('settings_trans.heading_en') }}:</label>
                                <input id="name_ar" type="text" name="heading_en" class="form-control mb-2">
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" name="description_en"
                                        placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">{{ trans('settings_trans.description_en') }}</label>
                                </div>
                            </div>
                            {{-- arabic info --}}
                            <div class="col">
                                <div class="text-muted small fx-bold text-uppercase px-3">
                                    {{ trans('settings_trans.slider_info_ar') }}
                                </div>
                                <hr class="dropdown-divider mb-2" />

                                <label for="name_ar"
                                    class="mr-sm-2">{{ trans('settings_trans.heading_ar') }}:</label>
                                <input id="name_ar" type="text" name="heading_ar" class="form-control mb-2">
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" name="description_ar"
                                        placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">{{ trans('settings_trans.description_ar') }}</label>
                                </div>
                            </div>
                        </div>
                        {{-- slider position --}}
                        <hr class="dropdown-divider mb-2" />
                        <div class="row mb-2">
                            <div class="col">
                                <label class="control-label">{{ trans('settings_trans.position') }} :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="text-start" type="radio" name="position"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ trans('settings_trans.left') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="text-center" type="radio" name="position"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{ trans('settings_trans.center') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="text-end" type="radio" name="position"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{ trans('settings_trans.right') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- slider image-->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('settings_trans.image') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="formFile"
                                        class="form-label">{{ trans('products_trans.import') }}:</label>
                                    <input class="form-control image" name="image" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <img src="{{ asset('uploads/carousel/default.png') }}" style="width: 300px;"
                                        class="img-thumbnail image-preview" alt="">
                                </div>
                            </div>
                        </div>
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
