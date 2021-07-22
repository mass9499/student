@extends('layouts.app')

@section('content')

<div class="dashboard">
    <div class="container">
      <div class="row side-menu m-t30">
        @include('frontend.side_menu')
        <div class="col-md-9"> 
          <div class="dashboard-detail"> 
            <div class="my-details"> 
              <h3 class="text-uppercase">Invoice </h3>
              <hr>
               <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>Invoice Number</th>
                      <th>Amount</th>
                      <th>Invoice Date</th>
                      
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(count($invoice))

                   
                     @foreach($invoice as $key => $row)
                    <tr>
                      <td>{{$key  +  1}}</td>
                      <td>{{$row->invoice_number}}</td>
                      <td>{{$row->total_amount}}</td>
                      <td>{{$row->billing_date}}</td>
                      <td>   
                        

                        <a target="_blank" href="{{url('public/invoice/')}}/{{$row->invoice_file_name}}" class="btn btn-success"  >View</a>

                         <a href="{{url('invoice/download')}}/invoice-{{$row->id}}-{{$row->student_id}}-{{rand(100000,200000)}}" class="btn btn-warning">Download</a>


                    

                      </td>

                    </tr>
                    @endforeach
                     @else
                     <tr>
                      <td colspan="4" align="center">No Invoice Found</td>
                     </tr>
                    @endif
                   
                  </tbody>
                </table>
           </div> 
         </div> 
       </div>
      </div>
  </div>
</div>

@endsection

   