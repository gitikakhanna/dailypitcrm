@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row mb-5">
			<div class="col-12">
				<h3 class="text-uppercase">Add category</h3>
				<form method="post" action="/category/add" enctype="multipart/form-data">
					<div class="input-group mb-3 mt-5">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-plus"></i>
							</span>
						</div>
						<input type="text" class="form-control" name="category_name" placeholder="Add Category name" aria-label="category_name" aria-describedby="basic-addon2">
					</div>
					<label class="mt-4">Choose Category Image</label>
					<input type="file" name="category_img" class="show-preview" accept="image/*" data-target="#category_img" value="">
					{{csrf_field()}}
					<button class="btn btn-primary mt-5" type="submit">Add Category</button>
				</form>	
			</div>
		</div>

		<hr> 
		<div class="row mt-5">
			<div class="col-12">
				<h3 class="text-uppercase">Add Subcategory</h3>
				<form method="post" action="/subcategory/add" enctype="multipart/form-data">
					<label class="mt-3">Choose category</label>
					<select class="form-control" name="category">
						<option value="0">Choose</option>
						@forelse($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
							@empty{{''}}
						@endforelse
					</select>
					<div class="input-group mb-3 mt-5">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-plus"></i>
							</span>
						</div>
						<input type="text" class="form-control" name="subcategory_name" placeholder="Add Subcategory name" aria-label="subcategory_name" aria-describedby="basic-addon2">
					</div>
					<label class="mt-4">Choose Category Image</label>
					<input type="file" name="subcategory_img" class="show-preview" accept="image/*" data-target="#subcategory_img" value="">
					{{csrf_field()}}
					<button class="btn btn-primary mt-5" type="submit">Add Subcategory</button>
				</form>
			</div>
		</div>
	</div>
@endsection