@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Categories List</h2>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-outline-success">
      All Categories
    </a>&nbsp;&nbsp;
    <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-outline-secondary">
      Add Category
    </a>&nbsp;&nbsp;
    <a href="{{route('admin.category.trash')}}" class="btn btn-sm btn-outline-primary">
      Trash List
    </a>
  </div>
</div>
<div class="row">
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
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr style="background-color: #CCCCCC">
                <th width="12%">#</th>
                <th width="30%">Name / Title</th>
                <th width="30%">Description</th>
                <th width="20%">Date</th>
                <th width="8%" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
          @if($categories->count() > 0)
          @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                @if($category->trashed())
                <td>{{$category->deleted_at}}</td>
                @else
                <td>{{$category->created_at}}</td>
                @endif
                <td>
                  <a class="btn btn-primary btn-sm" href="{{route('admin.category.edit',$category->id)}}" title="Click To Edit Record"><i class="fa fa-edit" aria-hidden="true"></i></a>   
                </td>
                @if($category->trashed())
                <td>
                  <a class="btn btn-warning btn-sm" href="{{route('admin.category.recover',$category->id)}}" title="Click To Restore Record"><i class="fa fa-undo" aria-hidden="true"></i></a>   
                </td>
                @else
                <td>
                  <form action="{{ route('admin.category.destroy', $category->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete()" title="Click To Delete Record"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                @endif
            </tr>
          @endforeach
          @else
            <tr>
                <td colspan="5" class="text-center"><i>No Categories Found</i></td>
            </tr>
          @endif
        </tbody>
    </table>
</div>
<div class="row">
  <div class="col-md-12">
    {{ $categories->links() }}
  </div>
</div>
<script>
//   use event.preventDefault(); 
//   to confirm any delete
function confirmDelete() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
</script>
@endsection