@extends('layouts.admin')

@section('content')
<style type="text/css">
  .sub_category_order { width: 100px; }
  .ml-25{ margin:20px !important; }
</style>
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
                                                     
                                            <a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ URL ('admin/ads/create')}}">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

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
                        
                                <p>
                                <a class="btn btn-primary" href="{{ URL::to('/')}}/admin/ads/lists/all" >All List</a>
                                <a class="btn btn-warning" href="{{ URL::to('/')}}/admin/ads/lists/pending" >Pending List</a>
                                <a class="btn btn-success" href="{{ URL::to('/')}}/admin/ads/lists/active" >Active List</a>
                             
                                </p>
                            <table class="table table-bordered m-table m-table--border-primary" id="ads_table">
                            
                                <thead>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Ads Image</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Service Type</th>
                                        <th>Ads Name</th>
                                        <th>Door Step</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                     @foreach($results as $key => $result)
                                     <tr>
                                         <td>{{$key + 1}}</td>
                                         <td><img src="{{URL::to('/')}}/public/images/listing/{{ $result->image_name}}" width="50" alt=""></td>
                                         <td>{{ $result->category_name }}</td>
                                         <td>{{ $result->sub_category_name }}</td>
                                         <td>@if($result->service_type  ==1) {{"Service"}} @elseif($result->service_type  ==2) {{"Business"}} @else {{"Sale"}} @endif</td>
                                         <td>{{ $result->ads_name }}</td>
                                       
                                         @if($result->door_step == 1) 
                                            <td>Yes</td>
                                            @else 
                                            <td>No </td>
                                         @endif
                                        
                                         <td>{{ $result->city_name }}</td>
                                        
                                         <td><label class="switch">
                                              <input type="checkbox"  data-status="{{$result->ads_status}}" data-id="{{$result->id}}"  class="switch-input update_status" {{$result->ads_status== 1 ? 'checked' : "" }} >
                                              <span class="slider-switch round"></span>
                                            </label>
                                        </td>
                                        <td> 
                                             <form method="post" action="{{ route('ads.index') }}/{{$result->id}}" enctype="multipart/form-data" stype="width:100%" >

                                                <a href="{{ URL::to('/')}}/admin/ads/{{$result->id}}/edit" class="btn btn-success btn-sm"  style="padding:4px"title="Edit"><i class="fa fa-edit"></i></a>

                                                  <button type="submit" class="btn btn-danger btn-sm " style="padding:4px"  onclick="return confirm('Are Sure to Delete')"><i class="fa fa-trash"></i></button>
                                                  <input type="hidden" name="id" value="{{$result->id}}">
                                                  {{ method_field('DELETE') }}
                                                  {!! csrf_field() !!}
                                            </form>
                                     </tr>
                                     @endforeach
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
@endsection



@push('scripts')
   
<script type="text/javascript">
  $("#ads_table").dataTable();
  $(document).on("change",".update_status",function() {
      if($(this).is(":checked")) { var status = 1;}
      else{   var status = 0;  }  
      var id= $(this).attr("data-id")
      //alert(id);
      $.ajax({
          url: "{{URL('/')}}/admin/ads/status/" + id + "/" +status ,
              success: function(e) {
          }
      });
  });

</script>
 @endpush
