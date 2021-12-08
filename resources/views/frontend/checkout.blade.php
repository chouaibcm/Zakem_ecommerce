@extends('layouts.frontendlay')

@section('content')

    <div class="container py-2">
        <div class="py-5 text-center">
            <h2 class="display-4">Checkout</h2>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required
                form group has a validation state that can be triggered by attempting to submit the form without completing
                it.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">{{ Cart::content()->count() }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach (Cart::content() as $product)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $product->name }}</h6>
                                <small class="text-muted">Quantity: x{{ $product->qty }}</small>
                            </div>
                            <span class="text-muted">{{$product->total()}} DA</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">−$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (DZD)</span>
                        <strong>{{ Cart::total() }} DA</strong>
                    </li>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Full name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{auth()->user()->name}}"
                                        required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{auth()->user()->mobile}}" required>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span
                                            class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" id="email" placeholder="you@example.com">
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{auth()->user()->address}}" placeholder="1234 Main St"
                                        required>
                                </div>

                                <div class="col-md-5">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{auth()->user()->country}}" placeholder="Country" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{auth()->user()->state}}" placeholder="State" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="pincode" value="{{auth()->user()->pincode}}" placeholder="" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
