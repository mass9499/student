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
                    <div class="kt-portlet__head-actions">
                        <a href="{{url('/')}}/admin/invoice/create/{{$student_id}}" class="btn btn-primary">Add Invoice</a>
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
                    </strong> </div>
            </div>
        </div>
        @endif
        
            <table class="table table-bordered m-table m-table--border-primary" id="datatables">
                <thead>
                    <tr>
                        
                        <th>SNo</th> 
                        <th>Invoice Number</th>
                        <th>Billing Date</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Total Amount</th>
                        <th>Preview</th>
                        <th>Send Mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> @foreach($invoices as $key => $invoice)
                    <tr>
                        
                        <td>{{$key + 1}}</td>
                       
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ date("d-m-Y",strtotime($invoice->billing_date)) }}</td>
                        <td>{{ $invoice->billing_phone }}</td>
                        <td>{{ $invoice->billing_email }}</td>
                        <td>{{ $invoice->total_amount }}</td>
                       
                        <td>
                            <a  target="_blank" href="{{url('public/invoice/')}}/{{$invoice->invoice_file_name}}" class="btn btn-success btn-sm"  ><i class="fas fa-file"></i></a>
                        </td>

                        <td>
                           

                             <a href="{{url('admin/invoice/invoice_mail')}}/{{$invoice->id}}" class="btn btn-warning btn-sm" onclick="return confirm('Are Sure to Send Invoice Email')" ><i class="fas fa-envelope"></i></a>
                        </td>

                        <td>
                            <form method="post" action="{{url('admin/invoice/delete')}}/{{$invoice->id}}" enctype="multipart/form-data">
                                @csrf 
                                @method('DELETE')

                                <a href="{{url('admin/invoice/show')}}/{{$invoice->id}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>


                               
                            <a href="{{url('admin/invoice')}}/{{$invoice->id}}/edit/{{$invoice->student_id}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are Sure to Delete')"><i class="fa fa-trash"></i></button>
                            
                            </form>
                    </tr> @endforeach </tbody>
            </table>

        </div>
    </div>
</div>
@endsection 

@push('scripts')

@endpush
