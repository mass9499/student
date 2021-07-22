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
					<td align="right"><h3>Thanks For Contacting GooAds</h3></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td>
						<h5>Dear {{ $data['fullname'] }} </h5>
					    <p style="color: #545454;font-size: 14px;">You've recently contacted for this {{$setting->company_name}}.<br> </p>
						
				</tr>
			</table>
		</td>
	</tr>
</table>
	
</table>
</body>
</html>