@extends('layouts.frontendlay')

@section('css')

<style>

#content-wrapper{
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
}

.column{
	width: 600px;
	padding: 10px;

}

#featured{
	max-width: 500px;
	max-height: 600px;
	object-fit: cover;
	cursor: pointer;
	border: 2px solid rgba(156, 156, 156, 0.767);

}

.thumbnail{
	object-fit: cover;
	max-width: 180px;
	max-height: 100px;
	cursor: pointer;
	opacity: 0.5;
	margin: 5px;
	border: 2px solid rgba(156, 156, 156, 0.767);

}

.thumbnail:hover{
	opacity:1;
}

.active{
	opacity: 1;
}

#slide-wrapper{
	max-width: 500px;
	display: flex;
	min-height: 100px;
	align-items: center;
}

#slider{
	width: 440px;
	display: flex;
	flex-wrap: nowrap;
	overflow-x: auto;

}


#slider::-webkit-scrollbar {
		width: 8px;

}

#slider::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);

}
 
#slider::-webkit-scrollbar-thumb {
  background-color: #161616;
  outline: 1px solid slategrey;
   border-radius: 100px;

}

#slider::-webkit-scrollbar-thumb:hover{
    background-color: #c0c0c0;
}

.arrow{
	width: 30px;
	height: 30px;
	cursor: pointer;
	transition: .3s;
}

.arrow:hover{
	opacity: .5;
	width: 35px;
	height: 35px;
}

.prdt-card{
    box-shadow: 2px 2px 10px #4e4e4eb7;
}


</style>
    
@endsection

@section('content')
    @php
    $review_rating_global = 0;
    $nb_review = $product->reviews->count();
    foreach ($product->reviews as $review) {
        $review_rating_global = $review_rating_global + $review->rating;
    }
    if ($review_rating_global > 0) {
        $rating_moyen = $review_rating_global / $nb_review;
    }
    @endphp

    
    <section id="home-icons" class="py-5 bg-light">
        <div class="container">
            <h3 class="display-6">{{ $product->name }}</h3>
            <div class="card prdt-card py-5">
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
                    <div class="row">
                        <div class="col-md-6 mb-4 text-center">
                            {{-- <img src="{{ $product->image_path }}" class="img-fluid" alt=""> --}}

                            <img id=featured src="{{ $product->image_path }}">

                            <div id="slide-wrapper">
                                {{-- <img id="slideLeft" class="arrow" src="images/arrow-left.png"> --}}
                                <i  id="slideLeft"  class="bi bi-arrow-left-circle-fill arrow"></i>

                                <div id="slider">
                                    <img class="thumbnail active" src="{{ $product->image_path }}">
                                    @foreach ($product->product_images as $image)
                                       <img class="thumbnail" src="{{ $image->image_path }}">
                                    @endforeach
                                </div>

                                {{-- <img id="slideRight" class="arrow" src="images/arrow-right.png"> --}}
                                <i  id="slideRight" class="bi bi-arrow-right-circle-fill arrow"></i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h3 class="mb-2">{{ $product->title }}</h3>
                            <hr>
                            @if ($product->reviews->count() > 0)
                                <div class="col d-flex justify-content-inline">
                                    {{-- eda ydirlak moyen ta njom --}}
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($review_rating_global > 0)
                                            @if ($rating_moyen > $i and $rating_moyen < $i + 1)
                                                <span><i class="bi bi-star-half"></i></span>
                                            @else
                                                @if ($i <= $rating_moyen)
                                                    <span><i class="bi bi-star-fill"></i></span>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endif
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                    <h6 class="ms-2">({{ $product->reviews->count() }})</h6>
                                    {{-- --------------------------------- --}}
                                </div>
                            @endif
                            @if ($product->discount)
                            <div class="d-flex justify-content-inline">
                            <h3 class="mb-2 me-2" style="color: gray"><del>{{ number_format($product->price, 2) }} {{ trans('products_trans.DA') }}</del></h3>
                            <h3 class="mb-2" style="color: gray">{{ number_format($product->discount, 2) }} {{ trans('products_trans.DA') }}</h3>
                        </div>
                            @else
                            <h3 class="mb-2" style="color: gray">{{ number_format($product->price, 2) }} {{ trans('products_trans.DA') }}</h3>
                            @endif
                            <p class="mb-2">Availability :
                                @if ($product->stock == 0)
                                    <span class="badge bg-success">{{ trans('products_trans.in_stock') }}</span>
                                @else
                                    <span class="badge bg-warning">{{ trans('products_trans.out_stock') }}</span>
                                @endif
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                @if ($product->attr_values->count() > 0)
                                    @foreach ($product->attr_values->unique('product_att_id') as $av)
                                        <div class="row mt-2">
                                            <div class="col-sm-4">
                                                <p>{{ $av->productAtts->name }} :</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <select name="p_att[]" class="form-select" id="" required>
                                                    <option selected>Select {{ $av->productAtts->name }}</option>
                                                    @foreach ($av->productAtts->attr_values->where('product_id', $product->id) as $pav)
                                                        <option value="{{ $pav->id }}">{{ $pav->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row mt-2">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="col-md-4"
                                        style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                        <label for="qty" class="me-2">Quantity:</label>
                                        <input type="number" class="form-control" min="1" value="1" name="qty">
                                    </div>
                                    <div class="col-md-8 text-end">
                                        <div class="form-group d-grid gap-2">
                                            <button type="submit" class="btn btn-danger text-white"><i
                                                    class="bi bi-cart"></i> Add to Card</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <p class="mb-2">Description : {!! $product->description !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-inline">
                            {{-- eda ydirlak moyen ta njom --}}
                            @for ($i = 0; $i < 5; $i++)
                                @if ($review_rating_global > 0)
                                    @if ($rating_moyen > $i and $rating_moyen < $i + 1)
                                        <span><i class="bi bi-star-half"></i></span>
                                    @else
                                        @if ($i <= $rating_moyen)
                                            <span><i class="bi bi-star-fill"></i></span>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endif
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                            <h6 class="ms-2">({{ $product->reviews->count() }}) Reviews</h6>
                            {{-- --------------------------------- --}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2"></div>
                        
                        <div class="col-md-8">
                            @if ($reviews->count()>0)
                            
                            <h6>Comments</h6>
                            <hr>
                            <ul class="list-unstyled">
                                @foreach ($reviews as $review)
                                    <li class="media mb-2">
                                        <div class="d-flex justify-content-inline">
                                            <img class="mr-3 img-fluid rounded-circle"
                                                src="{{ $review->user->image_path }}" style="width: 100px">
                                            <div class="media-body ms-5">
                                                <h5>{{ $review->user->name }}</h5>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <span><i class="bi bi-star-fill"></i></span>
                                                    @else
                                                        <span><i class="bi bi-star"></i></span>
                                                    @endif
                                                @endfor
                                                {!! $review->review !!}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-center">
                                {{ $reviews->appends(request()->query())->links() }}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<script type="text/javascript">
    let thumbnails = document.getElementsByClassName('thumbnail')

    let activeImages = document.getElementsByClassName('active')

    for (var i=0; i < thumbnails.length; i++){

        thumbnails[i].addEventListener('mouseover', function(){
            console.log(activeImages)
            
            if (activeImages.length > 0){
                activeImages[0].classList.remove('active')
            }
            

            this.classList.add('active')
            document.getElementById('featured').src = this.src
        })
    }


    let buttonRight = document.getElementById('slideRight');
    let buttonLeft = document.getElementById('slideLeft');

    buttonLeft.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft -= 180
    })

    buttonRight.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft += 180
    })


</script>
@endsection
