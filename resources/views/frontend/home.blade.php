@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12"> 
           @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>

                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach 

                    </ul>
                </div>
            @endif            
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

</script>

@endpush
    