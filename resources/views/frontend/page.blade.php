@extends('layouts.app')

@section('content')
  

   <nav aria-label="breadcrumb" class="breadcrumb-bg" >
      <div class="container">
      <ol class="breadcrumb-main">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li>&nbsp;/&nbsp;</li>
        <li class="breadcrumb-item active" aria-current="page">{{$page->page_name}}</li>
      </ol>
    </div>
    </nav>

    <div class="products m-t50 m-b50">
    <div class="container">
      <h3 class="m-b30">{{$page->page_name}}</h3>

      <div class="row">
      
 <div class="col-md-12">

        
          {!!$page->page_description!!}
        
  
    

    </div>


      </div>
    </div>
   </div>
    

@endsection
