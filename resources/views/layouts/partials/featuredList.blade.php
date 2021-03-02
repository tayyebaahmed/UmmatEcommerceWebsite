<div class="album pt-5 bg-light">
  <div class="container">
      <h3 class="text-center pb-5">Our Featured Products</h3>
      <div class="form-group row">
        <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-sm-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
        </div>
      <div class="row">
          @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top img-thumbnail" src="/storage/products/{{$product->photo}}" width="256px" height="256px">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->title }}</h4>
                        <p class="card-text">₹ {{ $product->price }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a type="button" class="btn btn-sm btn-default"
                                    href="{{route('product.productShow', $product)}}">View Product
                                </a>
                                <a type="button" href="{{route('getAddToCart', ['id' => $product->id])}}"
                                    class="btn btn-sm btn-primary">Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
      </div>
  </div>
</div>