@extends('layouts.admin') @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">

                                    <i class="kt-font-brand flaticon2-line-chart"></i>

                                </span>
                <h3 class="kt-portlet__head-title">

                                    {{ $title }}

                                </h3> </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions"> </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body"> 


             @if(Session::has('error'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>

                                                {{ Session::get('error') }}

                                            </strong> </div>
                </div>
            </div> @endif


            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul> @foreach($errors->all() as $error)
                    <li>{{ $error}}</li> @endforeach </ul>
            </div> @endif
            <form method="post" autocomplete="off" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data" id="validate_id"> @csrf @method('PUT')
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Admin Name </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name', $admin->name) }}" required> </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Email </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="email" value="{{ old('email', $admin->email) }}" required autocomplete="off"> </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Gender </label>
                            <div class="col-lg-6">
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="1" {{ old( 'gender',$admin->gender) == 1 ? 'selected' : '' }} >Male</option>
                                    <option value="2" {{ old( 'gender',$admin->gender) == 2 ? 'selected' : '' }} >Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Mobile </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no', $admin->mobile_no) }}" autocomplete="off"> </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Date of Birth </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="dob" name="dob" value="{{ old('dob', $admin->dob) }}" autocomplete="off"> </div>
                        </div>
                        <h4>Change Password</h4>
                        <hr>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> New Password </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="new_password" name="new_password"  autocomplete="new-password"> </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label"> Confirm Password </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"  autocomplete="off"> </div>
                        </div>

                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-success"><span>Update</span></button> <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a> </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> @endsection @push('scripts')
<script type="text/javascript">
$("#validate_id").validate({
    focusInvalid: false,
    invalidHandler: function(form, validator) {
        if(!validator.numberOfInvalids()) return;
        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 2000);
    }
});
var arrows;
if(KTUtil.isRTL()) {
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
$(".status").summernote({
    height: 150
});
</script> @endpush