@extends('layouts.app')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/slide1.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
            <h5>Best Almonds</h5>
            <p>We get you the best almonds for your health.</p>
        </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
            <h5>Quality Olives</h5>
            <p>We know you need the best olives so bring it to you.</p>
        </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
            <h5>Best Meat</h5>
            <p>We bring you the best quality meat you've ever known.</p>
        </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="album py-5 bg-light">
  <div class="container">
      <h3 class="text-center pb-5">Our Featured Products</h3>
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
                                <a type="button" href="{{route('product.addToCart', $product)}}"
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
@endsection
