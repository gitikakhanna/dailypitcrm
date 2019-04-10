@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="text-uppercase">Add Service</h3>
				<form method="post" action="/services/add" enctype="multipart/form-data">
					<div class="row">
						<div class="col-6">
							<label class="mt-4">Choose Category</label>
							<select class="form-control" name="category" id="category_change">
								<option value="0">Choose</option>
								@forelse($categories as $category)
									<option value="{{$category->id}}">{{$category->name}}</option>
									@empty{{''}}
								@endforelse
							</select>
						</div>
						<div class="col-6">
							<label class="mt-4">Choose Subcategory</label>
							<select class="form-control" name="subcategory" id="subcategory_change">
								<option value="0">Choose</option>
							</select>
						</div>
					</div>
					<label class="mt-3">Regular Price</label>
					<input type="number" name="reg_price" class="form-control" placeholder="Regular Price">
					<label class="mt-3">AMC Price</label>
					<input type="number" name="amc_price" class="form-control" placeholder="AMC Price">

					<label class="mt-3">Discount (%)</label>
					<input type="number" name="discount" class="form-control w-50" placeholder="Discount">

					<label class="mt-3">Description</label>
					<textarea name="description" rows="20" id="ckeditor-1" class="form-control" placeholder="Add details here..."></textarea>
				
					<div class="row mt-3">
						<div class="col-6">
							<label class="mt-3">Regular Service Detail(optional)</label>
							<textarea name="reg_detail" rows="20" id="ckeditor-2" class="form-control" placeholder="Add details here for regular service..."></textarea>
						</div>
						<div class="col-6">
							<label class="mt-3">AMC Service Detail(optional)</label>
							<textarea name="amc_detail" rows="20" id="ckeditor-3" class="form-control" placeholder="Add details here for AMC service..."></textarea>
						</div>
					</div>
					{{csrf_field()}}
					<button class="btn btn-primary mt-5" type="submit">Add Service</button>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('extra-js')
	<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
	<script type="text/javascript">
		$('#category_change').change(function(){
			var cat = $('#category_change').val();
			$('#subcategory_change').empty();
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200)
               {
                    console.log(this.responseText);
               		var json = JSON.parse(this.responseText);
               		html = '';
               		for(i=0; i<json.length; i++){
               			section = json[i];
               			html += '<option value="'+section.id+'">'+section.subcategory_name+'</option>';
               		}

               		$('#subcategory_change').append(html);
               }
            };
            xhttp.open("POST", '/api/subcategory-retrieve', true);
            xhttp.setRequestHeader('X-CSRF-TOKEN',$('meta[name="csrf-token"]').attr('content'));
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send('id='+cat);
		});

		ClassicEditor
		        .create( document.querySelector( '#ckeditor-1' ) )
		        .catch( error => {
		            console.error( error );
		        } );

		ClassicEditor
		        .create( document.querySelector( '#ckeditor-2' ) )
		        .catch( error => {
		            console.error( error );
		        } );

		ClassicEditor
		        .create( document.querySelector( '#ckeditor-3' ) )
		        .catch( error => {
		            console.error( error );
		        } );
	</script>
@endsection