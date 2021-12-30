@extends('layouts.frontendlay')

@section('css')
    <style>
    .star-cb-group {
  /* remove inline-block whitespace */
  font-size: 0;
  /* flip the order so we can use the + and ~ combinators */
  unicode-bidi: bidi-override;
  direction: rtl;
  /* the hidden clearer */
}
.star-cb-group * {
  font-size: 3rem;
}
.star-cb-group > input {
  display: none;
}
.star-cb-group > input + label {
  /* only enough room for the star */
  display: inline-block;
  overflow: hidden;
  text-indent: 9999px;
  width: 1em;
  white-space: nowrap;
  cursor: pointer;
}
.star-cb-group > input + label:before {
  display: inline-block;
  text-indent: -9999px;
  content: "☆";
  color: #888;
}
.star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
}
.star-cb-group > .star-cb-clear + label {
  text-indent: -9999px;
  width: .5em;
  margin-left: -.5em;
}
.star-cb-group > .star-cb-clear + label:before {
  width: .5em;
}
.star-cb-group:hover > input + label:before {
  content: "☆";
  color: #888;
  text-shadow: none;
}
.star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
}
    </style>
@endsection

@section('content')
    <section id="review">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <div class="text-muted small fx-bold text-uppercase px-3">
                        Product detail
                    </div>
                    <hr class="dropdown-divider mb-2" />
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><img src="{{ $product->image_path }}" style="width: 100px" alt=""></td>
                                    <td>
                                        <h6 class="fw-bold">{{ $product->name }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="fw-bold">{{ $product->title }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="fw-bold">{{ number_format($product->price, 2) }}
                                            {{ trans('products_trans.DA') }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="text-muted small fx-bold text-uppercase px-3">
                        Add Review
                    </div>
                    <hr class="dropdown-divider mb-2" />
                    <form action="{{ route('upload_review', $product->id) }}" method="POST">
                        @csrf
                        <h5>Your rating:</h5>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id}}">
                        <span class="star-cb-group">
                            <input type="radio" id="rating-5" name="rating" value="5" />
                            <label for="rating-5">5</label>
                            <input type="radio" id="rating-4" name="rating" value="4" checked="checked" />
                            <label for="rating-4">4</label>
                            <input type="radio" id="rating-3" name="rating" value="3" />
                            <label for="rating-3">3</label>
                            <input type="radio" id="rating-2" name="rating" value="2" />
                            <label for="rating-2">2</label>
                            <input type="radio" id="rating-1" name="rating" value="1" />
                            <label for="rating-1">1</label>
                            <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" />
                            <label for="rating-0">0</label>
                        </span><br>
                        <h5>Your Comment:</h5>
                        <textarea class="form-control ckeditor" name="review"></textarea>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary">Add Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
