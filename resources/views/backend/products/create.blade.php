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
                            <form action="{{ route('products.store') }}" method="POST">
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
                                        <select class="form-select" name="category_id" id="" aria-label="Default select example">
                                            <option value="0" selected> {{ trans('products_trans.all_categories') }}     
                                            @foreach ($cate_levels as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>                                                    
                                                @if (count($category->childs) > 0)
                                                    @include('backend.products.createsubcategories', ['subcategories' => $category->childs, 'parent' => $category->name])
                                                @endif                                                    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="control-label">{{ trans('categories_trans.status') }} :</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="1" type="radio" name="status"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{ trans('products_trans.published') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="0" type="radio" name="status"
                                                id="flexRadioDefault2" checked>
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
                                            <span class="input-group-text"
                                                id="basic-addon1">{{ trans('products_trans.DA') }}</span>
                                            <input type="number" name="price" class="form-control"
                                                placeholder="{{ trans('products_trans.price') }}" aria-label="Username"
                                                aria-describedby="basic-addon1">
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
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description"
                                                placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                            <label
                                                for="floatingTextarea">{{ trans('products_trans.description') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- product image-->
                                <div class="text-muted small fx-bold text-uppercase px-3">
                                    {{ trans('products_trans.image') }}
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
                                            <img src="{{ asset('uploads/product_img/default.png') }}"
                                                style="width: 300px;" class="img-thumbnail image-preview" alt="">
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-2">
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary"
                                            type="submit">{{ trans('products_trans.submit') }}</button>
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
