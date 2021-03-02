@include('layouts.partials.head')
<div>
    @include('layouts.partials.navbar')
    <div class="card mt-4" style="margin: 0 4%;">
        <div class="row">
            <div class="col-md-8">
            <img class="card-img-top" src="/storage/products/{{$product->photo}}">
            </div>
            <div class="col-md-4">
            <div class="card-body">
                <h3 class="card-title">{{ $product->title }}</h3>
                <h4>₹ {{ $product->price }}</h4>
                    <span style="font-size: 20px;">Quantity : </span>
                    <input type="number" name="qty" id="qty" class="form-control text-center" min="0" max="99" value="">
                <p class="card-text">{{ $product->description }}</p>
                <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                4.0 stars
            </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a type="button" href="{{route('product.addToCart', $product)}}"
                        class="btn btn-md btn-primary" style="margin:10px auto;">Add to Cart
                    </a>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a type="button" href="{{route('product.addToCart', $product)}}"
                        class="btn btn-md btn-secondary" style="margin:10px auto;">Buy Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layouts.partials.script')
    <div style="margin-top:10%;">
    @include('layouts.partials.footer')
</div>