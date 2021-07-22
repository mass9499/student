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
                            
                        <form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data" > 
                            
                            @csrf
                            @method('PUT')
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                      Student Name
                                    </label>
                                    <div class="col-lg-3">
                                          <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$student->first_name}}" required>
                                    </div>
                                     <div class="col-lg-3">
                                          <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$student->last_name}}"required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Phone Number
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="phone_number" value="{{$student->phone_number}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Date of Birth
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" id="dob" name="dob" class="form-control" value="{{$student->dob}}" required="" autocomplete="off">
                                    </div>
                                </div>

                                
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Email
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="email" class="form-control" name="email" value="{{$student->email}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        ASEC Registration ID 
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="student_code" value="{{$student->student_code}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Application Date
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" id="application_date" name="application_date" value="{{$student->application_date}}"  required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                     University Name
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="university_name" value="{{$student->university_name}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       University Application ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="application_id" value="{{$student->application_id}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Major
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="major" value="{{$student->major}}"  required>
                                    </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Intake
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="intake" value="{{$student->intake}}" required>
                                    </div>
                                </div>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Status
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="status" value="{{$student->status}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Action Needed
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="action_needed" value="{{$student->action_needed}}" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Comments
                                    </label>
                                    <div class="col-lg-6">
                                           <textarea type="text" class="form-control" name="comments"  required>{{$student->comments}}</textarea>
                                    </div>
                                </div>
                                <hr><b><h4>UNIVERSITY LOGIN INFORMATION </h4></b><br>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                    Login ID
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_id" value="{{$student->login_id}}" required>
                                    </div>
                                </div>

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_password" required>
                                    </div>
                                </div>


                                
                                
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        
                                        <button class="btn btn-success"><span>Update</span></button>
                                        <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>        
                
                           
                        </div>
                    </div>
                </div>
@endsection

@push('scripts')
<script type="text/javascript">

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
</script>
@endpush