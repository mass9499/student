@extends('layouts.app')

@section('content')

<div class="dashboard">

    <div class="container">

      <div class="row side-menu m-t30">

        @include('frontend.side_menu')

        <div class="col-md-9"> 

          <div class="dashboard-detail"> 

            <div class="my-details"> 
             
                  <div class="row">
                      <div class="col-md-6">
                        <h3>Documents</h3>
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning" id="add_more" onclick="add_row();">Add More
                            </button>&nbsp;

                           <!--  <button type="button" class="btn btn-danger remove" id="remove_one" onclick="remove_clone();">Remove</button>     -->                                  
                        </div>
                      </div>
                  </div>

              
              <hr>

     <form method="post" action="{{URL('/')}}/documents_update" enctype="multipart/form-data" id="validate_id"> 
            @csrf


                <div class="cloned_row">
                      
                </div>

                <input type="submit"  class="btn btn-primary cloned_submit" style="display: none;">

    </form>
             <style type="text/css">
               .document_data{
                border:1px solid #CCC;
                width: 100%;
                padding:20px 10px;
                border-radius: 5px;
                margin-top: 20px;
               }
               .document_data_url{
                  background: #edf1f2;
                  padding: 5px;
                   border-radius: 5px;
               }
               .document_data  h5{
                color: #2332CF;
               }
                .document_data  p{
                 margin:8px 0;
               }
               select option[disabled] { color: #CCC; }
             </style>
            
               @if($documents)
            @foreach($documents as  $key => $row) 
            @php  $key2 = $key+1; @endphp
            @if($key2 % 2 == 0)   @else <div class="row"> @endif
              <div class="col-md-6">
                <div class="document_data">
                  <h5>{{$row->document_type_name}}</h5>
                  <div class="document_data_url">
                     <a target="new" href="{{URL('/')}}/public/documents/{{$row->document}}">{{$row->document_name}}</a>

                     <select name="document_type" class="form-control document_type" style="display: none" required>
                          <option value=""> Select Document Type</option>
                          @foreach($document_types as $document_type)
                          <option value="{{$document_type->id}}" {{ $document_type->id  == $row->document_type ?  "selected" :"" }} > {{$document_type->document_name}}</option>
                           @endforeach
                        </select>

                  </div>
                    <p>Status </p>
                    <p>@if($row->document_status  == 1) APPROVED @elseif($row->document_status  == 2) REJECT @else Pending @endif </p>
                </div>
              </div> 
               @if($key % 2 == 0)   @else  </div> @endif
               @endforeach
             @endif


          

           </div> 

         </div> 

       </div>

      </div>

  </div>

</div>

<div style="display: none;">
    <div class="org_container">
        <div class="org_container_rows" id="org_container_rows">

              <div class="form-group m-form__group row" id="org_row">

                  <div  class="col-lg-6">
                    <div class="row">
                  <label class="col-lg-12 col-form-label"> Document  Type</label>
                    <div class="col-lg-12">

                        <select name="document_type[]" class="form-control document_type" required>
                          <option value=""> Select Document Type</option>
                          @foreach($document_types as $document_type)
                          <option value="{{$document_type->id}}"> {{$document_type->document_name}}</option>
                           @endforeach
                        </select>

                    </div>
                  </div>
                </div>
                  <div  class="col-lg-6">
                     <div class="row">
                  <label class="col-lg-12 col-form-label"> Choose the Document</label>
                    <div class="col-lg-12">
                      
                      <input type="hidden" class="form-control" required="" name="doc_id[]" value="" >

                      <input type="file" class="form-control"  name="document[]"  value="" >

                    </div>
                  </div>
              </div>  
        </div>
    </div>
</div>



@endsection


@push('scripts')
<script type="text/javascript">

  $(function() {
    my_doc();
     $("body").on("change",".document_type",function(){
        my_doc();
      });

  function my_doc(){
    $('.document_type option').attr("disabled", false);
      
     $(".document_type").each(function(index) {
       var doc_val = $(this).val();
       var document_type_id = $(this).attr("data-id");
       var document_type_id_two  = $(this).attr("data-id");
      if(doc_val){
        console.log(document_type_id +"--"+ document_type_id_two);

       // if(document_type_id != document_type_id_two){
          $('.document_type option[value="'+doc_val+'"]').attr("disabled", true);
           $(this).find(':selected').attr("disabled", false);
        //}
      }
     });
  }
  });
    function add_row()
    {
     var document_type_count = $(".document_type").length;

     var document_form =  $('.org_container .org_container_rows').clone();
      document_form.find(".document_type").attr("data-id",document_type_count);
      document_form.appendTo('.cloned_row');
      $(".cloned_submit").show();
    }

    function remove_clone()
    { 

       $('.cloned_row .org_container_rows').last().remove();
    }


     @if(empty(count($documents)))
        add_row();
     @endif
</script>
@endpush