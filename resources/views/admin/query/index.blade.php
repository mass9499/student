@extends('layouts.admin') @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">{{ $title }}</h3> </div>
        </div>
        <div class="kt-portlet__body"> @if(Session::has('message'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>{{ Session::get('message') }}</strong> </div>
                </div>
            </div> @endif
            <table class="table table-bordered m-table m-table--border-primary" id="datatables">
                <thead>
                    <tr>
                        <th>SNo</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> @foreach($querys as $key => $query)


                    <tr   class="@if($query->admin_read_status == 1) alert-success @else alert-danger  @endif" >
                        <td>{{$key + 1}}</td>
                        
                        <td>{{ $query->student_code }}</td>
                        <td>{{ $query->first_name }}</td>
                        <td>@php echo substr($query->message,0,100); @endphp...</td>
                        <td>{{ date("d-m-Y H:i:s",strtotime($query->updated_at)) }}</td>
                          <td>
                                @if($query->admin_read_status == 1)
                                <span class="btn  btn-success"> Read</span>
                                @else
                                <span class="btn  btn-danger">Unread</span>
                                @endif
                             </td>
                        <td> <a href="{{ url('/')}}/admin/query/reply/{{$query->user_id}}" class="btn btn-warning"><i class="fa fa-comments"></i></a> </td>
                    </tr> @endforeach </tbody>
            </table>
        </div>
    </div>
</div> @endsection @push('scripts')
<script type="text/javascript">
$(document).on("change", ".update_status", function() {
    if($(this).is(":checked")) {
        var status = 1;
    } else {
        var status = 0;
    }
    var id = $(this).attr("data-id")
        //alert(id);
    $.ajax({
        url: "{{URL('/')}}/admin/customer/status/" + id + "/" + status,
        success: function(e) {}
    });
});
</script> @endpush