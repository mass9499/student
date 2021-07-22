@extends('layouts.admin') @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> 
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title"> {{ $title }} </h3>
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
       
            <div class="row">
                <div class="col-md-6">
                    <p><b>INVOICE # : {{$invoice->invoice_number}}</b></p>  
                    <p><b>ASEC ID   : {{$student->student_code}}</b></p>  
                </div>

                <div class="col-md-6">
                    <p><b>DATE : {{$invoice->billing_date}}</b></p>  
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
            <hr>
            
        <hr>
            <div class="row">
                <table class="table table-bordered table-striped" style="background-color:#fff;" id="mytable">
                    <thead>
                        <tr style="background-color:#e2e2e2;">
                            
                            <th class="text-center">Applications</th> 
                            <th class="text-center">Application Fee </th>
                            <th class="text-center">Service Fee</th>
                            <th class="text-center">Total Amount</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice_extras as $row)
                        <tr class="tr_clone">
                           
                            <td style="margin-top:20px;height:35px;text-align: center;">{{$row->application_name}}</td>
                           
                            <td style="margin-top:20px;height:35px;text-align: center;">{{$row->application_fees}}</td>
                            
                            <td style="margin-top:20px;height:35px;text-align: center;">{{$row->service_fees}}</td>
                            
                            <td style="margin-top:20px;height:35px;text-align: center;">{{$row->amount}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p><b>Total     : <span class="pull-right">{{get_price($invoice->sub_total)}}</span></b>     </p>
                    <p><b>Discount  : <span class="pull-right">{{get_price($invoice->discount)}}</span></b>      </p>
                    <p><b>Net Total : <span class="pull-right">{{get_price($invoice->total_amount)}}</span></b>  </p>
                   
                </div>
            </div>

                <h4><b>OTHER COMMENTS</b></h4> <br>
                <p> 1. Fees paid are for submiting the application and following up until we get the final decsion.</p>
                <p>2. ALSHAMLAN EDU do not guarantee the outcomes or the time of the University's decision. </p>
                <p>3. Application fee is always non-refundable. </p>
                <p>4. Service fee is refundable in case we are not unable to proccess the application, unless the student didn't provide all required documents.</p>
                <p>5. Student is responsible to submit all requirements and we are not responsible, if the student didn't meet the admission requirements.</p>
  
                <h5><b>Thank You For Your Business!</b></h5>          
            
        </div>
    </div>
</div>

@endsection 
