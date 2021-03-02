@include('layouts.partials.head')
@include('layouts.partials.navbar')
<div class="container" style="min-height: 60vh !important;margin:5% 20%;">
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
    <div>
            @if(Session::has('cart'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li class="list-group-item">
                                <span class="badge badge-success">{{ $product['qty'] }}</span>
                                <strong>{{ $product['item']  ['title'] }}  &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                <span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;₹ {{ $product['price'] }}   </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" style="margin-left:40%;">
                                     <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> Action
                                          <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('deductByOne', ['product' => $product['item']['id']]) }}" style="margin-left:10%;">Remove by one</a> </li>
                                            <li><a href="{{ route('removeItem', ['product' => $product['item']['id']]) }}" style="margin-left:10%;">Delete all </a> </li>
                                        </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 m-4">
                    <strong>Total price: ₹ {{ $totalPrice }}</strong>
                </div>
            </div>
            <div class="row m=4">
                <div class="col-md-4">
                    <a href="{{ route('checkout') }}" class="btn btn-success" type="button">Checkout</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <h2>Your Cart is Empty!</h2>
                </div>
            </div>
      @endif
    </div>
</div>
@include('layouts.partials.script')
@include('layouts.partials.footer')