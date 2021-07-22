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

                            

                  <form method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data" id="validate_id" > 

                            

                            @csrf

                        <div class="m-portlet__body">

                            <div class="m-form__section m-form__section--first">





                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                      Admin Name

                                    </label>

                                    <div class="col-lg-6">

                                          <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') }}" required>

                                    </div>

                                   

                                </div>



                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                        Email

                                    </label>

                                    <div class="col-lg-6">

                                          <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">

                                    </div>

                                </div>



                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                       Password

                                    </label>

                                    <div class="col-lg-6">

                                            <input type="password" id="" name="password" class="form-control" required="" value="{{ old('password') }}" autocomplete="off">

                                    </div>

                                </div>

                              



                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                       Gender

                                    </label>

                                    <div class="col-lg-6">

                                         <select name="gender" class="form-control">

                                           <option value="">Select gender</option>

                                           <option value="1">Male</option>

                                           <option value="2">Female</option>

                                         </select>

                                    </div>

                                </div>

                                  <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                         Mobile

                                    </label>

                                    <div class="col-lg-6">

                                      <input type="text" class="form-control" name="mobile_no"  value="{{ old('mobile_no') }}" autocomplete="off" >

                                    </div>

                                </div>



                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">

                                         Date of Birth

                                    </label>

                                    <div class="col-lg-6">

                                      <input type="text" class="form-control" id="dob" name="dob"  value="{{ old('dob') }}" autocomplete="off" >

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



    $(".status").summernote({height: 150});

</script>



@endpush