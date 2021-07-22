@extends('layouts.admin')

@section('content')

 <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    {{ $title }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                                     
                                      <a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ route('students.create') }}">Add Student</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                          @if(Session::has('message'))

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>
                                                {{ Session::get('message') }}
                                            </strong>
                                        
                                        </div>
                                    </div>
                                </div>
                            @endif
                        
                       
                            <table class="table table-bordered m-table m-table--border-primary" id="datatables">
                                <thead>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                     @foreach($students as $key => $student)
                                     
                                     <tr>
                                         <td>{{$key + 1}}</td>
                                       
                                         <td>{{ $student->first_name." ".$student->last_name }}</td>
                                         <td>{{ $student->phone_number }}</td>
                                         <td>{{ $student->email }}</td>
                                         
                                         <td> 
                                            <form method="post" action="{{route('students.destroy', $student->id)}}" enctype="multipart/form-data" >
                                              
                                              
                                            <a href="{{route('students.edit', $student->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are Sure to Delete')"><i class="fa fa-trash"></i></button>
                                               
                                            </form>
                                     </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
@endsection



@push('scripts')
   
<script type="text/javascript">


        $(document).on("change",".update_status",function() {
            if($(this).is(":checked")) { var status = 1;}
            else{   var status = 0;  }  
            var id= $(this).attr("data-id")
            //alert(id);
            $.ajax({
                url: "{{URL('/')}}/admin/customer/status/" + id + "/" +status ,
                    success: function(e) {
                }
            });
        });
 
  </script>
 @endpush