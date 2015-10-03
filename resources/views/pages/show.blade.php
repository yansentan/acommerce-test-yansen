@extends ('layouts.master')

@section ('content')

<div class="row">
	<div class="col-md-12">
		<h2>{{ $seller->name }}'s <small>Profile</small></h2>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<td><strong>Category</strong></td>
				<td>{{ $seller->category->name }}</td>
			</tr>
			<tr>
				<td><strong>Address</strong></td>
				<td>{{ $seller->address }}</td>
			</tr>
			<tr>
				<td><strong>Phone</strong></td>
				<td>{{ $seller->phone }}</td>
			</tr>
			<tr>
				<td><strong>Email</strong></td>
				<td>{{ $seller->email }}</td>
			</tr>
		</table>
	</div>
</div>

@endsection