@extends('layouts.app')

@php

  $setting = \App\Models\Setting::find(1);

@endphp

@section('content')



<div class="container">

      <div class="col-md-4 offset-md-4 s-12"> 

    

          <img id="profile-img" class="profile-img-card" src="{{ url('/') }}/public/images/{{$setting->image_name}}" class="header-logo" />

          <p id="profile-name" class="profile-name-card"></p>

          @if(Session::has('error'))

            <p class="alert alert-danger">{{ Session::get('error') }}</p>

            @endif



             @if(Session::has('message'))

            <p class="alert alert-success">{{ Session::get('message') }}</p>

            @endif



          <form class="form-signin" method="POST" action="">

            

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <span id="reauth-email" class="reauth-email"></span>

              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

              <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required>

    

              <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">LOGIN</button>

              

          </form><!-- /form -->

          <p class="text-center"><a href="{{url('forget_password')}}" class="forgot-password">

              Forgot the password?

          </a></p>

      </div><!-- /card-container -->

    </div>

    </div><!-- /container -->





@endsection