@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
    @include('admin.partials.sidebar')
            <h3>Welcome to the dashboard!</h3>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection