@extends('layouts.admin')



@section('content')



	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: 30px">

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

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: 30px">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> 
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">

                   NEW STUDENTS LIST

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!-- <div class="kt-portlet__head-actions"> <a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ route('students.create') }}">Add Student</a> </div> -->
                </div>
            </div>
        </div>
        <div class="kt-portlet__body"> @if(Session::has('message'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>

                                                {{ Session::get('message') }}

                                            </strong> </div>
                </div>
            </div> @endif
            <table class="table table-bordered m-table m-table--border-primary" id="datatables">
                <thead>
                    <tr>
                        
                        <th>SNo</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Register Date</th>
                        <!--    <th>View</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> @foreach($students_data as $key => $student)
                    <tr class="" data-id="{{ $student->id}}">
                        
                        <td>{{$key + 1}}</td>
    
                        <td>{{ $student->student_code }}</td>
                
                       
                        <td>{{ $student->first_name." ".$student->last_name }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->created_at }}</td>
                        <td>
                            <a href="{{route('students.edit', $student->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

                    </tr>
                    
                     @endforeach </tbody>
            </table>
        </div>
    </div>
</div>



                      

@endsection



@push('scripts')



@endpush