@extends('layouts.admin')

@section('content')

 <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    {{ $title }}
                                </h3>
                            </div>
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
                            
                        <form method="post" id="ads_form" action="{{ route('documents.store') }}" enctype="multipart/form-data" > 
                           @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Category
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="category_id" id="category_id" class="form-control" required="" onchange="get_subcat(this)">
                                                <option value="">Select Category</option>
                                             </select>
                                        </div>
                                        
                                    </div>
                                   
                                   
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Documents
                                        </label>
                                        <div class="col-lg-6">
                                              <input type="file" class="form-control" name="document[]" placeholder="" required multiple="">
                                        </div>
                                    </div>
                                   
                                     
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Description
                                        </label>
                                        <div class="col-lg-6">
                                              <textarea  class="form-control" name="ads_description" placeholder="">{{ old('ads_description') }}</textarea>
                                        </div>
                                    </div>
                                   
                                </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        
                                        <button class="btn btn-success"><span>Submit</span></button>
                                        <a href="{{ url('admin/ads') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>        
                
                           
                        </div>
                    </div>
                </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $("#sub_category_form").validate();
    function get_subcat(own){
        cat_id = own.value;
        $.ajax({
            url: "{{URL('/')}}/admin/ads/get_subcat/" + cat_id  ,
                  success: function(e) {
                    if(e){
                        $(".sub_category").show();
                        $("#subcategory_id").html(e)
                    }
                    else{
                        $(".sub_category").hide();
                        $("#subcategory_id").val("");
                    }
                
            }
        });
    }

       function get_category(own){
             main_cat = own.value;
             if(main_cat ==3 ){
                $(".ads_price").show();
             }
             else{
                $(".ads_price").hide();
             }
            $.ajax({
                    url: "{{URL('/')}}/admin/ads/get_category/" + main_cat  ,
                          success: function(e) {
                            if(e){
                                $("#category_id").html(e)
                            }
                        
                    }
                });

        }

</script>

<!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
     CKEDITOR.replace( 'ads_description' );
</script>
@endpush -->