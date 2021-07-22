@extends('layouts.app') @section('content')

<div class="dashboard">
    <div class="container">
        <div class="row side-menu m-t30">
            @include('frontend.side_menu')

            <div class="col-md-9">
                <div class="dashboard-detail">
                    <div class="my-details">
                        <h4 class="text-uppercase">Application Process</h4>

                        <hr />

                        <div class="row">
                            <div class="col-md-4">
                                <p>ASEC REGISTRATION ID</p>
                            </div>

                            <div class="col-md-8">
                                <p>: {{$student->student_code ? $student->student_code : "-"}}</p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <p>ASEC Tracking ID</p>
                            </div>

                            <div class="col-md-8">
                                <p>: {{$student->track_id ? $student->track_id : "-"}}</p>
                            </div>
                        </div>


                        <hr />

                        <div class="accordion" id="accordionExample">
                            @if(count($university_data)) @foreach($university_data as $key => $unversity)

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                            University Details ({{$key + 1}})
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse{{$key}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Application Date</p>
                                            </div>

                                            <div class="col-md-8">
                                                <p>: {{$unversity->application_date ? $unversity->application_date : "-"}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>University Name</p>
                                            </div>

                                            <div class="col-md-8">
                                                <p>: {{$unversity->university_name ? $unversity->university_name : "-"}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>University Application ID</p>
                                            </div>

                                            <div class="col-md-8">
                                                <p>: {{$unversity->application_id ? $unversity->application_id : "-"}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Major</p>
                                            </div>

                                            <div class="col-md-8">
                                                <p>: {{$unversity->major ? $unversity->major : "-"}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Intake</p>
                                            </div>

                                            <div class="col-md-8">
                                                <p>: {{$unversity->intake ? $unversity->intake : ""}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Status</p>
                                            </div>

                                            <div class="col-md-8">{!!$unversity->status!!}</div>
                                        </div>

                                        <hr />

                                        <div class="pull-right">
                                            <p style="font-weight: bold;">Last Updated: {{$unversity->updated_at ? $unversity->updated_at : "-"}}</p>
                                        </div>
                                        <br />
                                    </div>
                                </div>
                            </div>
                       

                        @endforeach @else

                        <h3 class="text-center">We will update soon.</h3>

                        @endif
                         </div>

                        <div class="mt-5"></div>
                         <hr />
                        <h4 class="">Offer letter</h4>
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
                                 @if(count($offer_letters))
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

                                @else
                                 <tr>
                                    <td colspan="4" class="text-center">No Offer Available</td>
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
