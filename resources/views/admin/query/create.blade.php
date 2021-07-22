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


                                    <hr><b><h4>STUDENT DOCUMENTS </h4></b><br>

                                <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 1
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document[0]"  >
                                    </div>

                                  </div>  
                                </div>
                                 <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 2
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document[1]" >
                                    </div>

                                  </div>  
                                </div>
                                 <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 3
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document[2]" >
                                    </div>

                                  </div>  
                                </div>
                                 <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 4
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document[3]" >
                                    </div>

                                  </div>  
                                </div>

                                 <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 5
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document[4]"  >
                                    </div>

                                  </div>  
                                </div>

                                 <hr><b><h4>UNIVERSITY DETAILS </h4></b><br>

                   
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Application Date
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" id="application_date" name="application_date"  value="{{ old('application_date') }}"  >
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                     University Name
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="university_name" value="{{ old('university_name') }}" >
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       University Application ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="application_id"  value="{{ old('application_id') }}" >
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Major
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="major" value="{{ old('major') }}"  >
                                    </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Intake
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="intake" value="{{ old('intake') }}"  >
                                    </div>
                                </div>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Status
                                    </label>
                                    <div class="col-lg-6">
                                      <textarea  name="status"  class="status form-control">{{ old('status') }}</textarea>
                                      
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Action Needed
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="action_needed"  value="{{ old('action_needed') }}">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Comments
                                    </label>
                                    <div class="col-lg-6">
                                          <textarea type="text" class="form-control" name="comments"  >{{ old('comments') }}</textarea>
                                    </div>
                                </div>
                                <hr><b><h4>UNIVERSITY LOGIN INFORMATION </h4></b><br>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                    Login ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_id" value="{{ old('login_id') }}"  autocomplete="off">
                                    </div>
                                </div>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_password" value="{{ old('login_password') }}"  >
                                    </div>
                                </div>

                             
                                
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        
                                        <button class="btn btn-success"><span>Submit</span></button>
                                        <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                
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

    $(".status").summernote({height: 300});
</script>

@endpush