@extends('email.layouts.layout')

@section('pageContent')
	<tr>
		<td id="f-35" style="margin:0;color:#000000;text-align: center;font-weight:bold;font-size: 2.5rem;font-family: Arial, Helvetica, sans-serif;">
			{{ __('frontend.review').' '.__('frontend.tutor') }}
		</td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td style="text-align: center;">
			<img src="{{ url('frontAssets/images/bannerate.png') }}" alt="" style="max-width:100%" />
		</td>
	</tr>
	
	<tr>
		<td height="40"></td>
	</tr>
	
	<tr>
		<td style="margin:0;color:#000;font-size: 1rem;font-weight:bold;line-height:2rem;font-family: Arial, Helvetica, sans-serif;"></td>
	</tr>
	
	<tr>
		<td id="f-13" style="margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
			{{ $x }}.
		</td>
	</tr>
	
	<tr>
		<td height="20"></td>
	</tr>
	
	<tr>
		<td id="f-13" style="margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;"></td>
	</tr>
	
	<tr>
		<td height="20"></td>
	</tr>
	
	<tr>
		<td style="font-weight:bold;margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
			{{ __('frontend.how_did_the_lesson_go') }}
		</td>
	</tr>

	<tr>
		<td style="margin:0;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
			<a href="{{ url('tutor/page/'.$meetingid) }}" style="color:#BA9A74;text-decoration: underline;">
				{{ __('frontend.please_rate_the_tutor') }}
			</a>
		</td>
	</tr>
	
	<tr>
		<td height="20"></td>
	</tr>
@endsection