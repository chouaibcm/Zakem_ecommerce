@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12 fw-bold fs-3">
        {{ trans('main_trans.Dashboard_page') }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary mb-3 h-100">
          <div class="card-header">Categories</div>
          <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-white bg-success mb-3 h-100">
          <div class="card-header">Clients</div>
          <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger mb-3 h-100">
          <div class="card-header">Header</div>
          <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning mb-3 h-100">
          <div class="card-header">Orders</div>
          <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      
    </div>
  </div>

@endsection