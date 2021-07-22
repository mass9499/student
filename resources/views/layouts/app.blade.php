@php

  $setting = \App\Models\Setting::find(1);

@endphp

@php
  $student_id = Session::get('student_id');
  $unread_msg = \App\Models\Query::where('student_read_status', 0)->where('user_id', $student_id)->count();
@endphp

<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{@$title ? $title  : "" }} | {{$setting->company_name}}</title>

    <!-- Bootstrap CSS -->

    <link rel="shortcut icon" href="{{ URL::to('/') }}/public/images/{{$setting->company_fav}}" />

    <link rel="stylesheet" href="{{url('/')}}/public/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{url('/')}}/public/css/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" href="{{url('/')}}/public/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/css/jquery.toast.min.css?v=2.1">
    <link rel="stylesheet" href="{{url('/')}}/public/css/style.css?v=2.2">

 

<style type="text/css">
  
a.fa-bell {
  position: relative;
  font-size: 2em;
  color: grey;
  cursor: pointer;
}

span.fa-comment {
  position: absolute;
  font-size: 0.6em;
  top: -4px;
  color: red;
  right: -4px;
}

span.num {
  position: absolute;
  font-size: 0.3em;
  top: 1px;
  color: #fff;
  right: 2px;
}
</style>


  </head>

  <body>

    <div class="header">

      <div class="container">

        <div class="row">

          <div class="col-md-2 col-sm-4">

             <a href="{{url('/')}}"><img src="{{ url('/') }}/public/images/{{$setting->image_name}}" class="header-logo"> </a>

          </div>

          <div class="col-md-4 col-sm-4">

            <h4 class="site-title">{{$setting->company_name}}</h4>

          </div>

          <div class="col-md-6 col-sm-4">

            <ul class="header-menu">

              @if(!Session::get('student_id'))
              <li><a href="https://api.whatsapp.com/send/?phone=96555544784&text&app_absent=0" class="btn btn-success"><i class="fa fa-whatsapp"></i></a></li>

              <li><a href="https://alshamlanedu.org/" class="btn btn-primary">Back To Home</a></li>

              <li><a href="{{url('track')}}" class="btn btn-warning">Track</a></li>

              <li><a href="{{URL('')}}" class="btn btn-success">Login</a></li>

              <li><a href="{{URL('')}}/registration" class="btn btn-success">Register</a></li>


              @else
              <li><a href="https://api.whatsapp.com/send/?phone=96555544784&text&app_absent=0" class="btn btn-success"><i class="fa fa-whatsapp"></i></a></li>
            
              <li><a href="{{URL('')}}/queries" class="fa fa-bell"><span class="fa fa-comment"></span><span class="num message_count">{{ $unread_msg }}</span></a></li>

             <li><a href="{{URL('')}}/user/logout" class="btn btn-danger">Logout</a></

              @endif

            </ul>

          </div>

      </div>

    </div>

  </div>


     @yield('content')

</body>

<script src="{{url('/')}}/public/js/jquery.min.js"></script>

<script src="{{url('/')}}/public/js/popper.min.js"></script>

<script src="{{url('/')}}/public/js/bootstrap.min.js"></script>

<script src="{{url('/')}}/public/js/jquery-ui.js"></script>
<script src="{{url('/')}}/public/js/jquery.toast.min.js"></script>

<script>

$('body').on("click",".close_notfication",function () {
        //             //alert();
            //toastr.clear();
            var id = $(this).attr("data-id");
            var that = $(this);
            $.ajax({
              url: "{{url('notification_close/')}}/" + id,
              success: function(){
      
                    that.parents(".jq-toast-single").remove();
                }
            });

         });


var count_new = 0;

 function show_popup(){    
        //$("#toast-container").empty();
             $.ajax({
              url: "{{url('notification/')}}",
              dataType: 'json',
              success: function(response){
                var count_t = response.count;
                //if(count_new == 0) count_new = count_t;
                 console.log(count_new +" "+ count_t );
                if(count_t > count_new){
                    count_new = count_t
                    $(".message_count").html(count_t);
                    $(".jq-toast-wrap").empty();
                    //$("#toast-container").empty();
                    // $.each(response.data, function(index, element) {

                    //     toastr.error("Message : " +element.description +"<br /><br /><a href='"+element.url+"' class='btn btn-outline-light btn-sm--air--wide '>Open Queries</a> <a href='javascript:void(0)'  data-id='"+element.id+"' class='btn btn-outline-light btn-sm--air--wide cleartoasts'>Close</a>",  element.title); 
                    //     });
                   $.each(response.data, function(index, element) {
                    console.log(element);
                    $.toast({ 
                      text : "<b>NEW MESSAEG RECEIVED</b><br>" +element.description +"  <br><a class='btn btn-success' href='"+element.url+"' >Open Queries </a> <a href='javascript:void(0)'  data-id='"+element.id+"' class='btn btn-danger close_notfication'>Close </a>", 
                      showHideTransition : 'slide',  // It can be plain, fade or slide
                      bgColor : 'rgb(14 76 77);',              // Background color for toast
                      textColor : '#FFF',            // text color
                      allowToastClose : false,       // Show the close button or not
                      hideAfter :  false,              // `false` to make it sticky or time in miliseconds to hide after
                      stack : 5,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                      textAlign : 'top',            // Alignment of text i.e. left, right, center
                      position : 'top-right' ,
                       icon: 'info'      // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                    });

                  });

                }
                if(count_t < count_new){
                     count_new = count_t
                }
              }
            });
   };

   var intervalId = window.setInterval(function(){
      show_popup();
    }, 5000);
       // window.setTimeout( show_popup, 5000 ); 
    show_popup();

  </script>

 @stack('scripts')

</html>