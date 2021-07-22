@extends('layouts.app')

@section('content')

<style type="text/css">

  .chat .chat-history {

  padding: 10px;

  border-bottom: 2px solid #CCC;
  margin-bottom: 10px;
  height: 400px;
 overflow-y: auto; 

}

.chat .chat-history .message-data {

  margin-bottom: 15px;

}

.chat .chat-history .message-data-time {

  color: #a8aab1;

  padding-left: 6px;

}

.chat .chat-history .message {

  color: white;

  padding: 10px;

  line-height: 26px;

  font-size: 16px;

  border-radius: 5px;

  margin-bottom: 20px;

  min-width: 50%;
   max-width: 100%;

  position: relative;

}

.chat .chat-history .message:after {

content: "";

    position: absolute;

    top: -15px;

    left: 20px;

    border-width: 0 15px 15px;

    border-style: solid;

    border-color: #CCDBDC transparent;

    display: block;

    width: 0;

}

.chat .message em{
  color: #3f3f3f;
      font-size: 12px;
}
.chat .chat-history .you-message {

  background: #CCDBDC;

  color:#003366;

}

.chat .chat-history .me-message {

  background: #E9724C;

}

.chat .chat-history .me-message:after {

  border-color: #E9724C transparent;

    right: 20px;

    top: -15px;

    left: auto;

    bottom:auto;

}

.chat .chat-message {

  padding: 30px;

}

.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {

  font-size: 16px;

  color: gray;

  cursor: pointer;

}
.chat-ul{
  padding: 0;
  margin: 0;
}


.chat-ul li{

    list-style-type: none;

}



.align-left {

  text-align: left;

}



.align-right {

  text-align: right;

}



.float-right {

  float: right;

}



.clearfix:after {

  visibility: hidden;

  display: block;

  font-size: 0;

  content: " ";

  clear: both;

  height: 0;

}

.you {

  color: #CCDBDC;

}



.me {

  color: #E9724C;

}

</style>

<div class="dashboard">

    <div class="container">

    <div class="row side-menu m-t30">
 


  @include('frontend.side_menu')

    
      <div class="col-md-9 user-img-box "> 


        <h3>Queries </h3>
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
                     @if($querys)
                <div class="chat">   
<div class="chat-history" id="mydiv">
  <ul class="chat-ul">

    

    @foreach($querys  as $row)


  @if($row->type == 1)
    <li>
      <div class="message-data">
        <span class="message-data-name">{{$row->first_name}}</span>
      </div>
      <div class="message you-message">
      {!!$row->message!!}
        <br>       <em>{{$row->created_at}}</em></span>       </div>

    </li>
     @endif


  @if($row->type == 2)
    <li class="clearfix">
      <div class="message-data align-right">
        <span class="message-data-name">Admin</span> @if($row->student_read_status ==0) <i class="fa fa-circle me"></i> @endif
      </div>
      <div class="message me-message float-right" @if($row->student_read_status ==0) style="background : GREEN" @endif>{!!$row->message!!}<br>       <span> <em>{{$row->created_at}}</em></span>  </div>
    </li>
     @endif
      @endforeach
                                                  
  </ul>
    
</div> <!-- end chat-history -->
@endif
                      
            <form method="POST" action="{{ url('queries_store') }}" enctype="multipart/form-data"  id="message_form"> 
                
                @csrf


            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                                               <div class="col-lg-12">
                          <textarea  name="message" class="form-control" rows="3" placeholder="Type Your Message" ></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <button class="btn btn-success once-only"><span>Send Message</span></button>

                        
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







@endsection

@push('scripts')

<script type="text/javascript">
  $("#mydiv").scrollTop($("#mydiv")[0].scrollHeight);


   $("#dob").datepicker({
  format: 'yyyy-mm-dd',
  orientation: "bottom left",
  autoclose: true

    });

$(".once-only").click(function(){  this.disabled = true;  $("#message_form").submit();
    });

</script>
@endpush

   