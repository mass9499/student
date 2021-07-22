@extends('layouts.admin')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<h5 class="card-header"><b>STUDENTS</b></h5>
					<div class="card-body">
					 	<h5 class="card-title">No of Registered Students</h5>
					    <p class="card-text"> <h5> <strong>Total: {{ $students}} </strong></h5></p>
					    
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<h5 class="card-header"><b>STUDENTS</b></h5>
					<div class="card-body">
					 	<h5 class="card-title">New Registered Students</h5>
					    <p class="card-text"> <h5> <strong>Total: {{ $new_students}}</strong></h5></p>
					    
					</div>
				</div>
			</div>
		</div>
		

	</div>

                      
@endsection

@push('scripts')

@endpush