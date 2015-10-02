@extends ('layouts.master')

@section ('content')

<div class="row">
	<div class="col-md-12">
		<h2>Seller <small>Create</small></h2>
	</div>
</div>

@if (count($errors) > 0)
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
		<ul>
			<li>{{ $error }}</li>
		</ul>
		@endforeach
		</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<form class="form" action="{{ action('SellerController@store') }}" method="POST">
		{!! csrf_field() !!}
		
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" placeholder="Enter seller name" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Category</label>
			<select name="category" class="form-control">
				@foreach ($categories as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label>Address</label>
			<input type="text" name="address" placeholder="Enter seller address" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Phone</label>
			<input type="text" name="phone" placeholder="Enter seller phone" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" placeholder="Enter seller email" class="form-control">
		</div>
		
		<input type="submit" value="Create">
		
		</form>
	</div>
</div>

@endsection