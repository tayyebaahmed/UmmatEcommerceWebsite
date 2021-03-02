@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Category</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<form action="{{route('admin.category.update', $category->id)}}" method="POST" accept-charset="utf-8">
	@method('PATCH')
    @csrf
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
	</div>
	<div class="form-group row">
			<div class="col-sm-12">
				<label class="form-control-label">Name / Title: </label>
				<input type="text" name="title" value="{{$category->title}}" class="form-control ">
			</div>
			<div class="col-sm-12">
				<label class="form-control-label">Description: </label>
				<textarea name="description" class="form-control" rows="5" cols="80">{{$category->description}}</textarea>
			</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12">
			<input type="submit" name="submit" class="btn btn-primary" value="Save Changes" /> 
		</div>		
	</div>	
</form>
@endsection