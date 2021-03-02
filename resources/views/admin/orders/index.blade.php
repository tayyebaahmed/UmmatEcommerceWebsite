@extends('admin.app');
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Orders</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Order List</h2>
  <div class="btn-toolbar mb-2 mb-md-0">
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
                <th width="10%">Name / Title</th>
                <th width="10%">Product Id</th>
                <th width="10%">User Id</th>
                <th width="10%">Status</th>
                <th width="10%">Date</th>
                <th width="40%" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="text-center"><i>No Orders Found</i></td>
            </tr>
        </tbody>
    </table>
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