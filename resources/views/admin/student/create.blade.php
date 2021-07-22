@extends('layouts.admin')
@section('content')
<div class="col-md-12">
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
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                           
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error}}</li>
                                            @endforeach 
                                        </ul>
                                    </div>
                                @endif
                            
              <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data" id="validate_id" > 
                            
                            @csrf
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                      Student Name
                                    </label>
                                    <div class="col-lg-3">
                                          <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                                    </div>
                                     <div class="col-lg-3">
                                          <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"required>
                                    </div>
                                   
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Phone Number
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Date of Birth
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" id="dob" name="dob" class="form-control" required="" value="{{ old('dob') }}" readonly="" autocomplete="off">
                                    </div>
                                </div>
                                 <hr><b><h4>STUDENT LOGIN </h4></b><br>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Email
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="email" class="form-control" name="email"  value="{{ old('email') }}"  required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                    </div>
                                </div>
                             <!--  <hr><b><h4>STUDENT DOCUMENTS </h4></b><br>
 -->             <hr>

                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Send Mail
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="checkbox" class="" name="send_mail"  value="1" >
                                    </div>
                                </div>


                 <!--  <div class="row">
                      <div class="col-md-6">
                        <h3>Documents</h3>
                      </div>
                      <div class="col-md-4">
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning" id="add_more" onclick="add_doc_row();">Add More
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger remove" id="remove_one" onclick="remove_doc_clone();">Remove</button>                                      
                        </div>
                      </div>
                  </div>
                  <br> -->
<!-- 
                        <div class="doc_org_container">
                            <div class="doc_org_container_rows">
                                <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 
                                    </label>
                                    <div class="col-lg-3">
                                      <select name="document_type[]" class="form-control">
                                        <option value=""> Select Document Type</option>
                                        @foreach($document_types as $row)
                                        <option value="{{$row->id}}"> {{$row->document_name}}</option>
                                         @endforeach
                                      </select>
                                    </div>
                                    <div class="col-lg-3">
                                          <input type="file" class="form-control" name="document[]"  >
                                    </div>
                          </div>  
                        </div>
                        </div> -->
                       <!--  <div class="doc_cloned_row">
                          
                        </div> -->
                      <!--     <div class="org_container">
                            <div class="org_container_rows">
                                 <hr><b><h4>UNIVERSITY DETAILS </h4></b><br>
                   
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Application Date
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" id="application_date" name="application_date[]"  value="{{ old('application_date') }}"  >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                     University Name
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="university_name[]" value="{{ old('university_name') }}" >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       University Application ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="application_id[]"  value="{{ old('application_id') }}" >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Major
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="major[]" value="{{ old('major') }}"  >
                                    </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Intake
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="intake[]" value="{{ old('intake') }}"  >
                                    </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Status
                                    </label>
                                    <div class="col-lg-6">
                                      <textarea  name="status[]"  class="status form-control">{{ old('status') }}</textarea>
                                      
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Action Needed
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="action_needed[]"  value="{{ old('action_needed') }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Comments
                                    </label>
                                    <div class="col-lg-6">
                                          <textarea type="text" class="form-control" name="comments[]"  >{{ old('comments') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Action Date
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="action_date[]" id="action_date" value="{{ old('action_date') }}" autocomplete="off">
                                    </div>
                                </div>
                                <hr><b><h4>UNIVERSITY LOGIN INFORMATION </h4></b><br>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                    Login ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_id[]" value="{{ old('login_id') }}"  autocomplete="off">
                                    </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_password[]" value="{{ old('login_password') }}"  >
                                    </div>
                                </div>
                                  <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Offer Letter
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="offer_letter[]" value=""  >
                                    </div>
                                </div>
                              </div>
                            </div>
                             
                                
                            </div>
                        </div>
                      <div class="cloned_row"> 
                      </div> -->
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        
                                        <button class="btn btn-success"><span>Submit</span></button>
                                        <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                   <!--  <div class="">
                                       
                                       <button type="button" class="btn btn-info" id="add_more" onclick="add_row();"><i class="fa fa-plus"></i></button>&nbsp;
                                        <button type="button" class="btn btn-danger" id="remove_one" 
                                        onclick="remove_clone();"><i class="fa fa-minus"></i></button>
                                      
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>        
                        </div>
                    </div>
                </div>
    
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$("#validate_id").validate({
    focusInvalid: false,
    invalidHandler: function(form, validator) {
        if (!validator.numberOfInvalids())
            return;
        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 2000);
    }
});
          var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    $("#dob").datepicker({
        format: 'yyyy-mm-dd',
                orientation: "bottom left",
                        templates: arrows,
                        autoclose: true
    });
    $("#application_date").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });
    
    $("#action_date").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });
    $(".status").summernote({height: 150});
</script>
<script type="text/javascript">
       function add_row()
       {
          $('.org_container .org_container_rows').clone().find('input').val('').end().find('textarea').val('').end().appendTo('.cloned_row');
        }
        function remove_clone()
        {  
            $('.cloned_row .org_container_rows').last().remove();
        }
</script>
<script type="text/javascript">
      function add_doc_row()
      {
        $('.doc_org_container .doc_org_container_rows').clone().appendTo('.doc_cloned_row');
        
      }
      function remove_doc_clone()
      {  
          $('.doc_cloned_row .doc_org_container_rows').last().remove();
      }
        
</script>
@endpush