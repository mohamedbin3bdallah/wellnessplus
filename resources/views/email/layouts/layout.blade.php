<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $settings->project_title }}</title>
    <link rel="stylesheet" href="{{ url('frontAssets/css/mail.css') }}">
    <script id="swatch active" type="colorScheme">
      {
          "name":"Default",
          "bgBody":"ffffff",
          "link":"27A1E5",
          "color":"AAAAAA",
          "bgItem":"ffffff",
          "title":"444444"
      }
    </script>
</head>

<body paddingwidth="0" paddingheight="0" bgcolor="#f0f0f0"
      style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;"
      offset="0" toppadding="0" leftpadding="0">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td>
					<table width="600" cellspacing="0" id="MainTable" cellpadding="0" align="center">
						<tbody>
							<tr>
								<td>
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<table>
														<tbody>
															<tr>
																<td><img src="{{ url('/images/logo/'.$settings->logo) }}" alt="" /></td>
															</tr>
														</tbody>
													</table>
												</td>
												<td align="right">
													<table cellspacing="15px">
														<tbody>
															@include('email.layouts.header')
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center">
									<table width="90%" border="0" cellspacing="5" cellpadding="0">
										<tbody>
											<tr>
												<td height="30"></td>
											</tr>
											<tr>
												<td height="30"></td>
											</tr>
											<tr>
												<td>
													<table>
														<tbody>
															<tr>
																<td>
																	<table>
																		<tbody>
																			@yield('pageContent')
																			<tr>
																				<td>
																					<table>
																						<tbody>
																							<tr>
																								<td style="margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
																									{{ __('frontend.thanks') }}
																								</td>
																							</tr>
																							<tr>
																								<td style="font-weight:bold;margin:0;color:#000;font-size: 1rem;line-height:2rem;font-family: Arial, Helvetica, sans-serif;">
																									{{ $settings->project_title }}
																								</td>
																							</tr>
																							<tr>
																								<td height="30"></td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="40"></td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table cellspacing="15">
										<tbody>
											@include('email.layouts.footer')
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>