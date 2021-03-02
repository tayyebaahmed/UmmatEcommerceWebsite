@include('layouts.partials.navbar')
<div class="album pt-5 bg-light">
    <div class="container">
        <h3 class="text-center pb-5">Our Products</h3>
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
</div>
  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <h5 class="m-auto">&copy Copyrights of Tayyeba Ahmed.</h5>
    </div>
</nav>
<script type="type/javascript" src="{{asset('js/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">