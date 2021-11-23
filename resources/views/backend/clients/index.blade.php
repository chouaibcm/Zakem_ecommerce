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
                              <li class="breadcrumb-item active" aria-current="page">{{ trans('main_trans.clients') }}</li>
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
                                    <i class="bi bi-people"></i>
                                </span>
                                {{ trans('clients_trans.List_client') }}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('clients_trans.image') }}</th>
                                        <th>{{ trans('clients_trans.Name') }}</th>   
                                        <th>{{ trans('clients_trans.address') }}</th>                                        
                                        <th>{{ trans('clients_trans.mobile') }}</th>
                                        <th>{{ trans('clients_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($users as $user)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{ $user->image_path }}" style="width: 70px;"
                                                class="img-thumbnail" alt=""></td>
                                            <td>{{ $user->name }}</td>   
                                            <td>{{ $user->address }}</td>  
                                            <td>{{ $user->mobile }}</td>    
                                            <td>
                                                    <div class="dropdown d-flex justify-content-center">
                                                        <a class="dropdown-toggle btn btn-primary btn-sm" href="#" id="navbarDropdown" role="button" data-bs-display="static"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span><i class="bi bi-three-dots"></i></span>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                            @if (auth()->user()->hasPermission('read_clients')) 
                                                              <li><a class="dropdown-item" href="{{ route('clients.show') }}" onclick="event.preventDefault();
                                                              document.getElementById('show_clients').submit();"
                                                              ><i class="bi bi-eye me-2"></i>{{ trans('clients_trans.show') }}</a></li>
                                                            @endif
                                                            @if (auth()->user()->hasPermission('update_clients')) 
                                                            <li><a class="dropdown-item" href="{{ route('clients.edit') }}" onclick="event.preventDefault();
                                                            document.getElementById('edit_clients').submit();">
                                                                <i class="fa fa-edit me-2"></i>{{ trans('clients_trans.edit_client') }}</a></li>
                                                            @endif
                                                            @if (auth()->user()->hasPermission('delete_clients')) 
                                                            <li><a class="dropdown-item" href=""  data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $user->id }}">
                                                                <i class="fa fa-trash me-2"></i>{{ trans('clients_trans.delete_client') }}</a></li>
                                                            @endif

                                                            <!--forms-->
                                                            <form id="show_clients" action="{{route('clients.show')}}">
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                            </form>
                                                            <form id="edit_clients" action="{{route('clients.edit')}}">
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                            </form>
                                                        </ul>
                                                    </div>
                                            </td>
                                        </tr>
                                        <!--Edit client-->
                                        <!--Delete client-->
                                        <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('categories_trans.delete_category') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('clients.destroy') }}"
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
