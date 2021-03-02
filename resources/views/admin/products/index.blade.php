@extends('admin.app');
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Products</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Product List</h2>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-outline-success">
      All Products
    </a>&nbsp;&nbsp;
    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-outline-secondary">
      Add Product
    </a>&nbsp;&nbsp;
    <a href="{{route('admin.product.trash')}}" class="btn btn-sm btn-outline-primary">
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
                <th width="10%">#</th>
                <th width="15%">Name / Title</th>
                <th width="35%">Description</th>
                <th width="5%">Price</th>
                <th width="10%">Image</th>
                <th width="15%">Date</th>
                <th width="10%" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
          @if($products->count() > 0)
          @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td><img alt="" src="/storage/products/{{$product->photo}}" width="40px" height="40px"></td>
                @if($product->trashed())
                <td>{{$product->deleted_at}}</td>
                @else
                <td>{{$product->created_at}}</td>
                @endif
                <td>
                  <a class="btn btn-info btn-sm" href="{{route('admin.product.edit', $product->id)}}">
                    <i class="fa fa-edit"></i>
                  </a>
                </td>
                @if($product->trashed())
                <td>
                  <a class="btn btn-warning btn-sm" href="{{route('admin.product.recover',$product->id)}}" title="Click To Restore Record"><i class="fa fa-undo" aria-hidden="true"></i></a>   
                </td>
                @else
                <td>
                  <form action="{{ route('admin.product.destroy', $product->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete()"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                @endif
            </tr>
          @endforeach
          @else
            <tr>
                <td colspan="7" class="text-center"><i>No Products Found</i></td>
            </tr>
          @endif
        </tbody>
    </table>
</div>
<div class="row">
  <div class="col-md-12">
    {{ $products->links() }}
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