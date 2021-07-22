<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table border="0" cellspacing="0" cellpadding="0" width="634px" align="center" style="font-family: 'Helvetica Neue',Arial,sans-serif; ">
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td><img src="{{url('/')}}/public/images/{{$setting->image_name}}" alt="{{$setting->company_name}}"  width="200" /></td>
					<td align="right"><h3>Reset Password</h3></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td>
						<h5>Dear {{$student->first_name}} {{$student->last_name}}</h5>
						<p style="color: #545454;font-size: 14px;">You've recently asked to reset the password for this {{$setting->company_name}} account.<br>
						 </p>
						 <p style="color: #545454;font-size: 14px;">Please use OTP - {{$student->otp}} to verify your app</p>
						
					
				</tr>
			</table>
		</td>
	</tr>
</table>
	
</table>
</body>
</html>