@extends('layouts.app')
@section('content')

<div class="dashboard">
    <div class="container">
     <div class="row side-menu m-t30">
       

        @include('frontend.side_menu')
    
            <div class="col-md-9 user-img-box "> 

                 <h3>Profile</h3>
                     <hr>
                     
                   @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>

                            @foreach($errors->all() as $error)
                                <li>{{ $error}}</li>
                            @endforeach 

                        </ul>
                    </div>
                @endif
                
                 @if(Session::has('message'))

                  <div class="row">
                      <div class="col-lg-12">
                          <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                              <strong>
                                  {{ Session::get('message') }}
                              </strong>
                          
                          </div>
                      </div>
                  </div>
                  @endif

                            
                <form method="post" action="{{ url('profile_update') }}" enctype="multipart/form-data" > 
                            
                            @csrf
                           

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
                                          <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$student->last_name}}" required>
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
                                            <input type="date" id="dob" name="dob" class="form-control" value="{{$student->dob}}" required autocomplete="off">
                                    </div>
                                </div>

                                
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Email
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="email" class="form-control" name="email"   readonly value="{{$student->email}}" required>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        
                                        <button class="btn btn-success" type="submit"><span>Submit</span></button>
                                        <a href="{{ url('dashboard') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>        
            </div>
      
       </div>
      </div>
  </div>
</div>

<script type="text/javascript">
   $("#dob").datepicker({
        format: 'yyyy-mm-dd',
                orientation: "bottom left",
                        templates: arrows,
                        autoclose: true
    });
</script>

@endsection
   