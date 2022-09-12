@extends('email.layouts.layout')

@section('pageContent')
	<tr>
		<td id="f-35" style="margin:0;color:#000000;text-align: center;font-weight:bold;font-size: 2.5rem;font-family: Arial, Helvetica, sans-serif;">
			{{ $subject }}
		</td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td id="f-13" style="margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
			{{ $message }}.
		</td>
	</tr>
	
	<tr>
		<td height="30"></td>
	</tr>
	
	<tr>
		<td height="30"></td>
	</tr>
@endsection