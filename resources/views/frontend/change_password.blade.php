@extends('layouts.app')
@section('content')

<div class="dashboard">
    <div class="container">
      <h2 class="m-b10"><span class="br-btm"></span></h2><br>
        
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

    
        
    <div class="row side-menu m-t30">
        
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
       

        @include('frontend.side_menu')
    
            <div class="col-md-9 user-img-box "> 
                  <h3>Change Password</h3>
                     <hr>
              <div class="row">
                <div class="col-md-6">
          
      <form method="post" action="{{url('/')}}/change_password_post">
                           {{ csrf_field() }}
      
         
          <div class="form-group">
            <label class="lab-right"> Current Password  <span style="color: red;">*</span></label>
            <input type="password" name="old_password" class="form-control login-input" placeholder="Enter Your Old Password" required="" > 
        </div> 
         
          <div class="form-group">
            <label class="lab-right">New Password  <span style="color: red;">*</span></label>
            <input type="password" name="new_password" class="form-control login-input" placeholder="Enter Your New Password" required="" > 
        </div> 
         
          <div class="form-group">
            <label class="lab-right">Confirm New Password  <span style="color: red;">*</span></label>
            <input type="password" name="cnew_password" class="form-control login-input" placeholder="Confirm Your New Password" required=""> 
        </div> 
        <div class="m-t30">
              <button type="submit" class="btn btn-primary btn-lg">Change Password</button>
        </div>  
      </form>
    </div>
  </div>
            </div>
      
       </div>
      </div>
  </div>
</div>

@endsection
