@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Customers</a></li>
<li class="breadcrumb-item active" aria-current="page">Add Customer</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<form action="{{route('admin.profile.store')}}" method="post" accept-charset="utf-8">
	@csrf
    <div class="row">
	<div class="col-lg-9">
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
		<div class="col-sm-12 col-md-6">
				<label class="form-control-label">Name: </label>
				<input type="text" id="txturl" name="name" class="form-control "/>
		</div>
		</div>
		<div class="form-group row">
			
			<div class="col-lg-12">
				<label class="form-control-label">Address: </label>
				<textarea name="address" id="editor" class="form-control " rows="3" cols="80"></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-6">
				<label class="form-control-label">State: </label>
				<select name="state" class="form-control">
					<option value="NULL" selected>-- Select State --</option>
				</select>
			</div>
			<div class="col-6">
				<label class="form-control-label">City: </label>
				<select name="city" class="form-control">
					<option value="NULL" selected>-- Select City --</option>
				</select>
			</div>
		</div>
        <div class="form-group row">
			<div class="col-6">
				<label class="form-control-label">Phone: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">+91</span>
					</div>
					<input type="text" class="form-control" aria-label="phone" aria-describedby="basic-addon1" name="phone"/>
				</div>
			</div>
			<div class="col-6">
				<label class="form-control-label">Gender: </label><br>
				<div class="row">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio">Male
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio">Female
                    </label>
                </div>
                </div>
			</div>
		</div>
		<div class="form-group row">
			<div class="card col-sm-11 p-0 m-2">
				<div class="card-header align-items-center">
					<h5 class="card-title float-left">Extra Options</h5>
					<div class="float-right" >
						<button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
						<button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
					</div>
					
				</div>
				<div class="card-body" id="extras">

				</div>
			</div>
		</div>
	</div>
    <div class="col-lg-3">
		<ul class="list-group row">
			<li class="list-group-item active"><h5>Status</h5></li>
			<li class="list-group-item">
				<div class="form-group row">
					<select class="form-control" id="status" name="status">
						<option value="0" @if(isset($product) && $product->status == 0) {{'selected'}} @endif >Pending</option>
						<option value="1" @if(isset($product) && $product->status == 1) {{'selected'}} @endif>Publish</option>
					</select>
				</div>
				<div class="form-group row">
					<div class="col-lg-12">
						@if(isset($product))
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Customer" />
						@else
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Add Customer" />
						@endif
					</div>
					
				</div>
			</li>
			<li class="list-group-item active"><h5>Profile Image</h5></li>
			<li class="list-group-item">
				<div class="input-group mb-3">
					<div class="custom-file ">
						<input type="file"  class="custom-file-input" name="thumbnail" id="thumbnail">
						<label class="custom-file-label" for="thumbnail">Choose file</label>
					</div>
				</div>
				<div class="img-thumbnail  text-center">
					<img src="@if(isset($product)) {{asset('storage/'.$product->thumbnail)}} @else {{asset('images/no-thumbnail.jpeg')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
				</div>
			</li>
			<li class="list-group-item active"><h5>Select Role</h5></li>
			<li class="list-group-item ">
				<select name="unit" class="form-control">
					<option value="NULL" selected>-- Select Role --</option>
					<option value="privileged">Privileged</option>
					<option value="regular">Regular</option>
				</select>
			</li>
		</ul>
	</div>
    </div>
</form>
@endsection