@extends('layouts.admin') @section('content')


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <style type="text/css">
            .stud-main{
                background: #FFF;
                width: 100%;
                float: left;
                border: 1px solid #ebedf2;
                margin-bottom: 20px;
                border-radius: 5px;
            }
            .stud-collpase-head{
                width: 100%;
                float: left;
                cursor: pointer;
                 padding: 10px 20px;
                 background:  #f7f8fa;
                 color: #5d78ff;
                     font-size: 1.1rem;
                     font-weight: 500;
                         padding: 1rem 1rem;
            }
            .stud-collpase-body{
                width: 100%;
                float: left;
                
            }
            .student-content{
                 padding: 20px 20px;

            }
            select option[disabled] { color: #CCC; }
        </style>
        <div class="row">
            <div class="col-md-12">

                @if(Session::has('message'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> <strong>

                                                {{ Session::get('message') }}

                                            </strong> </div>
                </div>
            </div> @endif

          
                <div class="student-content-1 text-right mb-5">
                    <a href="{{url('admin/query/reply/'.$student->id)}}" class="btn btn-success" target="_new"><i class="fa fa-comments"></i> Chat</a>
                    <a href="{{url('admin/invoice/'.$student->id)}}" class="btn btn-warning" target="_new"><i class="fa fa-list"></i> Invoice</a>
                </div>
        
            
                <form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data" id="validate_id" class="student_form"> @csrf @method('PUT')
                    <div class="stud-main">
                        <div class="stud-collpase-head">
                            STUDENT DETAILS
                        </div>
                        <div class="stud-collpase-body" style="display: none">
                            <div class="student-content">
                                 <input type="hidden" name="stud_id" value="{{$student->id}}">

                                <div class="form-group m-form__group row" style="">
                                    <div class="col-lg-4">
                                        <label > ASEC Registration ID </label>
                                        <input type="text" class="form-control" readonly="" disabled value="{{$student->student_code}}" required> 
                                    </div>
                                    <div class="col-lg-4">
                                        <label >  Tracking ID </label>
                                          <input type="text" class="form-control" name="track_id" readonly value="{{$student->track_id}}">  
                                      </div>
                                      <div class="col-lg-4">
                                        <label>Date of Birth</label>
                                        <input type="text" id="dob" name="dob" class="form-control" value="{{$student->dob}}" required="" autocomplete="off">
                                    </div>
                                </div>
                            

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                       
                                        <div class="row">
                                            <div class="col-lg-6">
                                                 <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$student->first_name}}" required> </div>
                                        <div class="col-lg-6">
                                             <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$student->last_name}}" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label> Phone Number </label>
                                        <input type="text" class="form-control" name="phone_number" value="{{$student->phone_number}}" required>
                                    </div>
                                     <div class="col-lg-4">
                                        <label >Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$student->email}}" required> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stud-main">
                        <div class="stud-collpase-head">
                            STUDENT DOCUMENTS

                        </div>
                        <div class="stud-collpase-body" style="display: none">
                             <div class="student-content">
                                    <div class="row" >
                                         @foreach($documents as $key => $row)
                                        <div class="col-lg-3">
                                            <div class="document_type">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label>Document Type</label>
                                                        <select name="document_type[{{ $key}}]" class="form-control main_document_type">
                                                                <option value=""> Select Document Type</option>
                                                                 @foreach($document_types as $document_type)
                                                                <option value="{{$document_type->id}}" {{$document_type->id == $row->document_type ? "selected": ""}}> {{$document_type->document_name}}</option> 
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                     <label>Document</label>
                                                     <input type="hidden" class="form-control" name="doc_id[]" value="{{$row->id}}"> 
                                                    
                                                     <p><a target="new" href="{{URL('/')}}/public/documents/{{$row->document}}">{{$row->document_name}}</a></p>
                                                    <input type="file" class="form-control" name="document[{{ $key}}]" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                     <label>Document Status</label>
                                                     
                                                    
                                                        <select name="document_status[{{ $key}}]" class="form-control">
                                                        <option value=""> Select Document Status</option>
                                                        <option value="1" {{$row->document_status == 1 ? "selected": ""}} >Approved</option> 
                                                        <option value="2" {{$row->document_status == 2 ? "selected": ""}} >Rejected</option> 
                                                    </select>

                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                        @endforeach
                                    </div>
                            </div>


                                          <div class="student-content">
                                <div class="row">
                                    <div class="col-12">
                                            <p class="pull-left">
                                        <button type="button" class="btn btn-warning" id="add_more" onclick="add_doc_row();">Add More Docs
                                        </button>&nbsp;

                                        <button type="button" class="btn btn-danger remove" id="remove_one" onclick="remove_doc_clone();">Remove</button>               </p>                           
                                    </div>
                                </div>

                                    <div class="doc_cloned_row"></div>


                                    </div>

                        </div>
                    </div>


                    @foreach($univdatas as $key => $univdata)

                     <div class="stud-main">
                        <div class="stud-collpase-head">

                            UNIVERSITY DETAILS <span style="color: #000"> ({{$univdata->university_name}})</span>

                        <span class="pull-right"> <button type="button" class="btn btn-danger btn-sm remove_unv_de" id="remove_one"><i class="fa fa-minus"></i> DELETE</button></span>

                        </div>
                        <div class="stud-collpase-body" style="display: none">
                            <div class="student-content">
                                 <div class="org_container">
                            <div class="org_container_rows">
                               

                             <div class="univ_id_class">
                                 <div class="row">
                                    <div class="col-lg-12f">
                                    
                                        <input type="hidden" class="univ_id" name="univ_id[]" value="{{$univdata->id}}">
                                    <h5>UNIVERSITY DATA</h5>
                                    <div class="row mg-20">
                                        <div class="col-lg-6">
                                            <label class="">Application Date</label>
                                            <input type="text" class="form-control application_date application_date{{$key}}" id="application_date" name="application_date[]" value="{{$univdata->application_date}}"> </div>
                                        <div class="col-lg-6">
                                            <label class="">University Name</label>
                                            <input type="text" class="form-control university_name_class" name="university_name[]" value="{{$univdata->university_name}}"> </div>
                                       
                                    </div>
                                    <div class="row mg-20">

                                         <div class="col-lg-4">
                                            <label class="">University Application ID</label>
                                            <input type="text" class="form-control" name="application_id[]" value="{{$univdata->application_id}}"> </div>

                                        <div class="col-lg-4">
                                            <label>Major</label>
                                            <input type="text" class="form-control" name="major[]" value="{{$univdata->major}}"> </div>
                                        <div class="col-lg-4">
                                            <label>Intake</label>
                                            <input type="text" class="form-control" name="intake[]" value="{{$univdata->intake}}"> </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Status</label>
                                        <div class="col-lg-12">
                                            <textarea class="form-control status status{{$key}}" name="status[]">{{$univdata->status}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group m-form__group row">
                                        
                                        <div class="col-lg-12">
                                            <label class="">Comments</label>
                                            <textarea type="text" class="form-control" name="comments[]">{{$univdata->comments}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mg-20">

                                         <div class="col-lg-6">
                                            <label class="">Action Needed</label>
                                            <input type="text" class="form-control" name="action_needed[]" value="{{$univdata->action_needed}}">
                                         </div>
                                         <div class="col-lg-6">
                                            <label class="">Action Date</label>
                                            <input type="text" class="form-control action_date{{$key}}" name="action_date[]" id="action_date" value="{{$univdata->action_date}}" autocomplete="off"> 
                                         </div>
                                     </div>
                                    
                                </div>
                                <div class="col-lg-5">
                                    <h4> <b>UNIVERSITY LOGIN INFORMATION</b> </h4>
                                    <hr>
                                
                                    <div class="form-group m-form__group row">
                                        
                                        <div class="col-lg-12">
                                            <label class="">Login ID</label>
                                            <input type="text" class="form-control" name="login_id[]" value="{{$univdata->login_id}}" autocomplete="off"> 
                                        </div>
                                
                                        <div class="col-lg-12">
                                            <label class=" "> Password </label>
                                            <input type="text" class="form-control" name="login_password[]" value="{{$univdata->login_password}}"> </div>
                                    </div>
                                    <h4> <b>Offer Letter</b> </h4>
                                    <hr>
                                   
                                    <div class="form-group m-form__group row">
                                        
                                        <div class="col-lg-12"> <label class=""> Offer Letter </label>
                                            <a target="new" href="{{URL('/')}}/public/documents/{{$univdata->offer_letter}}">{{$univdata->offer_letter_name}}</a>
                                            <input type="file" class="form-control" name="offer_letter[]" value=""> </div>
                                    </div>
                                </div> 
                            </div>
                            </div>

                             </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                            @endforeach 
                       

                <div class="clone_unversity_details">
                </div>
            
                <div class="stud-main">
                    <div class="student-content">
                                <button type="button" class="btn btn-info" id="add_more" onclick="add_row();"><i class="fa fa-plus"></i> ADD  UNIVERSITY</button>&nbsp;
                               
                            </div>
                </div>


                <div class="add_invoice_div"></div>

                <div class="stud-main">
                    <div class="student-content">
                        <button type="button" class="btn btn-warning add_invoice" data-type="1" id="add_new_invoice"><i class="fa fa-plus"></i>  NEWLY ADDED UNIVERSITY INVOICE</button>&nbsp;
                        @if(count($univdatas))
                        <button type="button" class="btn btn-primary add_invoice" data-type="2" id="add_invoice"><i class="fa fa-plus"></i>  ADD ALL UNIVERSITY INVOICE</button>&nbsp;
                        @endif

                        <button type="button" class="btn btn-danger" id="delete_invoice" style="display: none"><i class="fa fa-minus"></i> DELETE  INVOICE</button>&nbsp;
                               
                    </div>
                </div>

                       

                    <div class="stud-main">
                        <div class="stud-collpase-body">
                            <div class="student-content">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Send Mail To Student</label>
                                <div class="col-lg-6">
                                    <br>
                                    <p>

                                        <div class="form-group">
                               
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio">
                                                    <input type="radio" name="sent_mail" value="1" required="" {{$student->sent_mail == 1 ? "checked": ""}} > YES
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" name="sent_mail" value="0" {{$student->sent_mail == 0 ? "checked": ""}}  > No
                                                    <span></span>
                                                </label>

                                            </div>
                                           
                                        </div>

                                 
                                </div>
                            </div>

                            <div class="form-group m-form__group row updated_details" >
                                <label class="col-lg-2 col-form-label">Email Subject</label>
                                <div class="col-lg-6">
                                    <br>
                                    <textarea name="updated_details" class="form-control">{{$student->updated_details}}</textarea>
                                </div>
                            </div>

                            <hr> 

                              <button class="btn btn-success"><span>Update</span></button> <a href="{{ route('students.index') }}" class="btn btn-danger"><span>Cancel</span></a> </div>
                          </div>
                    
                    </div>
                

                
                </form>
            </div>
                </div>
        
                        <style type="text/css">
                        .univ_id_class {
                           /* border: 1px solid #CCC;
                            padding: 20px;
                            margin: 10px 0;*/
                        }
                        
                        .mg-20 {
                            margin: 20px 0;
                        }
                        .document_type{
                            border: 1px solid #CCC;
                            background: #f8f8f8;
                            padding: 10px 20px;
                            border-radius: 5px;
                            margin-bottom: 20px;
                        }
                        .document_type p{
                            background: #FFF;
                            padding: 5px 10px;
                            font-size: 12px;
                        }
                    </style>

<div style="display: none;">

<div class="org_container">
                    <div class="org_container_rows2" id="university_details_row">
                            <div class="univ_id_class">

                                    <div class="stud-main">
                                        <div class="stud-collpase-head">

                                            UNIVERSITY DETAILS <span style="color: #000"></span>

                                             <span class="pull-right"> <button type="button" class="btn btn-danger btn-sm remove_unv_de" id="remove_one"><i class="fa fa-minus"></i> DELETE</button></span>

                                        </div>
                                        <div class="stud-collpase-body" style="display: block">
                                            <div class="student-content">

                
                                         <div class="row">
                                            <div class="col-lg-10">
                                            
                                                <input type="hidden" class="univ_id" name="univ_id[]" >
                                                <h4><b>UNIVERSITY DATA</b></h4>
                                                <hr>
                                                <div class="row mg-20">
                                                    <div class="col-lg-6">
                                                        <label class="">Application Date</label>
                                                        <input type="text" class="form-control application_date application_date" id="application_date" name="application_date[]" > </div>
                                                    <div class="col-lg-6">
                                                        <label class="">University Name</label>
                                                        <input type="text" class="form-control university_name_class" name="university_name[]" > </div>
                                                   
                                                </div>
                                                <div class="row mg-20">

                                                     <div class="col-lg-4">
                                                        <label class="">University Application ID</label>
                                                        <input type="text" class="form-control" name="application_id[]" > </div>

                                                    <div class="col-lg-4">
                                                        <label>Major</label>
                                                        <input type="text" class="form-control" name="major[]" > </div>
                                                    <div class="col-lg-4">
                                                        <label>Intake</label>
                                                        <input type="text" class="form-control" name="intake[]" > </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">Status</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control status status" name="status[]"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group m-form__group row">
                                                    
                                                    <div class="col-lg-12">
                                                        <label class="">Comments</label>
                                                        <textarea type="text" class="form-control" name="comments[]"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mg-20">

                                                     <div class="col-lg-6">
                                                        <label class="">Action Needed</label>
                                                        <input type="text" class="form-control" name="action_needed[]" value="">
                                                     </div>
                                                     <div class="col-lg-6">
                                                        <label class="">Action Date</label>
                                                        <input type="text" class="form-control action_date" name="action_date[]" id="action_date" value="" autocomplete="off"> 
                                                     </div>
                                                 </div>
                                                
                                            </div>
                                            <div class="col-lg-5">
                                                <h4> <b>UNIVERSITY LOGIN INFORMATION</b> </h4>
                                                <hr>
                                            
                                                <div class="form-group m-form__group row">
                                                    
                                                    <div class="col-lg-12">
                                                        <label class="">Login ID</label>
                                                        <input type="text" class="form-control" name="login_id[]" value="" autocomplete="off"> 
                                                    </div>
                                            
                                                    <div class="col-lg-12">
                                                        <label class=" "> Password </label>
                                                        <input type="text" class="form-control" name="login_password[]" value=""> </div>
                                                </div>
                                                <h4> <b>Offer Letter</b> </h4>
                                                <hr>
                                               
                                                <div class="form-group m-form__group row">
                                                    
                                                    <div class="col-lg-12"> <label class=""> Offer Letter </label>
                                                        
                                                        <input type="file" class="form-control" name="offer_letter[]" value=""> </div>
                                                </div>
                                            </div> 
                                        </div>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div style="display: none;">
    <div class="doc_org_container">
        <div class="doc_org_container_rows" id="org_container_rows">
              <div class="form-group m-form__group row" id="org_row">
                  <label class="col-lg-2 col-form-label"> Document </label>
                    <div class="col-lg-4">

                        <select name="document_type[]" class="form-control main_document_type">
                          <option value=""> Select Document Type</option>

                          @foreach($document_types as $document_type)

                          <option value="{{$document_type->id}}"> {{$document_type->document_name}}</option>

                           @endforeach

                        </select>

                    </div>

                    <div class="col-lg-4">
                      
                      <input type="hidden" class="form-control" name="doc_id[]" value="" >

                      <input type="file" class="form-control" name="document[]"  value="" >

                    </div>

                    <div class="col-lg-2">
                        <select name="document_status[]" class="form-control">
                                        <option value=""> Select Document Status</option>
                                        <option value="1"  >Approved</option> 
                                        <option value="2" >Rejected</option> 
                                    </select>
                                </div>
                    </div>
              </div>  
        </div>
    </div>
</div>

    <div class="invoice_class" style="display: none">
     <div class="stud-main">
                        <div class="stud-collpase-head">
                           INVOICE
                        </div>
                        <div class="stud-collpase-body" style="display: none1">
                            <div class="student-content">
                                 
                                 <div class="col-md-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-2 col-form-label"> <b>Date :</b> </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control billing_date" name="billing_date" id="date" value="{{ old('date',date('Y-m-d')) }}"  >
                                            </div>   
                                        </div>
                                 </div>

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
                                        <tr class="tr_clone all_app">
                                            <td>
                                                <button type="button" class="btn btn-warning"  onclick="add_row_invoice();" style="margin-top:20px;height:35px;">
                                                    <i class="fa fa-plus"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger remove_row_invoice " style="margin-top:20px;height:35px;">
                                                    <i class="fa fa-minus"></i>
                                                </button>

                                            </td>
                                             <td>
                                                <input type="text" class="form-control application_name" id="application_name" name="application_name[]" style="margin-top:20px;height:35px;" required>
                                            </td>
                                           
                                            <td>
                                                <input type="number" class="form-control application_fees" id="application_fees" value="0.000" name="application_fees[]" style="margin-top:20px;height:35px;" required>
                                            </td>
                                         
                                            <td>
                                               <input type="number" class="form-control service_fees" id="service_fees" name="service_fees[]" value="0.000" style="margin-top:20px;height:35px;" required>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control amount" id="amount" name="amount[]" autocomplete="off" value="0.000" style="width:250px;margin-top:20px;height:35px;">
                                            </td>
                                        
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-4 col-form-label"> <b>Total</b></label>
                                        <div class="col-lg-8">
                                           
                                             <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">KWD</span>
                                                  </div>
                                                <input type="text" class="form-control sub_total" name="sub_total" id="sub_total" value="0.000" >
                                                </div>

                                        </div>   
                                    </div>

                                      <div class="form-group m-form__group row">
                                        <label class="col-lg-4 col-form-label"> <b>Discount</b></label>
                                        <div class="col-lg-8">
                                           
                                        <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">KWD</span>
                                                  </div>
                                                <input type="text" class="form-control discount" name="discount" id="discount" value="0.000">
                                                </div>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group m-form__group row">


                                        <label class="col-lg-4 col-form-label"><b>Net Total</b></label>
                                        <div class="col-lg-8">

                                            <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">KWD</span>
                                                  </div>
                                                <input type="text" class="form-control total_amount" name="total_amount" id="total_amount" value="0.000">
                                                </div>

                                            
                                        </div>   
                                    </div>
                                  
                                    

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                                                   
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" value="1" name="send_invoice"> Send Invoice to Mail
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
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
 $("body").on("change",".main_document_type",function(){
    my_doc();
  });

 function my_doc(){
     $('.main_document_type option').attr("disabled", false);
      
     $(".main_document_type").each(function(index) {
       var doc_val = $(this).val();
       var document_type_id = $(this).attr("data-id");
       var document_type_id_two  = $(this).attr("data-id");
      if(doc_val){
        console.log(document_type_id +"--"+ document_type_id_two);

       // if(document_type_id != document_type_id_two){
          $('.main_document_type option[value="'+doc_val+'"]').attr("disabled", true);
           $(this).find(':selected').attr("disabled", false);
        //}
      }
     });
 }
 });

    $(".billing_date").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });


    $("body").on("click",".add_invoice",function(){

            var type = $(this).data('type');
            if(type == 1) var class_name  = ".clone_unversity_details";
            else var class_name  = ".student_form";
           // alert(class_name);
            var invoice_class = $(".invoice_class .stud-main").clone();

            $( class_name + " .university_name_class").each(function(index) {
                var university_name = $(this).val();
                //console.log(university_name);
          
                invoice_class.find(".application_fees, .service_fees, .amount").val("0.000");
                var table_row = invoice_class.find("tr:last").clone();
                table_row.find(".application_name").val(university_name);
                invoice_class.find('tbody').append(table_row);
            });


            //  var tableBody = $('.student_form #mytable').find("tbody");
                var class_count = $(class_name +" .university_name_class").length;
                
                if(class_count > 0) {  invoice_class.find(".all_app:first").remove();}

            

            $(".add_invoice_div").html(invoice_class);

            $(".add_invoice").hide();
             $("#delete_invoice").show();
    });
   
    $("body").on("click","#delete_invoice",function(){
        $("#delete_invoice").hide();
        $(".add_invoice").show();
        $(".add_invoice_div").empty();
    });
     

     function add_row_invoice() {
        var $tableBody = $('#mytable').find("tbody");
                $trLast = $tableBody.find("tr:last");
                $trNew = $trLast.clone().find('input').val('').end();
                $trLast.after($trNew);
    }

    $("body").on("click",".remove_row_invoice",function(){
        $(this).parents("tr").remove();
    });
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


$("#validate_id").validate({
    focusInvalid: false,
    invalidHandler: function(form, validator) {
        if(!validator.numberOfInvalids()) return;
        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 2000);
    }
});
var arrows;
if(KTUtil.isRTL()) {
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

$("#action_date").datepicker({
    format: 'yyyy-mm-dd',
    orientation: "bottom left",
    templates: arrows,
    autoclose: true
});

function get_count() {
    var len = $(".status").length;
    for(var i = 0; i < len; i++) {
        $(".status" + i).summernote({
            height: 100
        });
        $(".application_date" + i).datepicker({
            format: 'yyyy-mm-dd',
            orientation: 'bottom left',
            templates: arrows,
            autoclose: true
        });

        $(".action_date" + i).datepicker({
            format: 'yyyy-mm-dd',
            orientation: 'bottom left',
            templates: arrows,
            autoclose: true
        });

    }
}
get_count();
</script>

<script type="text/javascript">
function add_row() {
    var a = $('#university_details_row .univ_id_class').clone();
    a.find(".application_date").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });
    a.find(".action_date").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom left',
        templates: arrows,
        autoclose: true
    });
    a.find(".status").summernote({
        height: 150
    });
    a.find('input').val('').end().find('textarea').val('').end().appendTo('.clone_unversity_details');
}
$("body").on("click",'.remove_unv_de', function() {
    var con = confirm("Are your sure to delete");
    if(con == true) {
        var univ_id = $(this).parents(".stud-main").find(".univ_id").val();
        //var univ_id = $('.org_container .univ_id_class').last().find(".univ_id").val();
        //alert(univ_id);
        if(univ_id) {
            //alert(univ_id);
            $.ajax({
                url: "{{url('/')}}/admin/students/delete_university/" + univ_id,
                success: function(html) {}
            });
        }
        $(this).parents(".stud-main").remove();
    }
});


      function add_doc_row()
      {
        $('.doc_org_container .doc_org_container_rows').clone().appendTo('.doc_cloned_row');
        
      }

      function remove_doc_clone()
      {  
          $('.doc_cloned_row .doc_org_container_rows').last().remove();
      }


      $("body").on("click",".stud-collpase-head",function(){
            $(this).parents(".stud-main").find(".stud-collpase-body").toggle();
      });
</script> @endpush