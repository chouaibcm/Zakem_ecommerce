@extends('layouts.frontendlay')

@section('content')

    <section id="home-icons1" class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">

                </div>
                <div class="col-md-6 mb-4 text-center">
                    <i class="bi bi-shop fa-3x mb-2"></i>
                    <h3 class="display-6">My Shopping Cart</h3>
                </div>
                <div class="col-md-3 mb-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <section id="home-icons" class="py-5">
        <div class="container">
            <h3 class="display-6 text-center mb-5">In Your Shopping Cart: {{ Cart::content()->count() }} Items</h3>
            @if (Cart::content()->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th>Product</th>
                                <th>price</th>
                                <th>Quantity</th>
                                <th>Attributes</th>
                                <th>total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $product)
                                <tr style="vertical-align: middle;">
                                    <td>
                                        <a href="{{ route('cart.delete', $product->rowId) }}" id="mlcho"><i
                                                class="fa fa-trash fa-2x" style="color: rgb(216, 17, 17)"></i></a>
                                        <img src="{{ $product->model->image_path }}" class="img-fluid text-center"
                                            id="mrlcho" style="width: 200px;" alt="">
                                        {{ $product->name }}
                                    </td>
                                    <td>{{ number_format($product->price, 2) }} {{ trans('products_trans.DA') }}</td>

                                    <form action="{{ route('cart.change.qty') }}" method="GET">
                                        <td><input type="number" name="qty" value="{{ $product->qty }}" min="1"
                                                class="form-control form-control-sm" style="width: 80px"
                                                onchange="this.form.submit()">
                                        </td>
                                        <td>
                                            @foreach ($product->options->p_att as $pav)
                                                @foreach ($product_attribute as $pa)
                                                    @if ($pa->id == $pav)
                                                        <p class="mb-0">{{ $pa->value }}</p>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <input type="hidden" name="product_id" value="{{ $product->rowId }}">
                                    </form>
                                    <td>{{ number_format($product->total(), 2) }} {{ trans('products_trans.DA') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <h3>Total : {{ number_format(Cart::total(), 2) }} {{ trans('products_trans.DA') }}</h3>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                </div>
            @endif
        </div>
    </section>

@endsection
