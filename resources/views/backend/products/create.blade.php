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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('products.index') }}">{{ trans('products_trans.List_product') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ trans('products_trans.add_product') }}</li>
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
                        @if ($categories->count() > 0)
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-muted small fx-bold text-uppercase px-3">
                                {{ trans('products_trans.about_product') }}
                            </div>
                            <hr class="dropdown-divider mb-2" />
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- name and title of product-->
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="mr-sm-2">{{ trans('products_trans.Name') }}
                                            :</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label class="mr-sm-2">{{ trans('products_trans.title') }}
                                            :</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                                <!-- category of product and status-->
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="control-label">{{ trans('categories_trans.Name') }} :</label>
                                        <select class="form-select" name="category_id"
                                            aria-label="Default select example">
                                            <option value="0" selected> {{ trans('products_trans.all_categories') }}
                                                @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="control-label">{{ trans('categories_trans.status') }} :</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" value="1" type="radio" name="status" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                {{ trans('products_trans.published') }}
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                {{ trans('products_trans.draft') }}
                            </label>
                        </div>
                    </div>
                </div>
                <!-- price and code of product-->
                <div class="row mb-2">
                    <div class="col">
                        <label class="control-label">{{ trans('products_trans.price') }} :</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">{{ trans('products_trans.DA') }}</span>
                            <input type="number" name="price" class="form-control"
                                placeholder="{{ trans('products_trans.price') }}" aria-label="Username"
                                aria-describedby="basic-addon1" min="1">
                        </div>
                    </div>
                    <div class="col">
                        <label class="mr-sm-2">{{ trans('products_trans.p_code') }}
                            :</label>
                        <input type="text" name="p_code" class="form-control">
                    </div>
                </div>
                <!-- product description-->
                <div class="text-muted small fx-bold text-uppercase px-3">
                    {{ trans('products_trans.description') }}
                </div>
                <hr class="dropdown-divider mb-2" />
                <div class="row mb-2">
                    <div class="col">
                        <label class="control-label">{{ trans('products_trans.description') }}</label>
                        <textarea class="form-control ckeditor" name="description"></textarea>
                    </div>
                </div>
                <!-- product image-->
                <div class="row">
                    <div class="text-muted small fx-bold text-uppercase px-3">
                        {{ trans('products_trans.image') }}
                    </div>
                    <hr class="dropdown-divider mb-2" />
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="formFile"
                                        class="form-label">{{ trans('products_trans.import') }}:</label>
                                    <input class="form-control image" name="image" type="file" accept="image/*"
                                        id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <img src="{{ asset('uploads/product_img/default.png') }}" style="width: 300px;"
                                        class="img-thumbnail image-preview" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="formFile" class="form-label">{{ trans('products_trans.import') }}:</label>
                        <input class="form-control" name="albume[]" type="file" accept="image/*" multiple>
                    </div>
                </div>
                {{-- stock --}}
                <div class="row mb-2">
                    <div class="col">
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('products_trans.stock') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <label class="control-label mb-2">{{ trans('products_trans.stock') }} :</label>
                        <select class="form-select" name="stock" id="" aria-label="Default select example">
                            <option value="0" selected> {{ trans('products_trans.in_stock') }}
                            <option value="1"> {{ trans('products_trans.out_stock') }}
                        </select>
                    </div>
                </div>
                {{-- products attribute li tat3awad --}}
                <div id="accordion">
                    <div class="d-flex justify-content-between">
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('products_trans.attr') }}
                        </div>
                        <div class="2">
                            <div class="d-flex flex-row align-items-start bd-highlight mb-0">
                                <div class="bd-highlight me-2">
                                    <div class="text-muted small fx-bold text-uppercase">Exist!</div>
                                </div>
                                <div class="bd-highlight">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            name="att_on" value="1" data-bs-target="#collapse1" data-bs-parent="#accordion"
                                            data-bs-toggle="collapse">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="dropdown-divider mb-2" />
                    <div id="collapse1" class="collapse">
                        <div class="row targetDiv  mb-2" id="div0">
                            <div class="col-md-12">
                                <div id="myRepeatingFields" class="fvrduplicate">
                                    <div class="row entry mb-2">
                                        <!-- Field Start -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4" style="padding-right:0;">
                                                        <label>Attribute value:</label>
                                                    </div>
                                                    <div class="col-sm-8" style="padding-left:0;">
                                                        <input class="form-control" name="fields[]" type="text"
                                                            placeholder="Attribute value">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Field Ends -->
                                        <!-- Field Start -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="row p-0">
                                                    <div class="col-sm-4" style="padding-right:0; padding-left:0;">
                                                        <label>Product attribute:</label>
                                                    </div>
                                                    <div class="col-sm-8" style="padding-right:0; padding-left:0;">
                                                        <select name="fields[]" id="" class="form-select">
                                                            <option value="0" selected>Select Product Attribute</option>
                                                            @foreach ($productAtts as $productAtt)
                                                                <option value="{{ $productAtt->id }}">
                                                                    {{ $productAtt->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Field Ends -->
                                        <!-- Field Start -->
                                        <div class="col-md-2">
                                            <div class="form-group text-end d-grid gap-2">
                                                <button type="button" class="btn btn-success btn-add">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Field Ends -->
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5"></div>
                {{-- end --}}
                <hr class="dropdown-divider mb-2" />


                <div class="row mb-2">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">{{ trans('products_trans.submit') }}</button>
                    </div>
                </div>
                </form>
            @else
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ trans('products_trans.warnning_category') }}</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
