@extends('layouts.admin')

@section('content')
<style type="text/css">
  .category_order { width: 100px; }
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
                                                     
                                            <a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ URL ('admin/page/create')}}">Add New</a>
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
                        
                       
                            <table class="table table-bordered m-table m-table--border-primary" id="datatables">
                                <thead>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Page Name</th>
                                        <th>Page Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                     @foreach($results as $key => $result)
                                     <tr>
                                         <td>{{$key + 1}}</td>
                                         <td>{{ $result->page_name }}</td>
                                         <td>{{ $result->page_slug }}</td>
                                        <td> 
                                             <form method="post" action="{{ route('page.index') }}/{{$result->id}}" enctype="multipart/form-data" >

                                                <a href="{{ URL::to('/')}}/admin/page/{{$result->id}}/edit" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are Sure to Delete')"><i class="fa fa-trash"></i></button>
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