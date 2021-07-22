@extends('layouts.app')
@php $customer_id = Session::get('customer_id') ?  Session::get('customer_id')  :"" ; @endphp

@section('content')


<div class="container">
    <div class="row">
           
        
        <div class="col-md-6">
            
             <nav aria-label="breadcrumb" class="breadcrumb-bg" >
                <div class="container">
                    <ol class="breadcrumb-main">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li>&nbsp;/&nbsp;</li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </div>
            </nav>
            
            @if(Session::has('mailsent'))
                <p class="alert alert-info">{{ Session::get('mailsent') }}</p>
            @endif
            
            <form action="{{url('contact-us')}}" method="POST">
              @csrf
              
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" id="fullname" placeholder="Enter FullName" name="fullname" required>
                </div>
                
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                </div>
                
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required>
                </div>
                
                <div class="form-group">
                 <label>Message</label>
                 <textarea class="form-control" rows="5" id="message" name="message" placeholder="Enter Message" required></textarea>
                </div>
                
                <input type="submit" value="Send Message" class="btn btn-primary">
             </form>
        </div>
    </div>
    <br>
</div>



@endsection

