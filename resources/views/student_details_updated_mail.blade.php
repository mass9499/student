@extends('layouts.email-layout')
@section('content')

	<table width="100%" width="100%" style="padding: 10px;background: #FFF;">
			<tr>
				<td>
					<h3 align="center">Your Details Updated</h3>
					<h4>Dear {{$student->first_name }} {{$student->last_name}} </h4>
				    <p style="font-size: 14px;">Your Profile details has been Updated for this {{$setting->company_name}}.<br> </p><br>
				     <p style="font-size: 14px;">Updated Details : {{$student->updated_details}}.<br> </p><br>
			</tr>

	</table>
@endsection