@extends('layouts.app')
@section('content')

<div class="blog m-b50 m-t50">
<div class="container">
  <div class="col-md-12 login-box">
  <div class="row">
      <div class="col-md-6 login">
        <div class="loin-box-2 m-b50">
        <h2 class="m-b10"><span class="br-btm">FORGET PASSWORD</span></h2>
        
                       @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>

                                            @foreach($errors->all() as $error)
                                                <li>{{ $error}}</li>
                                            @endforeach 

                                        </ul>
                                    </div>
                                @endif
                         
           


                          @if(Session::has('error'))

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>
                                                {{ Session::get('error') }}
                                            </strong>
                                        
                                        </div>
                                    </div>
                                </div>
                            @endif


                      <form method="post" action="{{url('/')}}/reset_password_post" id="reset">
                           {{ csrf_field() }}
                          <input type="hidden" name="otp" value="{{$student->otp}}">
                          <div class="form-group"> 
                            <label class="lab-right">New Password  <span style="color: red;">*</span></label>
                            <input type="password" name="password" id="password" class="form-control login-input" placeholder="Enter Your New Password" >
                          </div>

                             <div class="form-group"> 
                            <label class="lab-right">Confirm Password  <span style="color: red;">*</span></label>
                            <input type="password" name="cpassword" class="form-control login-input" placeholder="Enter Your New Password" >
                          </div>


             
          <div class="m-t30">
              <button type="submit" class="btn btn-primary btn-lg">SUBMIT</button>
  
          </div>  
        </form>
      </div>
        <div claass="text-center">
          
        </div>
      </div>
     
  </div>
</div>
</div>
</div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{url('/')}}/public/js/jquery.validation.js"></script>
<script type="text/javascript">
  $("#reset").validate({
      rules: {
        password: {
          required: true,
          minlength: 5
        },
        cpassword: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        }
      },
      messages: {
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        cpassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        }
      }
    });
</script>
@endpush('scripts')