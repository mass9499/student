@extends('layouts.email-layout')

@section('content')

            <table style="width: 100%; background: #ffffff; border-radius: 3px;">

              <tr>
                <td  style=" font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tr>
                      <td style=" font-size: 14px; vertical-align: top;">
                       		<h2 align="center">Welcome to ASEC</h2>
                        <h3>Dear {{$datas['first_name'] ." ". $datas['last_name']}}, </h3>
					    <p>You have just been enrolled to <b>ASEC PORTAL  and your registration has been confirmed.</b> </p>

					    <h3>Your Registration Details</h3>

					    <p><b>Registered ID :</b> {{$student_code }}</p>
					    <br>
					    <h3>Your Login Details</h3	>	
					    <table border="1" width="100%;" cellpadding="8" cellspacing="0"> 
					    	<tr>
					    		<td width="30%">Email Id</td>
					    		<td>: {{$datas['email'] }}</td>
					    	</tr>
					    	<tr>
					    		<td >Password</td>
					    		<td>: {{$mail_password }}</td>
					    	</tr>
					    	<tr>
					    		<td >Login Link</td>
					    		<td>: <a href="{{url('/')}}">{{url('/')}}</a></td>
					    	</tr>
					    </table>
					<br>
					    <h3>Track Your Application Status  Online</h3>

					    <table border="1" width="100%;" cellpadding="8" cellspacing="0"> 
					    	<tr>
					    		<td width="30%">Tracking  Id</td>
					    		<td>: {{$track_id }}</td>
					    	</tr>
					    	<tr>
					    		<td >Track Link</td>
					    		<td>: <a href="{{url('/')}}/track">{{url('/')}}/track</a></td>
					    	</tr>
					    </table>
					        </td>
                    </tr>
                  </table>

                      </td>
                    </tr>
                  </table>
			
@endsection
