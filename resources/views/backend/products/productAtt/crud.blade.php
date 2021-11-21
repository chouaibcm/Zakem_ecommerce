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
                                    {{ trans('products_trans.add_update_attr') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted small fx-bold text-uppercase px-3">{{ trans('products_trans.Name') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-end">
                                <div>
                                    <img src="{{ $product->image_path }}" style="width: 140px" class="img-thumbnail"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>{{ $product->name }}</h5>
                                <hr>
                                <h6>{{ $product->title }}</h6>
                                <hr>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- create attributes -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('products_trans.add_attr') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <form action="{{ route('productsatts.store') }}" method="POST">
                            @csrf
                            <!-- sku of product-->
                            <label class="mr-sm-2">{{ trans('products_trans.sku') }}
                                :</label>
                            <input type="text" name="sku" class="form-control mb-2">
                            <!-- size of product-->
                            <label class="mr-sm-2">{{ trans('products_trans.size') }}
                                :</label>
                            <input type="text" class="form-control mb-2" name="size">
                            <!-- stock of product-->
                            <label class="control-label">{{ trans('products_trans.stock') }} :</label>
                            <input type="number" class="form-control mb-2" name="stock">
                            <!-- id of product-->
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $product->id }}">

                            <div class="row mb-2">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-primary"
                                        type="submit">{{ trans('products_trans.submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- update attributes -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('products_trans.attr_list') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ trans('products_trans.sku') }}</th>
                                        <th>{{ trans('products_trans.size') }}</th>
                                        <th>{{ trans('products_trans.stock') }}</th>
                                        <th>{{ trans('products_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productAtts as $productAtt)
                                        <tr>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="id" value="{{ $productAtt->id }}">
                                            <td>{{ $productAtt->sku }}</td>
                                            <td>{{ $productAtt->size }}</td>
                                            <td>{{ $productAtt->stock }}</td>
                                            <td>
                                                <div class="d-flex flex-row bd-highlight">
                                                    <!--update product-->
                                                    <div class="p-2 bd-highlight">
                                                        @if (auth()->user()->hasPermission('update_products'))
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                title="{{ trans('products_trans.Edit') }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit{{ $productAtt->id }}"><i
                                                                    class="fa fa-edit"></i></button>
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
                                                                data-bs-target="#delete{{ $productAtt->id }}"
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
                                        <!--Edit Category-->
                                        <div class="modal fade" id="edit{{ $productAtt->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('products_trans.edit_attr') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('productsatts.update', 'test') }}"
                                                        method="POST">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <!-- sku of product-->
                                                            <label
                                                                class="mr-sm-2">{{ trans('products_trans.sku') }}
                                                                :</label>
                                                            <input type="text" name="sku" class="form-control mb-2" value="{{ $productAtt->sku }}">
                                                            <!-- size of product-->
                                                            <label
                                                                class="mr-sm-2">{{ trans('products_trans.size') }}
                                                                :</label>
                                                            <input type="text" class="form-control mb-2" name="size" value="{{ $productAtt->size }}">
                                                            <!-- stock of product-->
                                                            <label
                                                                class="control-label">{{ trans('products_trans.stock') }}
                                                                :</label>
                                                            <input type="number" class="form-control mb-2" name="stock" value="{{ $productAtt->stock }}">
                                                            <!-- id of product-->
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $productAtt->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ trans('categories_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Delete Product-->
                                        <div class="modal fade" id="delete{{ $productAtt->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('products_trans.delete_attr') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('productsatts.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('products_trans.Warning_product') }}
                                                        </div>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $productAtt->id }}">
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
