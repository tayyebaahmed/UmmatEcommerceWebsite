@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
<li class="breadcrumb-item active" aria-current="page">Add Category</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<form action="{{route('admin.category.store')}}" method="post" accept-charset="utf-8">
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
		<div class="col-sm-12">
			<label class="form-control-label">Name / Title: </label>
			<input type="text" id="txturl" name="title" class="form-control ">
		</div>
	</div>
	<div class="form-group row">
		
		<div class="col-sm-12">
			<label class="form-control-label">Description: </label>
			<textarea name="description" id="editor" class="form-control " rows="5" cols="80"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12">
			<input type="submit" name="submit" class="btn btn-primary" value="Add Category" />
		</div>		
	</div>	
</form>
@endsection