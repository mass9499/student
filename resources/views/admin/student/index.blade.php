@extends('layouts.admin') @section('content')
<style type="text/css">
    .expand_data i{ font-size: 24px; }
    .btn-sm{ padding: 5px; }
</style>
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
                    <div class="kt-portlet__head-actions"> <a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ route('students.create') }}">Add Student</a> </div>
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
            <table class="table table-bordered m-table m-table--border-primary" id="datatables_ajax">
                <thead>
                    <tr>
                        
                        <th>SNo</th>
                        <th data-orderable="false"></th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action Date</th>
                        <th>Updated</th>
                        <!--    <th>View</th> -->
                        <th data-orderable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div> @endsection @push('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        $('#datatables_ajax').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('admin/students/ajax') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "university" },
                { "data": "student_code" },
                { "data": "first_name" },
                { "data": "phone_number" },
                { "data": "email" },
                { "data": "action_date" },
                { "data": "updated_date" },
                { "data": "action" }
            ]    

        });
    });
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

$('body').on("click",".expand_data .fa-caret-right",function(){
    var data = $(this).parents("tr").find(".all_unversity").html();
    var that =$(this);
        that.parents("tr").after("<td colspan='9'>"+data+"</td></tr>");
        that.removeClass('fa-caret-right');
        that.addClass('fa-caret-down');

    //     $.ajax({
    //     // url: "{{URL('/')}}/admin/students/university/" + id ,
    //     // success: function(e) {
    //     //     that.parents("tr").next().remove();
    //     //     that.parents("tr").after(e);
    //     //     that.removeClass('fa-caret-right');
    //     //     that.addClass('fa-caret-down');

    //     // },
    //     // fail(){
    //     //     that.parents("tr").after("<td colspan='8'>failed</td></tr>");
    //     // }
    // });
    
});

$('body').on("click",".expand_data .fa-caret-down",function(){
   
    var that =$(this);
    that.parents("tr").next().remove();
    that.addClass('fa-caret-right');
    that.removeClass('fa-caret-down');
    
});
</script> @endpush

<!-- <tr><td colspan='2'></td></tr> -->