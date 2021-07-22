@extends('layouts.admin')

@section('content')

<div class="col-md-12">

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
                            
                        <form method="post" action="{{ url('admin/add_document') }}" enctype="multipart/form-data" > 
                            
                            @csrf

                            <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                <input type="hidden" value="{{$students->id}}" name="id">

                                 <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                       Student Name
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="text" class="form-control" name="login_password" readonly=""  value="{{$students->first_name.' '.$students->last_name}}">
                                    </div>
                                </div>



                                <div class="row_container"> 
                                 <div class="form-group m-form__group row" id="org_row">
                                    <label class="col-lg-2 col-form-label">
                                       Document 
                                    </label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control" name="document"  required>
                                    </div>

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
                                        <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a>
                                    
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>        
                
                           
                        </div>
                    </div>
                </div>
    
</div>

@endsection

@push('scripts')
<script type="text/javascript">

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
</script>

@endpush