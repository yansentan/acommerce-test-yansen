@extends ('layouts.master')

@section ('content')

<div class="row">
	<div class="col-md-12">
		<h2>Seller <small>List</small></h2>
	</div>
</div>

<div class="row" style="margin-bottom: 10px">
	<div class="col-md-12">
		<a href="{{ action('SellerController@create') }}" class="btn btn-danger btn-sm">New Seller</a>
	</div>
</div>


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
				<td>{{ $seller->name }}</td>
				<td>{{ $seller->category->name }}</td>
				<td>{{ $seller->address }}</td>
				<td>{{ $seller->phone }}</td>
				<td>{{ $seller->email }}</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>
</div>

@endsection