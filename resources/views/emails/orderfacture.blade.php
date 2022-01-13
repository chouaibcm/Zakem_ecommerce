@extends('layouts.frontendlay')
@section('content')
<h3 class="text-centre">ZAKEM</h3>
<h3>Votre Order a ete effectuer</h3>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-2">
            <div class="card-body">
                <h4 class="fw-bold">
                    {{ trans('orders_trans.items') }}</h4>
                <hr class="dropdown-divider mb-2" />
                <div class="table-responsive">
                    <table class="table" style="overflow: auto">
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td><img src="{{ $product->image_path }}"
                                            style="width: 100px" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 2) }}
                                        {{ trans('products_trans.DA') }}
                                    </td>
                                    <td>{{ $product->pivot->quantity }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($product->price * $product->pivot->quantity, 2) }}
                                        {{ trans('products_trans.DA') }}
                                    </td>
                                    <td class="text-end">
                                        @php
                                            $reviewed=0;
                                        @endphp
                                        @foreach (auth()->user()->reviews as $review)
                                            @if ($review->product->id == $product->id)
                                                @php
                                                    $reviewed=1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($reviewed==0)
                                            <a href="{{ route('add_review',$product->id)}}" class="link">Write a review</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">
                        {{ trans('orders_trans.total') }}:</h5>
                    <h5 class="fw-bold">
                        {{ number_format($order->total_price, 2) }}
                        {{ trans('products_trans.DA') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection