<tr>
	<td><img src="{{ url('/images/logo/'.$settings->logo) }}" alt="" /></td>
</tr>

<tr>
	<td style="margin:0;color:#2a2323;font-size: .9rem;line-height:1rem;font-family: Arial, Helvetica, sans-serif;">
		{{ __('frontend.mail_footer_text_1') }}
		<a href="{{ url('/terms_condition') }}" style="color:#006b99;text-decoration: underline;">
			{{ __('frontend.more_details') }}
		</a>
	</td>
</tr>

<tr>
	<td style="margin:0;color:#2a2323;font-size: .9rem;line-height:1rem;font-family: Arial, Helvetica, sans-serif;">
		{{ __('frontend.mail_footer_text_2', ['param_1'=>__('frontend.tutor'), 'param_2'=>$settings->project_title]) }}
		<a href="{{ route('registration') }}" style="color:#006b99;text-decoration: underline;">
			{{ __('frontend.more_details') }}
		</a>
	</td>
</tr>

<tr>
	<td style="margin:0;color:#2a2323;font-size: .9rem;line-height:1rem;font-family: Arial, Helvetica, sans-serif;">
		{{ __('frontend.mail_footer_text_3') }}
		<a href="{{ url('/privacy_policy') }}" style="color:#006b99;text-decoration: underline;">
			{{ __('frontend.website_privacy_center', ['param'=>$settings->project_title]) }}
		</a>
	</td>
</tr>

<tr>
	<td height="10"></td>
</tr>

<tr>
	<td align="center">
		<table width="60%">
			<tbody>
				<tr>
					<td style="height: 1px ;background: #fff; opacity:.31;"> </td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>

<tr>
	<td align="center" style="margin:0;color:#2a2323;font-size: .9rem;line-height:1rem;font-family: Arial, Helvetica, sans-serif;">
		{{ $settings->cpy_txt }}
	</td>
</tr>