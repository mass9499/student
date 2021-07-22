@extends('layouts.email-layout')
@section('content')

		<table width="100%" width="100%" style="padding:30px 15px;background: #FFF;">
			<tr>
				<td>
					<h4>Dear {{$student->first_name}} {{$student->last_name}}</h4>
					<p style="font-size: 14px;">You've recently asked to reset the password for this {{$setting->company_name}} account.<br>
					</p>

					 <p align="center" style="margin-top: 50px; margin-bottom: 50px;"><a href="{{url('/')}}/reset_password/{{$student_otp->otp}}" style="font-size: 14px; background: #089FA2;color:#FFF;padding: 10px 30px;text-decoration: none;">CLICK HERE TO RESET PASSWORD</a></p>

					 <p>If you did not reset your password no further action required, Just ignore this email and your password will not change.</p>


				</td>
			</tr>

		</table>

@endsection