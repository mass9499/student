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

                             @if(Session::has('success'))

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>
                                                {{ Session::get('success') }}
                                            </strong>
                                        
                                        </div>
                                    </div>
                                </div>
                            @endif

                      <form method="post" action="{{url('/')}}/forget_password_post">
                           {{ csrf_field() }}
            
          <div class="form-group"> 
            <label class="lab-right">Email  <span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control login-input" placeholder="Enter Your Email" >
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