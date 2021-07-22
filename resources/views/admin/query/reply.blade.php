@extends('layouts.admin')



@section('content')

<style type="text/css">
    .msgactive{
        padding: 10px;
    background: #e0ffe0;
    border-radius: 10px;
    }
    .messages{
        height: 280px;
        overflow-y: auto;
      
    }
</style>

 <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">


            <div class="kt-portlet__head-toolbar">

                <div class="kt-portlet__head-wrapper">

                    <div class="kt-portlet__head-actions">

                         

                    </div>

                </div>

            </div>

        </div>

        <div class="kt-portlet__body">



           

                @if(count($errors) > 0)

                    <div class="alert alert-danger">

                        <ul>



                            @foreach($errors->all() as $error)

                                <li>{{ $error}}</li>

                            @endforeach 



                        </ul>

                    </div>

                @endif

     

                    <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">

                        <!--begin::Card-->

                        <div class="card card-custom">

                            <!--begin::Header-->

                            <div class="card-header align-items-center px-4 py-3">

                               

                            

                                <div class="text-center flex-grow-1">

                                    <h4 class="text-dark-75 font-weight-bold font-size-h5 mt-3">Chat to {{$student->first_name}} {{$student->last_name}} ({{$student->student_code}})
                                        <a href="{{url('admin/students/'.$student->id.'/edit')}}" class=" btn btn-warning pull-right" target="_blank">GO TO STUDENT</a>
                                    </h4>

                                   

                                </div>

                              

                            </div>

                            <!--end::Header-->

                            <!--begin::Body-->

                            <div class="card-body">

                                <!--begin::Scroll-->

                                <div class="scroll scroll-pull" data-mobile-height="350">

                                    <!--begin::Messages-->

                                    <div class="messages" id="mydiv">

                                        @if(count($querys))

                                        @foreach($querys  as $row)



                                        @if($row->type == 1)

                                        <!--begin::Message In-->

                                        <div class="d-flex flex-column mb-5 align-items-start @if($row->admin_read_status ==0) msgactive @endif "   >

                                            <div class="d-flex align-items-center">

                                                <div class="symbol symbol-circle symbol-40 mr-3">

                                                <img alt="Pic" src="{{url('/')}}/public/images/user.png" width="32" />

                                                </div>

                                                <div>

                                                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$row->created_at}}</a><br>

                                                    <span class="text-muted font-size-sm">{{$row->first_name}} ({{$row->student_code}})  {{$row->admin_read_status == 0  ? " - Unread" : ""}}</span>

                                                     <div class=" rounded  bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{!! $row->message !!}</div>

                                                </div>

                                            </div>

                                           

                                        </div>

                                        @endif



                                         @if($row->type == 2)

                                        <!--end::Message In-->

                                        <!--begin::Message Out-->

                                        <div class="d-flex flex-column mb-5 align-items-end">

                                            <div class="d-flex align-items-center" >

                                                <div class="text-right">

                                                    <span class="text-muted font-size-sm">{{$row->created_at}}</span><br>

                                                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$row->admin_name}}</a>



                                                     <div class="mt-2 rounded  bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">{!! $row->message !!}</div>

                                                </div>

                                                <div class="symbol symbol-circle symbol-40 ml-3">

                                                    <img alt="Pic" src="{{url('/')}}/public/images/user.png" width="32" />

                                                </div>

                                            </div>

                                           

                                        </div>

                                        @endif

                                        <!--end::Message Out-->

                                        @endforeach

                                        @else
                                        <h5 class="text-center mt-5 mb-5">No Message</h5>
                                        @endif  

                                       

                                    <!--end::Messages-->

                                </div>

                                <!--end::Scroll-->

                            </div>

                            <!--end::Body-->

                            <!--begin::Footer-->

                    <div class="card-footer align-items-center">

                        <form method="post" action="">

                             @csrf

                            <input type="hidden" value="{{$student->id}}" name="user_id">

                             <input type="hidden" value="{{Auth::user()->id}}" name="admin_id">

                             <input type="hidden" value="2" name="type">

                            <textarea class="form-control" name="message" rows="3" placeholder="Type a message" ></textarea>

                            <div class="d-flex align-items-center justify-content-between">

                                

                               <!--  <div class="mr-3">

                                    <label><b>Mark as Read</b></label>&nbsp;&nbsp;&nbsp;&nbsp;

                                   <input type="checkbox" name="admin_read_status" value="1" checked>

                                </div>
 -->


                                <div>

                                    <button type="submit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>

                                </div>

                            </div>

                        </form>

                              

                    </div>

                </div>

            </div>

            

        </div>

    </div>

    </div>

@endsection



@push('scripts')

<script type="text/javascript">

$("#mydiv").scrollTop($("#mydiv")[0].scrollHeight);



  $("#validate_id").validate({

    focusInvalid: false,

    invalidHandler: function(form, validator) {



        if (!validator.numberOfInvalids())

            return;



        $('html, body').animate({

            scrollTop: $(validator.errorList[0].element).offset().top

        }, 2000);



    }

});



          var arrows;

    if (KTUtil.isRTL()) {

        arrows = {

            leftArrow: '<i class="la la-angle-right"></i>',

            rightArrow: '<i class="la la-angle-left"></i>'

        }

    } else {

        arrows = {

            leftArrow: '<i class="la la-angle-left"></i>',

            rightArrow: '<i class="la la-angle-right"></i>'

        }

    }

    $("#dob").datepicker({

        format: 'yyyy-mm-dd',

                orientation: "bottom left",

                        templates: arrows,

                        autoclose: true

    });



    $("#application_date").datepicker({

        format: 'yyyy-mm-dd',

        orientation: 'bottom left',

        templates: arrows,

        autoclose: true

    });



    $(".status").summernote({height: 300});

</script>

@endpush