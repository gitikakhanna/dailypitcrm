@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="text-uppercase">Partner Requests</h3>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-12 mt-4">
				<h5 class="text-captalize">Pending Request</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Email Id</th>
							<th scope="col">Contact No</th>
							<th scope="col">Address</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($req as $requests)
							<tr>
								<td scope="row">{{$requests->id}}</td>
								<td scope="row">{{$requests->name}}</td>
								<td scope="row">{{$requests->emailid}}</td>
								<td scope="row">{{$requests->phoneno}}</td>
								<td scope="row">{{$requests->address}}</td>
								<td scope="row">
									<a href="/freelancer/{{$requests->id}}" class="text-white btn btn-success">Approve</a>
									<button onclick="reject()" class="btn btn-danger">Reject</button>
								</td>
							</tr>							
						@empty{{''}}
						@endforelse

					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript">
		function reject(){
			if(confirm("Are you sure you want to reject this request?")){
				alert('rejected');
			}
		}
	</script>
@endsection