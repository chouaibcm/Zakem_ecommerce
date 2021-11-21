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
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.coupons') }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                                    <i class="bi bi-ticket-perferated"></i>
                                </span>
                                {{ trans('coupons_trans.List_coupon') }}
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <!-- add coupon button-->
                                    @if (auth()->user()->hasPermission('create_coupons'))
                                        <a href="{{ Route('coupons.create') }}" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#couponModal"><i
                                                class="fa fa-plus"></i>{{ trans('coupons_trans.add_coupon') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('coupons_trans.add_coupon') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('coupons_trans.nb_coupon') }}</th>
                                        <th>{{ trans('coupons_trans.discount') }}</th>
                                        <th>{{ trans('coupons_trans.min_discount') }}</th>
                                        <th>{{ trans('coupons_trans.status') }}</th>
                                        <th>{{ trans('coupons_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $coupon->nb_coupon }}</td>
                                            <td>{{ $coupon->discount }}  {{ trans('products_trans.DA') }}</td>
                                            <td> {{ trans('coupons_trans.sup') }}: {{ $coupon->min_price }} {{ trans('products_trans.DA') }}</td>
                                            @if ($coupon->status == 1)
                                                <td>{{ trans('coupons_trans.active') }}</td>
                                            @else
                                                <td>{{ trans('coupons_trans.desactive') }}</td>
                                            @endif
                                            <td>
                                                <!--update coupon-->
                                                @if (auth()->user()->hasPermission('update_coupons'))
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $coupon->id }}"
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
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $coupon->id }}"
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
                                        <div class="modal fade" id="edit{{ $coupon->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('coupons_trans.edit_coupon') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('coupons.update', 'test') }}" method="POST">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('coupons_trans.about_coupon') }}
                                                            </div>
                                                            <hr class="dropdown-divider mb-2" />
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="name_ar"
                                                                        class="mr-sm-2">{{ trans('coupons_trans.nb_coupon') }}
                                                                        :</label>
                                                                    <input id="name_ar" type="text" name="nb_coupon"
                                                                        class="form-control" value="{{$coupon->nb_coupon}}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="name_en"
                                                                        class="mr-sm-2">{{ trans('coupons_trans.discount') }}
                                                                        :</label>
                                                                    <input type="number" class="form-control"
                                                                        name="discount" step="any"  value="{{$coupon->discount}}" style="width: 100%">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="name_ar"
                                                                        class="mr-sm-2">{{ trans('coupons_trans.min_discount') }}
                                                                        :</label>
                                                                    <input type="number" name="min_price" step="any" 
                                                                     value="{{$coupon->min_price}}" class="form-control">
                                                                </div>
                                                                <div class="col">
                                                                    <label
                                                                        class="control-label">{{ trans('categories_trans.status') }}
                                                                        :</label>
                                                                    <br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" value="1"
                                                                            type="radio" name="status"
                                                                            id="flexRadioDefault1"  {{$coupon->status==1 ? 'checked':''}}>
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault1">
                                                                            {{ trans('coupons_trans.active') }}
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" value="0"
                                                                            type="radio" name="status"
                                                                            id="flexRadioDefault2" {{$coupon->status==0 ? 'checked':''}}>
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            {{ trans('coupons_trans.desactive') }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $coupon->id }}">
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
                                        <div class="modal fade" id="delete{{ $coupon->id }}" tabindex="-1"
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
                                                            value="{{ $coupon->id }}">
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
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('coupons_trans.add_coupon') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('coupons_trans.about_coupon') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('coupons_trans.nb_coupon') }}
                                    :</label>
                                <input id="name_ar" type="text" name="nb_coupon" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('coupons_trans.discount') }}
                                    :</label>
                                <input type="number" class="form-control" name="discount">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('coupons_trans.min_discount') }}
                                    :</label>
                                <input id="name_ar" type="number" name="min_price" class="form-control">
                            </div>
                            <div class="col">
                                <label class="control-label">{{ trans('categories_trans.status') }} :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="1" type="radio" name="status"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ trans('coupons_trans.active') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="0" type="radio" name="status"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{ trans('coupons_trans.desactive') }}
                                    </label>
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
