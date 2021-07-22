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
                            
                        <form method="post" id="ads_form" action="{{ route('ads.index') }}" enctype="multipart/form-data" > 
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Service Type
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="service_type" class="form-control" required="" onchange="get_category(this)">
                                                <option value="">Select service type</option>
                                                
                                                 <option value="1" {{ old('service_type') == '1' ?  'selected'  : '' }}>Service</option>
                                                  <option value="2" {{ old('service_type') == '2' ?  'selected'  : '' }}>Business</option>
                                                   <option value="3" {{ old('service_type') == '3' ?  'selected'  : '' }}>Sell</option>
                                                
                                             </select>
                                        </div>
                                        
                                    </div>


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
                                    <div class="form-group m-form__group row sub_category" style="display: none;">
                                        <label class="col-lg-2 col-form-label">
                                           Sub Category
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="sub_category_id" id="subcategory_id" class="form-control" >
                                                <option value="">Select SubCategory</option>

                                             </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Ads Name
                                        </label>
                                        <div class="col-lg-6">
                                             <input Type="text" name="ads_name" class="form-control" value="{{ old('ads_name') }}"  required="">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Ads Image
                                        </label>
                                        <div class="col-lg-6">
                                              <input type="file" class="form-control" name="ads_image[]" placeholder="" required multiple="">
                                        </div>
                                    </div>

                                     <div class="form-group m-form__group row ads_price" style="display: none">
                                        <label class="col-lg-2 col-form-label">
                                           Ads Price
                                        </label>
                                        <div class="col-lg-6">
                                             <input Type="text" name="ads_price" class="form-control" value="{{ old('ads_price') }}"  required="">
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
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Door Step
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="radio" name="door_step" value="1" {{ old('door_step') == 1 ?  'checked'  : '' }} require>Yes
                                            <input type="radio" name="door_step" value="0" {{ old('door_step') == 1 ?  'checked'  : '' }}>No
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Location
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="city_id" class="form-control" required="">
                                                <option value="">Select Location</option>
                                                @if($city)
                                                    @foreach($city as $row)
                                                 <option value="{{$row->id}}">{{$row->city_name}}</option>
                                                    @endforeach
                                                @endif
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Type Of Service
                                        </label>
                                        <div class="col-lg-6">
                                             <textarea  name="type_of_service" class="form-control" >{{old('type_of_service')}}</textarea>
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