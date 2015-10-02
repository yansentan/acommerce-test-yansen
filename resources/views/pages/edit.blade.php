@extends ('layouts.master')

@section ('content')

<div class="row">
	<div class="col-md-12">
		<h2>Seller <small>Edit</small></h2>
		<hr />
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
	<div class="col-md-6">
		<form class="form" action="{{ action('SellerController@update') }}" method="POST">
		{!! csrf_field() !!}
		
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" value="{{ $seller->name }}" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Category</label>
			<select name="category" class="form-control">
				@foreach ($categories as $category)
				@if ($category->id == $seller->category_id)
				<option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>	
				@else
				<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endif
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label>Address</label>
			<input type="text" name="address" value="{{ $seller->address }}" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Phone</label>
			<input type="text" name="phone" value="{{ $seller->phone }}" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" value="{{ $seller->email }}" class="form-control">
		</div>
		
		<input type="hidden" name="seller_id" value="{{ $seller->id }}" />
		<input type="submit" value="Update" class="btn btn-primary">
		
		</form>
	</div>
</div>

@endsection