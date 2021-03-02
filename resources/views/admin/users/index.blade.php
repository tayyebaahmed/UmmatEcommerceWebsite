@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Customers</li>
@endsection
@section('content')
@include('admin.partials.sidebar')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Customer List</h2>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('admin.profile.index')}}" class="btn btn-sm btn-outline-success">
      All Customers
    </a>&nbsp;&nbsp;
    <a href="{{ route('admin.profile.create') }}" class="btn btn-sm btn-outline-secondary">
      Add Customer
    </a>&nbsp;&nbsp;
    <a href="{{route('admin.profile.trash')}}" class="btn btn-sm btn-outline-primary">
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
                <th width="6%">#</th>
                <th width="6%">user#</th>
                <th width="30%">Name</th>
                <th width="30%">Phone</th>
                <th width="20%">Date</th>
                <th width="8%" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
          @if($profiles->count() > 0)
          @foreach($profiles as $profile)
            <tr>
                <td>{{ $profile->id }}</td>
                <td>{{ $profile->user_id }}</td>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->phone }}</td>
                @if($profile->trashed())
                <td>{{$profile->deleted_at}}</td>
                @else
                <td>{{$profile->created_at}}</td>
                @endif
                <td>
                  <a class="btn btn-primary btn-sm" href="{{route('admin.profile.edit',$profile->id)}}" title="Click To Edit Record"><i class="fa fa-edit" aria-hidden="true"></i></a>   
                </td>
                @if($profile->trashed())
                <td>
                  <a class="btn btn-warning btn-sm" href="{{route('admin.profile.recover',$profile->id)}}" title="Click To Restore Record"><i class="fa fa-undo" aria-hidden="true"></i></a>   
                </td>
                @else
                <td>
                  <form action="{{ route('admin.profile.destroy', $profile->id)}}" method="post">
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
                <td colspan="6" class="text-center"><i>No Customers Found</i></td>
            </tr>
          @endif
        </tbody>
    </table>
</div>
<div class="row">
  <div class="col-md-12">
    {{ $profiles->links() }}
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