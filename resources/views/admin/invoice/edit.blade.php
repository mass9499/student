@extends('layouts.admin') @section('content')
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
                    <div class="kt-portlet__head-actions"> </div>
                </div>
            </div>
        </div>
        
        <div class="kt-portlet__body"> 
            @if(Session::has('message'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> 
                            <strong> {{ Session::get('message') }} </strong> 
                    </div>
                </div>
            </div> 
            @endif

    <form method="post" action="{{url('admin/invoice')}}/{{$invoice->id}}/update/{{$student->id}}" enctype="multipart/form-data"> 
        @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label"> <b>INVOICE #</b></label>
                        <div class="col-lg-6">
                            <input type="text" required="" class="form-control" name="invoice_number" placeholder="INV0001" value="{{ old('invoice', $invoice->invoice_number) }}">
                        </div>   
                    </div>

                    <p><b>ASEC ID : {{$student->student_code}}</b></p>  

                </div>

                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label"> <b>Date :</b> </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control date_picker" name="billing_date" id="date" value="{{ old('billing_date', $invoice->billing_date) }}"  >
                        </div>   
                    </div>
                </div>
            </div>
            <br>
            <br>

            <div class="row">
                <div class="col-md-6">
                <h4>Bill From</h4> <hr>
                    <p><b>Name    :</b> {{$setting->company_name}}</p>  
                    <p><b>Email   :</b> {{$setting->company_email}}</p> 
                    <p><b>Address :</b> {{ $setting->company_address}}</p>
                    <p><b>Phone   :</b> {{$setting->company_mobile}} </p>  
                </div>

                <div class="col-md-6">
                <h4>Bill To</h4><hr>
                    <p><b>Name    :</b> {{$student->first_name}} {{$student->last_name}}</p>  
                    <p><b>Email   :</b> {{$student->email}}</p> 
                    <p><b>Phone   :</b> {{$student->phone_number}} </p>    
                </div>
            </div>
            
            <hr><hr>
            <div class="row">
                <table class="table table-bordered table-striped" style="background-color:#fff;" id="mytable">
                    <thead>
                        <tr style="background-color:#e2e2e2;">
                            <th scope="col"></th> 
                            <th scope="col">Applications</th> 
                            <th scope="col">Application fee </th>
                            <th scope="col">Service Fee</th>
                            <th class="text-center" scope="col">Total Amount</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice_extras as $key => $row)
                        <tr class="tr_clone all_app">
                            <td>
                                
                                <input type="hidden" name="invoice_id[]" value="{{$row->id}}">
                                
                                <button type="button" class="btn btn-warning" id="add_more" onclick="add_row();" style="margin-top:20px;height:35px;">
                                    <i class="fa fa-plus"></i>
                                </button>

                                <button type="button" class="btn btn-danger" id="add_more" onclick="remove_row();" style="margin-top:20px;height:35px;">
                                    <i class="fa fa-minus"></i>
                                </button>

                            </td>
                             <td>
                                <input type="text" class="form-control application_name" id="application_name" name="application_name[]" style="margin-top:20px;height:35px;" value="{{ old('application_name', $row->application_name) }}" required>
                            </td>
                           
                            <td>
                                <input type="text" class="form-control application_fees" id="application_fees" name="application_fees[]" style="margin-top:20px;height:35px;" value="{{ old('application_fees', $row->application_fees) }}" required>
                            </td>
                         
                            <td>
                               <input type="text" class="form-control service_fees" id="service_fees" name="service_fees[]" style="margin-top:20px;height:35px;" value="{{ old('service_fees', $row->service_fees) }}" required>
                            </td>

                            <td>
                                <input type="text" class="form-control amount" id="amount" name="amount[]" autocomplete="off" value="{{ old('amount', $row->amount) }}" style="width:250px;margin-top:20px;height:35px;">
                            </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label"> <b>Total</b></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control sub_total" name="sub_total" id="sub_total" value="{{ old('sub_total', $invoice->sub_total) }}">
                        </div>   
                    </div>

                      <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label"> <b>Discount</b></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control discount" name="discount" id="discount" value="{{ old('discount', $invoice->discount) }}">
                        </div>   
                    </div>
                  
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label"><b>Net Total</b></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control total_amount" name="total_amount" id="total_amount" value="{{ old('total_amount', $invoice->total_amount) }}">
                        </div>   
                    </div>
                  
                    <hr>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Save</button>
                            
                        </div>
                    </div>

                </div>
            </div>

        </form>
            
        </div>
    </div>
</div>

@endsection @push('scripts')

<script type="text/javascript">
    function add_row() {
        var $tableBody = $('#mytable').find("tbody");
                $trLast = $tableBody.find("tr:last");
                $trNew = $trLast.clone().find('input').val('').end();
                $trLast.after($trNew);
    }

    function remove_row() {

         var $tableBody = $('#mytable').find("tbody");
                $trLast = $tableBody.find("tr:last").remove();

    }
</script> 

<script>


 $("body").on("keyup",".application_fees, .service_fees",function(){

        

          var application_fees = $(this).parents('.all_app').find(".application_fees").val();
          application_fees = application_fees ? parseFloat(application_fees) : 0 ;

         var service_fees = $(this).parents('.all_app').find(".service_fees").val();

         service_fees = service_fees ? parseFloat(service_fees) : 0 ;

          var  total = (application_fees + service_fees) ;
          total = Number(total).toFixed(3);
          $(this).parents('.all_app').find(".amount").val(total);

        //  $(".application_fees").each(function(index) {
        //         val = index + 2;
                
               
        // });

        total_amount_calc();

     });

     $("body").on("keyup",".discount",function(){
         total_amount_calc();
     });

       function total_amount_calc(){
            var sub_total = 0;
            $(".application_fees").each(function(index) {
                var amount = $(this).parents('.all_app').find(".amount").val();
                // var application_fees = $('.all_app').find(".amount").val();
                // var service_fees = $('.all_app').find(".service_fees").val();
                // //console.log(application_fees + "--" +service_fees);
                // application_fees = application_fees ? parseFloat(application_fees) : 0 ;
                // service_fees = service_fees ? parseFloat(service_fees) :  0 ;
                sub_total += parseFloat(amount);

            });
            var sub_total_fix = Number(sub_total).toFixed(3);
            $(".sub_total").val(sub_total_fix);
            var discount = $(".discount").val();
             discount = discount ?  parseFloat(discount) : 0;
             var  total_amount = (sub_total - discount);
             total_amount = Number(total_amount).toFixed(3);
             console.log(sub_total_fix +"------"+total_amount);
            $(".total_amount").val(total_amount);
         }




    $(document).ready(function(){

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


    $(".date_picker").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });

});
</script>

@endpush
