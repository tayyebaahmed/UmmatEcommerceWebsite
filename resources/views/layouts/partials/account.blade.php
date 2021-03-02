@include('layouts.partials.head')
@include('layouts.partials.navbar')
<div class="cotainer">
<div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card" style="margin: 10px;">
        <div class="card-header">Register</div>
        <div class="card-body">
        <form action="" method="POST" accept-charset="utf-8">
                @method('PATCH')  
                @csrf
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
            <div class="form-group row">
            <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
            <div class="col-md-6">
                <input type="text" id="full_name" class="form-control" name="name" value="">
            </div>
            </div>

            <div class="form-group row">
            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
            <div class="col-md-6">
                <input type="text" id="email_address" class="form-control" name="email-address" value="{{ Auth::user()->email }}">
            </div>
            </div>

            <div class="form-group row">
            <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
            <div class="col-md-6">
                <input type="text" id="user_name" class="form-control" name="username">
            </div>
            </div>

            <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
            <div class="col-md-6">
                <input type="text" id="phone_number" class="form-control">
            </div>
            </div>

            <div class="form-group row">
            <label for="present_address" class="col-md-4 col-form-label text-md-right">Present Address</label>
            <div class="col-md-6">
                <input type="text" id="present_address" class="form-control">
            </div>
            </div>

            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Permanent Address</label>
            <div class="col-md-6">
                <input type="text" id="permanent_address" class="form-control" name="permanent-address">
            </div>
            </div>
            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Country</label>
            <div class="col-md-6">
                <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>India</option>
                </select>
            </div>
            </div>

            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">State</label>
            <div class="col-md-6">
                <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>Maharashtra</option>
                </select>
            </div>
            </div>
            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">City</label>
            <div class="col-md-6">
                <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>Pune</option>
                </select>
            </div>
            </div>
            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Zip Code</label>
            <div class="col-md-6">
                <input type="text" id="permanent_address" class="form-control" name="permanent-address">
            </div>
            </div>
            <div class="form-group row">
            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Gender</label>
            <div class="col-md-6">
                <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>Male</option>
                <option>Female</option>
                </option>
                </select>
            </div>
            </div>

            <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Update My Profile
            </button>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>
</div>
@include('layouts.partials.script')
@include('layouts.partials.footer')