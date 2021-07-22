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
                            
                         <form method="post" id="category_form" action="{{ route('ads.index') }}/{{$result->id}}" enctype="multipart/form-data" >
                            @csrf  
                            @method('PUT')
                        <input type="hidden" name="id" value="{{ $result->id }}">
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">

                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Category
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="category_id" class="form-control" required="" onchange="get_subcat(this)">
                                                <option value="">Select Category</option>
                                                @if($category)
                                                    @foreach($category as $row)
                                                 <option value="{{$row->id}}" {{ $row->id == $result->category_id ? "selected" : "" }} >{{$row->category_name}}</option>
                                                    @endforeach
                                                @endif
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Sub Category
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="sub_category_id" id="subcategory_id" class="form-control" >
                                                @if($subcategory)
                                                @foreach($subcategory as $row)
                                                <option value="{{ @$row->id }}"> {{ $row->id == $result->subcategory_id ? "selected" : "" }} {{ @$subcategory->sub_category_name }}</option>
                                                @endforeach
                                                @endif
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Service Type
                                        </label>
                                        <div class="col-lg-6">
                                             <select name="service_type" class="form-control" required="">
                                                <option value="">Select service type</option>
                                                 <option value="2" {{  $result->service_type == "2" ? "selected" : ""  }}> Sell</option>
                                                 <option value="1" {{ $result->service_type== '1' ? 'selected': ' ' }}>Service</option>
                                                
                                             </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Ads Name
                                        </label>
                                        <div class="col-lg-6">
                                             <input Type="text" name="ads_name" class="form-control" required="" value="{{ old('ads_name',$result->ads_name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Ads Image
                                        </label>
                                        <div class="col-lg-6">
                                              <input type="file" class="form-control" name="ads_image" placeholder=""  }} >
                                              <img src="{{URL::to('/')}}/public/images/listing/{{ $result->ads_image}}" width="50">
                                        
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Descriptiom
                                        </label>
                                        <div class="col-lg-6">
                                              <textarea  class="form-control" name="ads_description" placeholder="">{{ $result->ads_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                           Door Step
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="radio" name="door_step" value="1" {{ $result->door_step=="1" ? "checked":"" }} require>Yes
                                            <input type="radio" name="door_step" value="0"  {{ $result->door_step=="0" ? "checked":"" }}>No
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
                                                 <option value="{{$row->id}}"  {{ $result->city_id==$row->id ? "selected":"" }}>{{$row->city_name}}</option>
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
                                             <textarea  name="type_of_service" class="form-control" >{{ $result->type_of_service }}</textarea>
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
                $("#subcategory_id").html(e)
            }
        });
    }
</script>
@endpush