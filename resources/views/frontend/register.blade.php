@extends('layouts.app')
@section('content')

<div class="dashboard">
    <div class="container">
        
      <div class="row  m-t30">
    
            <div class="col-md-8 offset-md-2 user-img-box "> 

              <div class="m-form__section m-form__section--first">
                                <h3 class="text-center">Registration</h3>
                                <hr>
                                <p>&nbsp;</p>
                                
                   @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>

                                @foreach($errors->all() as $error)
                                    <li>{{ $error}}</li>
                                @endforeach 

                            </ul>
                        </div>
                    @endif
                            
                       <form class="form-signin" method="POST" action="" >
              
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            @csrf
                        <div class="m-portlet__body">

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label">
                                      Student Name
                                    </label>
                                    <div class="col-lg-4">
                                          <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                    </div>
                                     <div class="col-lg-4">
                                          <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label">
                                       Phone Number
                                    </label>
                                    <div class="col-lg-8">
                                          <input type="text" class="form-control" name="phone_number" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label">
                                       Date of Birth
                                    </label>
                                    <div class="col-lg-8">
                                            <input type="date" id="dob" name="dob" class="form-control" required="" autocomplete="off">
                                    </div>
                                </div>

                                
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label">
                                       Email
                                    </label>
                                    <div class="col-lg-8">
                                          <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-4 col-form-label">
                                       Password
                                    </label>
                                    <div class="col-lg-8">
                                          <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        
                                        <button class="btn btn-success"><span>Submit</span></button>
                                       
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
<script type="text/javascript" src="{{url('/')}}/public/js/jquery.validation.js"></script>
<script type="text/javascript">
  $("#register").validate({
      rules: {
        first_name: "required",
        last_name: "required",
        password: {
          required: true,
          minlength: 5
        },
        cpassword: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        },
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        firstname: "Please enter your firstname",
        lastname: "Please enter your lastname",
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        cpassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        email: "Please enter a valid email address",
      }
    });

   $("#dob").datepicker({
        format: 'yyyy-mm-dd',
                orientation: "bottom left",
                        templates: arrows,
                        autoclose: true
    });
   
</script>
@endpush('scripts')