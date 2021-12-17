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
                                    {{ trans('products_trans.attr') }}</li>
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
                                    <i class="bi bi-bookmarks"></i>
                                </span>
                                {{ trans('products_trans.attr') }}
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <!-- add category button-->
                                    @if (auth()->user()->hasPermission('create_products'))
                                        <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#productattModal"><i
                                                class="fa fa-plus"></i>{{ trans('products_trans.add_attr') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('products_trans.add_attr') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('products_trans.attr_name') }}</th>
                                        <th>{{ trans('categories_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($productAtts as $productAtt)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $productAtt->name }}</td>
                                            <td class="text-center">
                                                <!--update category-->
                                                @if (auth()->user()->hasPermission('update_products'))
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $productAtt->id }}"
                                                        title="{{ trans('categories_trans.Edit') }}"><i
                                                            class="fa fa-edit"></i></button>
                                                @else
                                                    <button class="btn btn-primary btn-sm"
                                                        title="{{ trans('categories_trans.Edit') }}" disabled><i
                                                            class="fa fa-edit"></i></button>
                                                @endif
                                                <!--Delete category-->
                                                @if (auth()->user()->hasPermission('delete_products'))
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $productAtt->id }}"
                                                        title="{{ trans('categories_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        title="{{ trans('categories_trans.Delete') }}" disabled><i
                                                            class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!--Edit Category-->
                                        <div class="modal fade" id="edit{{ $productAtt->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('categories_trans.edit_category') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('productsatts.update', 'test') }}"
                                                        method="POST">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('products_trans.add_attr') }}
                                                            </div>
                                                            <hr class="dropdown-divider mb-2" />
                                                            <!-- name of Product attribute-->
                                                            <label class="mr-sm-2">{{ trans('products_trans.attr_name') }}
                                                                :</label>
                                                            <input type="text" name="name" value="{{ $productAtt->name }}" class="form-control mb-2">
                                                            <input type="hidden" name="id" value="{{ $productAtt->id }}">
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
                                        <!--Delete Category-->
                                        <div class="modal fade" id="delete{{ $productAtt->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('categories_trans.delete_category') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('productsatts.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('categories_trans.Warning_category') }}
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $productAtt->id }}">
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
    <!-- product attr add model -->
    <div class="modal fade" id="productattModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('products_trans.add_attr') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('productsatts.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('products_trans.add_attr') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <!-- name of Product attribute-->
                        <label class="mr-sm-2">{{ trans('products_trans.attr_name') }}
                            :</label>
                        <input type="text" name="name" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('categories_trans.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('categories_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
