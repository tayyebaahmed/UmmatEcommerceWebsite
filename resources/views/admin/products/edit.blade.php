@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<form action="{{route('admin.product.update', $product->id)}}" method="POST" accept-charset="utf-8">
    @method('PATCH')  
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
			<div class="col-lg-12">
				<label class="form-control-label">Name / Title: </label>
				<input type="text" id="txturl" value="{{ $product->title }}" name="title" class="form-control ">
			</div>
		</div>
		<div class="form-group row">
			 
			<div class="col-lg-12">
				<label class="form-control-label">Description: </label>
				<textarea name="description" id="editor" class="form-control " rows="5" cols="80">{{ $product->description }}</textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-6">
				<label class="form-control-label">Price: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">&#8377</span>
					</div>
					<input type="text" class="form-control" value="{{ $product->price }}" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1" name="price"/>
				</div>
			</div>
			<div class="col-6">
				<label class="form-control-label">Discount: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">&#8377</span>
					</div>
					<input type="text" class="form-control" name="discount" value="{{ $product->discount }}" placeholder="0.00" aria-label="discount_price" aria-describedby="discount" />
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
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Product" />
						@else
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Add Product" />
						@endif
					</div>
					
				</div>
			</li>
			<li class="list-group-item active"><h5>Feaured Image</h5></li>
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
			<li class="list-group-item">
				<div class="col-12">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" ><input id="featured" type="checkbox" name="featured" value="@if(isset($product)){{@$product->featured}}@else{{0}}@endif" @if(isset($product) && $product->featured == 1) {{'checked'}} @endif /></span>
						</div>
						<p type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured" >Featured Product</p>
					</div>
				</div>
			</li>
			<li class="list-group-item active"><h5>Select Categories</h5></li>
			<li class="list-group-item ">
				<select name="category_id" class="form-control">
					<option value="NULL">-- Select Category --</option>
					@if($categories->count() > 0)
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->title}}</option>
						@endforeach
					@endif
				</select>
			</li>
			<li class="list-group-item active"><h5>Select Units</h5></li>
			<li class="list-group-item ">
				<select name="unit_id" class="form-control">
				<option value="NULL">-- Select Unit --</option>
					@if($units->count() > 0)
						@foreach($units as $unit)
							<option value="{{$unit->id}}">{{ $unit->name }}</option>
						@endforeach
					@endif
				</select>
			</li>
		</ul>
	</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12">
			<input type="submit" name="submit" class="btn btn-primary" value="Save Changes" />
		</div>		
	</div>	
</form>
<script type="text/javascript">
	function previewFile(){
		var preview = document.querySelector('img'); //selects the query named img
		var file    = document.querySelector('input[type=file]').files[0]; //sames as here
		var reader  = new FileReader();
	
		reader.onloadend = function () {
			preview.src = reader.result;
		}
	
		if (file) {
			reader.readAsDataURL(file); //reads the data as a URL
		} else {
			preview.src = "/img/no-thumbnail.jpg";
		}
	}
	previewFile();  
</script>
@endsection