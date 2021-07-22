<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Invoice - {{$invoice->invoice_number}} </title>
<style type="text/css">
    body{
        font-family: Arial;
    }
</style>
</head>
<body>



                <table  width="100%" style="font-family: Arial">
                    <tr>
                        <td style="border-bottom: 1px solid #000;"><h2 style="color: #e74b0f;font-weight: 100;">{{$setting->company_name}}</h2></td>
                        <td style="color: #e74b0f;border-bottom: 1px solid #000;" align="right"  >INVOICE</td>
                    </tr>
                </table>
                <table><tr><td style=""><p>&nbsp;</p></td></tr></table>
                
                <table  width="100%" style="font-size: 14px;font-family: Arial;">
                    <tr>
                        <td>
                            <p><b>INVOICE # : {{$invoice->invoice_number}}</b></p>  
                            <p><b>ASEC ID : {{$student->student_code}}</b></p>  
                        </td>
                        <td align="right"   >
                            <p><b>DATE : {{$invoice->billing_date}}</b></p>
                        </td>
                    </tr>
                </table>
                <table><tr><td style=""><p>&nbsp;</p></td></tr></table>
            
                <table width="100%" style="font-size: 12px;font-family: Arial;">
                    <tr>
                        <td width="50%">
                           <h4>Bill From</h4>
                            <p><b>Name    :</b> {{$setting->company_name}}</p>  
                            <p><b>Address :</b> {{ $setting->company_address}}</p>
                            <p><b>Phone   :</b> {{$setting->company_mobile}} </p>  
                        </td><td width="50%">
                            <h4>Bill To</h4>
                            <p><b>Name    :</b> {{$student->first_name." ".$student->last_name}}</p>  
                            <p><b>Email   :</b> {{$student->email}}</p> 
                            <p><b>Phone   :</b> {{$student->phone_number}} </p>  
                        </td>
                    </tr>
                </table>
              
              <table><tr><td style=""><p>&nbsp;</p></td></tr></table>
                 <table class="table table-bordered table-striped" style="width: 100%;font-size: 13px;font-family: Arial;" cellpadding="5" cellspacing="0"  border="0">
                    <thead>
                        <tr style="color: #e74b0f;">
                            
                            <th class="text-center" style="border-bottom: 1px solid #000;width: 50%;">Applications</th> 
                            <th class="text-center" style="border-bottom: 1px solid #000;" >Application Fee </th>
                            <th class="text-center" style="border-bottom: 1px solid #000;" >Service Fee</th>
                            <th class="text-center" style="border-bottom: 1px solid #000;" >Total Amount</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice_extras as $row)
                        <tr class="tr_clone" style="border: 1px solid #000;">
                           
                            <td style="text-align: left;border-bottom: 1px solid #000;">{{$row->application_name}}</td>
                           
                            <td style="text-align: center;border-bottom: 1px solid #000;">{{$row->application_fees}}</td>
                            
                            <td style="text-align: center;border-bottom: 1px solid #000;">{{$row->service_fees}}</td>
                            
                            <td style="text-align: center;border-bottom: 1px solid #000;">{{$row->amount}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            <td ><b>Total</b></td>
                            <td align="right">{{get_price($invoice->sub_total)}}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000;" colspan="2"></td>
                            <td style="border-bottom: 1px solid #000;"><b>Discount</b></td>
                            <td style="border-bottom: 1px solid #000;" align="right">{{get_price($invoice->discount)}}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000;" colspan="2"></td>
                            <td style="border-bottom: 1px solid #000;"><b>Net Total</b></td>
                            <td style="border-bottom: 1px solid #000;" align="right">{{get_price($invoice->total_amount)}}</td>
                        </tr>
                          
                    </tbody>
                </table>
                <table><tr><td style=""><p>&nbsp;</p></td></tr></table>
                <table width="100%" style="font-family: Arial;font-size: 12px;">
                    <tr>
            <td>
                <h4 style="color: #e74b0f;" ><b>OTHER COMMENTS</b></h4> 
                    <p> 1. Fees paid are for submiting the application and following up until we get the final decsion.</p>
                    <p>2. ALSHAMLAN EDU do not guarantee the outcomes or the time of the University's decision. </p>
                    <p>3. Application fee is always non-refundable. </p>
                    <p>4. Service fee is refundable in case we are not unable to proccess the application, unless the student didn't provide all required documents.</p>
                    <p>5. Student is responsible to submit all requirements and we are not responsible, if the student didn't meet the admission requirements.</p>

                    <h4><b>Thank You For Your Business!</b></h4>
            </td>
        </tr>
                </table>
    
</body>

</html>