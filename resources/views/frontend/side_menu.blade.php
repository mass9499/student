 <div class="col-md-3">

  <div class="text-center user-img-box"> 

    <img src="{{url('/')}}/public/images/user.png" class="user-ong" width="100" height="100"> 

    <h5 class="text-center ">{{Session::get('first_name') }}</h5> 

    <p>{{@Session::get('student_code') }}</p>

    <ul class="text-left side-menu-ui"> 

      <li class=""><a href="{{url('/')}}/dashboard"><i class="fa fa-bar-chart"></i> Application Process</a></li> 

      <li class=""><a href="{{url('/')}}/documents"><i class="fa fa-file"></i> Documents</a></li>

        <li class=""><a href="{{url('/')}}/invoice"><i class="fa fa-file"></i> Invoice</a></li>

      <!-- <li class=""><a href="{{url('/')}}/offer_letter"><i class="fa fa-envelope-square"></i> Offer Letter</a></li> -->

      <li class=""><a href="{{url('/')}}/queries"><i class="fa fa-info-circle"></i> Queries</a></li> 

      <li class=""><a href="{{url('/')}}/profile"><i class="fa fa-user"></i> Profile</a></li> 

      <li class=""><a href="{{url('/')}}/change_password"><i class="fa fa-lock"></i> Change Password</a></li> 

      <li><a href="{{url('/')}}/user/logout"><i class="fa fa-sign-out"></i> Logout</a></li> 

    </ul> 

  </div>

</div>

