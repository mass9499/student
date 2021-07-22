@extends('layouts.app')
@section('content')

<div class="dashboard">
    <div class="container">
        
      <div class="row side-menu m-t30">
       

        @include('frontend.side_menu')
        <div class="col-md-9"> 
          <div class="dashboard-detail"> 
            <div class="my-details"> 
              <h3 class="text-uppercase">Offer Letter </h3>
              <hr>
               <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>Application ID</th>
                      <th>University Name</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($offer_letters as $key => $row)
                    <tr>
                      <td>#{{$key + 1}}</td>
                      <td>{{$row->application_id}}</td>
                      <td>{{$row->university_name}}</td>
                      <td>   
                      <a href="{{url('/')}}/public/documents/{{$row->offer_letter}}" target="new" class="btn btn-info">View</a>
                      <a href="{{url('offer_letter_download') }}/{{$row->id}}" class="btn btn-warning">Download</a>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>

           </div> 
         </div> 
       </div>
      </div>
  </div>
</div>

@endsection
   