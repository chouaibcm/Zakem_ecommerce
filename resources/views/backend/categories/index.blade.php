@extends('layouts.adminlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12 fw-bold">
                 <div class="card mb-2">
                     <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><span class="me-2"><i class="bi bi-speedometer2"></i></span><a href="{{ route('dashboard')}}">{{ trans('main_trans.Dashboard') }}</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.categories') }}</li>
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
                                {{ trans('categories_trans.List_category') }}
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <!-- add category button-->
                                    @if (auth()->user()->hasPermission('create_categories'))
                                    <a href="{{ Route('categories.create') }}" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#categoryModal"><i
                                            class="fa fa-plus"></i>{{ trans('categories_trans.add_category') }}</a>
                                    @else
                                    <button class="btn btn-primary" disabled><i
                                        class="fa fa-plus"></i>{{ trans('categories_trans.add_category') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('categories_trans.Name') }}</th>                                        
                                        <th>{{ trans('categories_trans.parent_category') }}</th>
                                        <th>{{ trans('categories_trans.status') }}</th>
                                        <th>{{ trans('categories_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($categories as $category)
                                          <?php
                                           $parent_cates=App\Category::where('id',$category->parent_id)->get();
                                            ?>
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @foreach($parent_cates as $parent_cate)
                                                @if (App::getLocale() == 'ar')
                                                {{$parent_cate->getTranslation('name', 'ar')}}
                                                @else
                                                {{$parent_cate->getTranslation('name', 'en')}}
                                                @endif                                                        
                                                @endforeach
                                            </td>
                                            @if ($category->status == 1)
                                                <td>{{ trans('categories_trans.published') }}</td>
                                            @else
                                                <td>{{ trans('categories_trans.draft') }}</td>
                                            @endif                                                
                                            <td>
                                                <!--update category-->
                                                @if (auth()->user()->hasPermission('update_categories'))
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $category->id }}"
                                                    title="{{ trans('categories_trans.Edit') }}"><i
                                                        class="fa fa-edit"></i></button>
                                                @else
                                                <button class="btn btn-primary btn-sm" title="{{ trans('categories_trans.Edit') }}" disabled><i
                                                    class="fa fa-edit"></i></button>
                                                @endif
                                                <!--Delete category-->
                                                @if (auth()->user()->hasPermission('delete_categories'))
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $category->id }}"
                                                title="{{ trans('categories_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                                @else
                                                <button type="button" class="btn btn-danger btn-sm" title="{{ trans('categories_trans.Delete') }}" disabled><i
                                                    class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!--Edit Category-->
                                        <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('categories_trans.edit_category') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('categories.update', 'test') }}"
                                                        method="POST">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="name_ar"
                                                                        class="mr-sm-2">{{ trans('categories_trans.stage_name_ar') }}
                                                                        :</label>
                                                                    <input id="name_ar" type="text" name="name_ar"
                                                                        class="form-control"
                                                                        value="{{ $category->getTranslation('name', 'ar') }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="name_en"
                                                                        class="mr-sm-2">{{ trans('categories_trans.stage_name_en') }}
                                                                        :</label>
                                                                    <input type="text" class="form-control" name="name_en"
                                                                        value="{{ $category->getTranslation('name', 'en') }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="control-label">{{trans('categories_trans.category_level') }}</label>
                                                                    <select class="form-select" name="parent_id" id="" aria-label="Default select example">
                                                                        <option value="0">{{trans('categories_trans.main_category') }}</option>
                                                                        @foreach ($cate_levels as $cat)
                                                                            <option value="{{ $cat->id }}" {{ $category->id == $cat->id ? 'selected' : '' }}>{{ $category->name }}</option>                                                    
                                                                            @if (count($cat->childs) > 0)
                                                                                @include('backend.categories.editcategory', ['subcategories' => $cat->childs, 'parent' => $cat->name,'category' => $category])
                                                                            @endif                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label
                                                                        class="mr-sm-2">{{ trans('categories_trans.enable') }}:
                                                                    </label>
                                                                    <input type="checkbox" name="status" id="status"
                                                                        value="1"
                                                                        {{ $category->status == 1 ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $category->id }}">
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
                                        <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('categories_trans.delete_category') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('categories.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <div class="modal-body">
                                                            {{ trans('categories_trans.Warning_category') }}
                                                        </div>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $category->id }}">
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
    <!-- categoryModal add model -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('categories_trans.add_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- add_form -->
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('categories_trans.stage_name_ar') }}
                                    :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('categories_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">{{trans('categories_trans.category_level') }}</label>
                                
                                
                                <select class="form-select" name="parent_id" id="" aria-label="Default select example">
                                    <option value="0">{{trans('categories_trans.main_category') }}</option>     
                                    @foreach ($cate_levels as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>                                                    
                                        @if (count($category->childs) > 0)
                                            @include('backend.products.createsubcategories', ['subcategories' => $category->childs, 'parent' => $category->name])
                                        @endif                                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="mr-sm-2">{{ trans('categories_trans.enable') }}: </label>
                                <input type="checkbox" name="status" id="status" value="1" checked>
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
