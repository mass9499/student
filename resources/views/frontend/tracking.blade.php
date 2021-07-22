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

      <form class="form-signin" method="POST" action="{{url('track')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="track_id" class="form-control" placeholder="Tracking ID" autocomplete="off" required autofocus>
          <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Track</button>
      </form>
     
  </div>
</div>

@endsection