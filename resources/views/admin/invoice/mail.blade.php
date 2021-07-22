@extends('layouts.email-layout')

@section('content')

            <table  style="width: 100%; background: #ffffff; border-radius: 3px; padding: 10px;">

           
                    <tr>
                      <td style=" font-size: 14px; vertical-align: top;">
                       		<h2 align="center">Welcome to ASEC</h2>
                        <h3>Dear {{$student->first_name." ".$student->last_name}}, </h3>
					    <p>Please see the attached invoice for your reference</p>
					    <br>
					    <br>
					</td>
				</tr>
			</table>

@endsection
