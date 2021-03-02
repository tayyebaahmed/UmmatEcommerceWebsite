@include('layouts.partials.head')
@include('layouts.partials.navbar')
<div class="container-fluid">
    <div class="card" style="margin:10px;min-height: 80vh !important;">
        <div class="card-header">
            <h5 class="card-title">Checkout</h5>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div id="checkout-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
                    {{ Session::get('error') }}
                </div>
            </div> --}}
            <div class="row form-group">
                <h4>Your total: ₹ {{ $total }}</h4>
            </div>
            <form action="{{ route('checkout') }}" method="post" id="checkout-form" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                        <label for="countryId" class="col-md-2 required">Name: </label>
                        <div class="col-md-10">
                                <input type="text" id="address" class="form-control" name="address" required value="Tayyeba Ahmed">
                        </div>
                    </div>
                <div class="row form-group">
                    <label for="address" class="col-md-2 required">Address:</label>
                    <div class="col-md-10">
                            <input type="text" id="address" class="form-control" name="address" required >
                    </div>
                </div>

                <div class="row form-group">
                    <label for="countryId" class="col-md-2 required">Card Holder Name</label>
                    <div class="col-md-10">
                        <input type="text" id="card-name" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="card-number" class="col-md-2 required">Credit card number</label>
                    <div class="col-md-4">
                        <input type="text" id="card-number" class="form-control" required>
                    </div>
                    <label for="card-expiry-month" class="col-md-2 required">Expiration month:</label>
                    <div class="col-md-4">
                        <input type="text" id="card-expiry-month" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="card-expiry-year" class="col-md-2 required">Expiration year:</label>
                    <div class="col-md-4">
                        <input type="text" id="card-expiry-year" class="form-control" required>
                    </div>
                    <label for="card-cvc" class="col-md-2 required">CVC:</label>
                    <div class="col-md-4">
                        <input type="text" id="card-cvc" class="form-control" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Proceed to Checkout">
            </form>
        </div>
    </div>
</div>
@include('layouts.partials.script')
@include('layouts.partials.footer')