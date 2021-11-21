@extends('layouts.adminlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 fw-bold ">
                <div class="card mb-2">
                    <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><span class="me-2"><i
                                            class="bi bi-speedometer2"></i></span><a
                                        href="{{ route('dashboard') }}">{{ trans('main_trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.admins') }}
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
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                {{ trans('main_trans.List_admins') }}
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    @if (auth()->user()->hasPermission('create_users'))
                                        <a href="{{ Route('users.create') }}" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#userModal"><i
                                                class="fa fa-plus"></i>{{ trans('users_trans.add_user') }}</a>
                                    @else
                                        <button class="btn btn-primary" disabled><i
                                                class="fa fa-plus"></i>{{ trans('users_trans.add_user') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('users_trans.image') }}</th>
                                        <th>{{ trans('users_trans.Name') }}</th>
                                        <th>{{ trans('users_trans.email') }}</th>
                                        <th>{{ trans('categories_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($users as $user)
                                    @if ($user->hasRole('super_admin'))
                                    @else
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{ $user->image_path }}" style="width: 50px;" alt=""></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            
                                            <td>
                                                <!-- edit user button-->
                                                @if (auth()->user()->hasPermission('update_users'))
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}"
                                                        title="{{ trans('categories_trans.Edit') }}"><i
                                                            class="fa fa-edit"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        title="{{ trans('categories_trans.Edit') }}" disabled><i
                                                            class="fa fa-edit"></i></button>
                                                @endif
                                                <!-- delete user button-->
                                                @if (auth()->user()->hasPermission('delete_users'))
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}"
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
                                        <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('users_trans.edit_user') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.update', 'test') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        {{ method_field('patch') }}
                                                        <div class="modal-body">
                                                            <!-- edit_form -->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('users_trans.user_information') }}
                                                            </div>
                                                            <hr class="dropdown-divider mb-2" />
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $user->id }}">
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="name"
                                                                        class="mr-sm-2">{{ trans('users_trans.FullName') }}
                                                                        :</label>
                                                                    <input id="name" type="text" name="name"
                                                                        class="form-control" value="{{ $user->name }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="email"
                                                                        class="mr-sm-2">{{ trans('users_trans.email') }}
                                                                        :</label>
                                                                    <input type="email" class="form-control" name="email"
                                                                        value="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                            <!-- product image-->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('users_trans.user_image') }}
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
                                                                        <img src="{{ $user->image_path }}"
                                                                            style="width: 100px;"
                                                                            class="img-thumbnail image-preview" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- permissions-->
                                                            <div class="text-muted small fx-bold text-uppercase px-3">
                                                                {{ trans('users_trans.permissions') }}
                                                            </div>
                                                            <hr class="dropdown-divider mb-2" />
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label
                                                                        class="mr-sm-2">{{ trans('users_trans.permissions') }}:
                                                                    </label>
                                                                    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                                                                        @php
                                                                            $models = ['users', 'categories', 'dashboards', 'products', 'orders','clients','coupons'];
                                                                            $maps = ['create', 'read', 'update', 'delete'];
                                                                        @endphp
                                                                        @foreach ($models as $index => $model)
                                                                            <li class="nav-item" role="presentation">
                                                                                <button
                                                                                    class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                                                    data-bs-toggle="tab"
                                                                                    data-bs-target="#{{ $model }}{{ $user->id }}"
                                                                                    type="button"
                                                                                    role="tab">{{ trans('main_trans.' . $model) }}</button>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="tab-content" id="myTabContent">
                                                                        @foreach ($models as $index => $model)
                                                                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                                                                id="{{ $model }}{{ $user->id }}"
                                                                                role="tabpanel" aria-labelledby="home-tab">
                                                                                @if ($model == 'dashboards')
                                                                                    <label><input type="checkbox"
                                                                                            name="permissions[]"
                                                                                            {{ $user->hasPermission('read_' . $model) ? 'checked' : '' }}
                                                                                            value="{{ 'read_' . $model }}">
                                                                                        {{ trans('users_trans.read') }}
                                                                                    </label>
                                                                                @else
                                                                                    @foreach ($maps as $map)
                                                                                        <label><input type="checkbox"
                                                                                                name="permissions[]"
                                                                                                {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }}
                                                                                                value="{{ $map . '_' . $model }}">
                                                                                            {{ trans('users_trans.' . $map) }}
                                                                                        </label>
                                                                                    @endforeach
                                                                                @endif

                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                        <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('users_trans.delete_user') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('categories_trans.Warning_category') }}
                                                        </div>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $user->id }}">
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
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--add user-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('users_trans.add_user') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('users_trans.user_information') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name" class="mr-sm-2">{{ trans('users_trans.FullName') }}
                                    :</label>
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="email" class="mr-sm-2">{{ trans('users_trans.email') }}
                                    :</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="mr-sm-2">{{ trans('users_trans.password') }}: </label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">{{ trans('users_trans.password_confirmation') }}: </label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <!-- product image-->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('users_trans.user_image') }}
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
                                    <img src="{{ asset('uploads/user_img/default.png') }}" style="width: 100px;"
                                        class="img-thumbnail image-preview" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- permissions-->
                        <div class="text-muted small fx-bold text-uppercase px-3">
                            {{ trans('users_trans.permissions') }}
                        </div>
                        <hr class="dropdown-divider mb-2" />
                        <div class="row mb-2">
                            <div class="col">
                                <label class="mr-sm-2">{{ trans('users_trans.permissions') }}: </label>
                                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                                    @php
                                        $models2 = ['users', 'categories', 'dashboards', 'products', 'orders','clients','coupons'];
                                    @endphp
                                    @foreach ($models2 as $index => $mode)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#{{ $mode }}add" type="button"
                                                role="tab">{{ trans('main_trans.' . $mode) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach ($models2 as $index => $mode)
                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                            id="{{ $mode }}add" role="tabpanel" aria-labelledby="home-tab">
                                            @if ($mode == 'dashboards')
                                                <label><input type="checkbox" name="permissions[]"
                                                        value="{{ 'read_' . $mode }}">{{ trans('users_trans.read') }}</label>
                                            @else
                                                <label><input type="checkbox" name="permissions[]"
                                                        value="{{ 'create_' . $mode }}">{{ trans('users_trans.create') }}</label>
                                                <label><input type="checkbox" name="permissions[]"
                                                        value="{{ 'read_' . $mode }}">{{ trans('users_trans.read') }}</label>
                                                <label><input type="checkbox" name="permissions[]"
                                                        value="{{ 'update_' . $mode }}">{{ trans('users_trans.update') }}</label>
                                                <label><input type="checkbox" name="permissions[]"
                                                        value="{{ 'delete_' . $mode }}">{{ trans('users_trans.delete') }}</label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
