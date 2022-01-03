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
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.products') }}
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
                            <div class="col-md-4 fw-bold fs-3">
                                <span class="me-2">
                                    <i class="bi bi-shop"></i>
                                </span>
                                {{ trans('products_trans.List_product') }}
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-end">
                                    <!-- add product button-->
                                    @if (auth()->user()->hasPermission('create_products'))
                                        <a href="{{ Route('products.create') }}" class="btn btn-primary"><i
                                                class="fa fa-plus"></i>{{ trans('products_trans.add_product') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('products_trans.add_product') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <!-- Filter by category-->
                                <form action="{{ route('products.index') }}" method="GET">
                                    <div class="row me-2">
                                        <div class="col-md-2">
                                            <label for=""
                                                style="display: inline-block">{{ trans('products_trans.Search_By_category') }}:</label>
                                        </div>
                                        <div class="col d-flex justify-content-start">                                                    
                                            <select class="form-select" name="category_id" id="" aria-label="Default select example" onchange="this.form.submit()">
                                                <option value="0" selected> {{ trans('products_trans.all_categories') }}     
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('products_trans.image') }}</th>
                                        <th>{{ trans('products_trans.p_code') }}</th>
                                        <th>{{ trans('products_trans.Name') }}</th>
                                        <th>{{ trans('categories_trans.Name') }}</th>
                                        <th>{{ trans('products_trans.price') }}</th>
                                        <th>{{ trans('categories_trans.status') }}</th>
                                        <th>{{ trans('products_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($products as $product)
                                        <?php
                                        $category = App\Category::where('id', $product->category_id)->first();
                                        ?>
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td> <img src="{{ $product->image_path }}" style="width: 100px;"
                                                    class="img-thumbnail" alt=""> </td>
                                            <td>{{ $product->p_code }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if (App::getLocale() == 'ar')
                                                    {{ $category->getTranslation('name', 'ar') }}
                                                @else
                                                    {{ $category->getTranslation('name', 'en') }}
                                                @endif
                                            </td>
                                            <td>{{ $product->price }} DA</td>
                                            @if ($product->status == 1)
                                                <td><span
                                                        class="badge bg-success">{{ trans('products_trans.published') }}</span>
                                                </td>
                                            @else
                                                <td><span
                                                        class="badge bg-warning">{{ trans('products_trans.draft') }}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="d-flex flex-row bd-highlight">
                                                    <!--update product-->
                                                    <div class="p-2 bd-highlight">
                                                        @if (auth()->user()->hasPermission('update_products'))
                                                            <form action="{{ route('products.edit', 'test') }}">
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $product->id }}">
                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                    title="{{ trans('products_trans.Edit') }}"><i
                                                                        class="fa fa-edit"></i></button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-primary btn-sm"
                                                                title="{{ trans('products_trans.Edit') }}" disabled><i
                                                                    class="fa fa-edit"></i></button>
                                                        @endif
                                                    </div>
                                                    <!--Delete product-->
                                                    <div class="p-2 bd-highlight">
                                                        @if (auth()->user()->hasPermission('delete_products'))
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                style="display: inline-block" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $product->id }}"
                                                                title="{{ trans('categories_trans.Delete') }}"><i
                                                                    class="fa fa-trash"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                title="{{ trans('products_trans.Delete') }}" disabled><i
                                                                    class="fa fa-trash"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--Delete Product-->
                                        <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('products_trans.delete_product') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('products.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('products_trans.Warning_product') }}
                                                        </div>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $product->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('categories_trans.submit') }}</button>
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
@endsection
