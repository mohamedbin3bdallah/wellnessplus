@extends('email.layouts.layout')

@section('pageContent')
	<tr>
		<td id="f-35" style="margin:0;color:#000000;text-align: center;font-weight:bold;font-size: 2.5rem;font-family: Arial, Helvetica, sans-serif;">
			{{ __('frontend.confirm').' '.__('frontend.lesson') }}
		</td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td style="text-align: center;">
			<img src="{{ url('frontAssets/images/banner.png') }}" alt="" style="max-width:100%" />
		</td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td id="f-13" style="margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
			{{ $x }}.
		</td>
	</tr>
	
	<tr>
		<td height="30"></td>
	</tr>
	
	<tr>
		<td align="center">
			<a href="{{ url('bigblue/api/create/meeting/'.$meetingid) }}">
				<button style="border-radius: 30px;background: #877456; width:90%; height:65px;color:#fff;border:0;font-size:1.4rem;;font-family: Arial, Helvetica, sans-serif;box-shadow: 0px 3px 18px rgba(0, 0, 0, 0.16);">
					{{ __('frontend.enter_classroom') }}
				</button>
			</a>
		</td>
	</tr>
	
	<tr>
		<td height="30"></td>
	</tr>
@endsection