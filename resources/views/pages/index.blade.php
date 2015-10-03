@extends ('layouts.master')

@section ('content')

<div class="row">
	<div class="col-md-12">
		<h2>Seller <small>List</small></h2>
		<hr />
	</div>
</div>

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-12">
		<a href="{{ action('SellerController@create') }}" class="btn btn-danger btn-sm">New Seller</a>
	</div>
</div>

@if (session('success'))
<div class="row" style="margin-bottom: 10px">
	<div class="col-md-12">
		<div class="alert alert-success">
		{{ session('success') }}
		</div>
	</div>
</div>
@endif


<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Category</th>
				<th>Address</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th colspan="2">Action</th>
			</tr>
			@if ($sellers->count())
			@foreach ($sellers as $seller)
			<tr>	
				<td><a href="{{ action('SellerController@show', array('id' => $seller->id)) }}" target="_blank">{{ $seller->name }}</a></td>
				<td>{{ $seller->category->name }}</td>
				<td>{{ $seller->address }}</td>
				<td>{{ $seller->phone }}</td>
				<td>{{ $seller->email }}</td>
				<td><a href="{{ action('SellerController@edit', array('id' => $seller->id)) }}">Edit</a></td>
				<td><a href="{{ action('SellerController@destroy', array('id' => $seller->id)) }}">Delete</a></td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>
</div>

@endsection