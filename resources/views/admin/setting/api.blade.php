@extends('admin.layouts.master')
@section('title', __('adminstaticword.APISetting'))
@section('body')

<section class="content">
   	@include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              		<h3 class="box-title">{{ __('adminstaticword.APISetting') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ route('api.update') }}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('POST') }}

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('adminstaticword.VAPULUS_PAYMENT') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="vapulus_sec1" type="checkbox" name="vapulus_check" {{ $gsetting->vapulus_enabled==1 ? 'checked' : '' }}/>
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="vapulus_sec1"></label>
                                </li>


                                <br>
                                <div class="row" style="{{ $gsetting->vapulus_enabled==1 ? '' : 'display:none' }}" id="vapulus_sec">
                                    <div class="col-md-6">
                                        <label for="VAPULUS_WEBSITE_ID">{{ __('adminstaticword.VAPULUS_WEBSITE_ID') }}<sup class="redstar">*</sup></label>
                                        <input value="{{ $env_files['VAPULUS_WEBSITE_ID'] }}" autofocus name="VAPULUS_WEBSITE_ID" type="text" class="form-control" placeholder="{{ __('adminstaticword.VAPULUS_WEBSITE_ID') }}"/>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="VAPULUS_MERCHANT_ID">{{ __('adminstaticword.VAPULUS_MERCHANT_ID') }}<sup class="redstar">*</sup></label>
                                        <input value="{{ $env_files['VAPULUS_MERCHANT_ID'] }}" autofocus name="VAPULUS_MERCHANT_ID" type="text" class="form-control" placeholder="{{ __('adminstaticword.VAPULUS_MERCHANT_ID') }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

						<div class="row hidden">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.STRIPEPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="s_sec1" type="checkbox" name="stripe_check" {{ $gsetting->stripe_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="s_sec1"></label>
		                        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->stripe_enable==1 ? '' : 'display:none' }}" id="s_sec">
		                          <div class="col-md-6">
				                    <label for="STRIPE_KEY">{{ __('adminstaticword.StripeKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['STRIPE_KEY'] }}" autofocus name="STRIPE_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.StripeKey') }}"/>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="s_secretkey">{{ __('adminstaticword.StripeSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['STRIPE_SECRET'] }}" autofocus name="STRIPE_SECRET" type="text" class="form-control" placeholder="{{ __('adminstaticword.StripeSecretKey') }}"/>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

		              	<div class="row hidden">
							<div class="col-md-12">
		                        <label for="pay_enable">{{ __('adminstaticword.PAYPALPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="pay_sec1" type="checkbox" name="paypal_check" {{ $gsetting->paypal_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="pay_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ $gsetting->paypal_enable==1 ? '' : 'display:none' }}" id="pay_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">{{ __('adminstaticword.PaypalClientID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" autofocus name="PAYPAL_CLIENT_ID" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaypalClientID') }}"/>
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="pay_sid">{{ __('adminstaticword.PaypalSecretID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYPAL_SECRET'] }}" autofocus name="PAYPAL_SECRET" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaypalSecretID') }}"/>
					                    <br>
					                </div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">{{ __('adminstaticword.PaypalMode') }}<sup class="redstar">*</sup></label>
				                    	<input value="{{ $env_files['PAYPAL_MODE'] }}" autofocus name="PAYPAL_MODE" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaypalMode') }}"/>
				                    	<small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.for_param_use', ['param'=>'Test']) }} <b>"sandbox"</b> {{ __('dashboard.and').' '.__('dashboard.for_param_use', ['param'=>'Live']) }} <b>"live"</b></small>
				                  	</div>

				              	</div>
		                    </div>
		                </div>
						<br>
						<br>

						<div class="row hidden">
							<div class="col-md-12">
		                        <label for="pay_enable">{{ __('adminstaticword.INSTAMOJOPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="insta_sec1" type="checkbox" name="instamojo_check" {{ $gsetting->instamojo_enable==1 ? 'checked' : '' }} />
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="insta_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ $gsetting->instamojo_enable==1 ? '' : 'display:none' }}" id="insta_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">{{ __('adminstaticword.InstaMojoApiKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['IM_API_KEY'] }}" autofocus name="IM_API_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.InstaMojoApiKey') }}"/>
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="pay_sid">{{ __('adminstaticword.InstaMojoAuthToken') }} <sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['IM_AUTH_TOKEN'] }}" autofocus name="IM_AUTH_TOKEN" type="text" class="form-control" placeholder="{{ __('adminstaticword.InstaMojoAuthToken') }}"/>
					                    <br>
					                </div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">{{ __('adminstaticword.InstaMojoURL') }}<sup class="redstar">*</sup></label>
				                    	<input value="{{ $env_files['IM_URL'] }}" autofocus name="IM_URL" type="text" class="form-control" placeholder="{{ __('adminstaticword.InstaMojoURL') }}"/>
				                    	<small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.for_param_use', ['param'=>'Test']) }} <b>https://test.instamojo.com/api/1.1/</b> <br>
				                    	<i class="fa fa-question-circle"></i> {{ __('dashboard.for_param_use', ['param'=>'Live']) }} <b>https://www.instamojo.com/api/1.1/</b></small>
				                  	</div>
				              	</div>
		                    </div>
		                </div>
						<br>
						<br>

						<div class="row hidden">
							<div class="col-md-12">
		                        <label for="razorpay_enable">{{ __('adminstaticword.RAZORPAYPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="razor_sec1" type="checkbox" name="razor_check" {{ $gsetting->razorpay_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="razor_sec1"></label>
		                        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->razorpay_enable==1 ? '' : 'display:none' }}" id="razor_sec">
		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.RazorpayKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['RAZORPAY_KEY'] }}" autofocus name="RAZORPAY_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.RazorpayKey') }}"/>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.RazorpayKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['RAZORPAY_SECRET'] }}" autofocus name="RAZORPAY_SECRET" type="text" class="form-control" placeholder="{{ __('adminstaticword.RazorpayKey') }}"/>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

		              	<div class="row hidden">
							<div class="col-md-12">
		                        <label for="paystack_enable">{{ __('adminstaticword.PAYSTACKPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="paystack_sec1" type="checkbox" name="paystack_check" {{ $gsetting->paystack_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="paystack_sec1"></label>
		                        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->paystack_enable==1 ? '' : 'display:none' }}" id="paystack_sec">
		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.PayStackPublicKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_PUBLIC_KEY'] }}" autofocus name="PAYSTACK_PUBLIC_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.PayStackPublicKey') }}"/>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PayStackSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_SECRET_KEY'] }}" autofocus name="PAYSTACK_SECRET_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.PayStackSecretKey') }}"/>
				                    <br>
				                  </div>


		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.PayStackPaymentUrl') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_PAYMENT_URL'] }}" autofocus name="PAYSTACK_PAYMENT_URL" type="text" class="form-control" placeholder="{{ __('adminstaticword.PayStackPaymentUrl') }}"/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.use') }} <b>https://api.paystack.co</b> </small>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PayStackMerchantEmail') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_MERCHANT_EMAIL'] }}" autofocus name="PAYSTACK_MERCHANT_EMAIL" type="text" class="form-control" placeholder="{{ __('adminstaticword.PayStackMerchantEmail') }}"/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.use') }} <b>{{ __('dashboard.paystack_email') }}</b> </small>
				                    <br>
				                    <br>

				                  </div>



				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PaystackCallbackURL') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ url('callback') }}" autofocus type="text" class="form-control" placeholder="{{ __('adminstaticword.PaystackCallbackURL') }}" disabled/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.use') }} <b>{{ __('dashboard.this_callback_url_in_paystack_account') }}</b> </small>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row hidden">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.PAYTMPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="paytm_sec1" type="checkbox" name="paytm_check" {{ $gsetting->paytm_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="paytm_sec1"></label>
		                        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->paytm_enable==1 ? '' : 'display:none' }}" id="paytm_sec">

		                          <div class="col-md-6">
		                          	<div class="form-group">
					                    <label for="PAYTM_ENVIRONMENT">{{ __('adminstaticword.PaytmEnviroment') }}<sup class="redstar">*</sup></label>
					                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('dashboard.for_param_use', ['param'=>'Test']) }} <b>"local"</b> {{ __('dashboard.and').' '.__('dashboard.for_param_use', ['param'=>'Live']) }} <b>"production"</b></small>
					                    <input value="{{ $env_files['PAYTM_ENVIRONMENT'] }}" autofocus name="PAYTM_ENVIRONMENT" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmEnviroment') }}"/>

				                    </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_ID">{{ __('adminstaticword.PaytmMerchantID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_ID'] }}" autofocus name="PAYTM_MERCHANT_ID" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmMerchantID') }}"/>

					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_KEY">{{ __('adminstaticword.PaytmMerchantKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_KEY'] }}" autofocus name="PAYTM_MERCHANT_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmMerchantKey') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_WEBSITE">{{ __('adminstaticword.PaytmMerchantWebsite') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_WEBSITE'] }}" autofocus name="PAYTM_MERCHANT_WEBSITE" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmMerchantWebsite') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_CHANNEL">{{ __('adminstaticword.PaytmChannel') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_CHANNEL'] }}" autofocus name="PAYTM_CHANNEL" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmChannel') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_INDUSTRY_TYPE">{{ __('adminstaticword.PaytmIndustryType') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_INDUSTRY_TYPE'] }}" autofocus name="PAYTM_INDUSTRY_TYPE" type="text" class="form-control" placeholder="{{ __('adminstaticword.PaytmIndustryType') }}"/>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.ReCaptcha') }}</label>
		                        <li class="tg-list-item">
						            <input class="tgl tgl-skewed" id="captcha_sec1" type="checkbox" name="captcha_check" {{ $gsetting->captcha_enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="captcha_sec1"></label>
						        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->captcha_enable==1 ? '' : 'display:none' }}" id="captcha_sec">

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_CHANNEL">{{ __('adminstaticword.CaptchaSiteKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['NOCAPTCHA_SITEKEY'] }}" autofocus name="NOCAPTCHA_SITEKEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.CaptchaSiteKey') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_INDUSTRY_TYPE">{{ __('adminstaticword.CaptchaSecretKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['NOCAPTCHA_SECRET'] }}" autofocus name="NOCAPTCHA_SECRET" type="text" class="form-control" placeholder="{{ __('adminstaticword.CaptchaSecretKey') }}"/>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row hidden">
							<div class="col-md-12">
		                        <label for="aws_enable">{{ __('adminstaticword.AWSSettings') }}</label>
		                        <li class="tg-list-item">
						            <input class="tgl tgl-skewed" id="aws_sec1" type="checkbox" name="aws_check" {{ $gsetting->aws_enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="aws_sec1"></label>
						        </li>


		                        <br>
		                        <div class="row" style="{{ $gsetting->aws_enable==1 ? '' : 'display:none' }}" id="aws_sec">

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_ACCESS_KEY_ID">{{ __('adminstaticword.AWSAccessKeyID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_ACCESS_KEY_ID'] }}" autofocus name="AWS_ACCESS_KEY_ID" type="text" class="form-control" placeholder="{{ __('adminstaticword.AWSAccessKeyID') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_SECRET_ACCESS_KEY">{{ __('adminstaticword.AWSSecretAccessKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_SECRET_ACCESS_KEY'] }}" autofocus name="AWS_SECRET_ACCESS_KEY" type="text" class="form-control" placeholder="{{ __('adminstaticword.AWSSecretAccessKey') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_DEFAULT_REGION">{{ __('adminstaticword.AWSDefaultRegion') }}<sup class="redstar">*</sup></label>
					                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="eg:ap-south-1"></i>
					                    <input value="{{ $env_files['AWS_DEFAULT_REGION'] }}" autofocus name="AWS_DEFAULT_REGION" type="text" class="form-control" placeholder="{{ __('adminstaticword.AWSDefaultRegion') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_BUCKET">{{ __('adminstaticword.AWSBucketName') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_BUCKET'] }}" autofocus name="AWS_BUCKET" type="text" class="form-control" placeholder="{{ __('adminstaticword.AWSBucketName') }}"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_URL">{{ __('adminstaticword.AWSURL') }}<sup class="redstar">*</sup></label>
					                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="eg:https://bucket-name.s3.Region.amazonaws.com/"></i>
					                    <input value="{{ $env_files['AWS_URL'] }}" autofocus name="AWS_URL" type="text" class="form-control" placeholder="{{ __('adminstaticword.AWSURL') }}"/>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
    </div>
</section>
@endsection



@section('script')

<script>
(function($) {
  "use strict";

  $(function(){

      $('#s_sec1').change(function(){
        if($('#s_sec1').is(':checked')){
        	$('#s_sec').show('fast');
        }else{
        	$('#s_sec').hide('fast');
        }

      });
      $('#pay_sec1').change(function(){
        if($('#pay_sec1').is(':checked')){
        	$('#pay_sec').show('fast');
        }else{
        	$('#pay_sec').hide('fast');
        }

      });
      $('#payu_sec1').change(function(){
        if($('#payu_sec1').is(':checked')){
        	$('#payu_sec').show('fast');
        }else{
        	$('#payu_sec').hide('fast');
        }

      });
      $('#insta_sec1').change(function(){
        if($('#insta_sec1').is(':checked')){
        	$('#insta_sec').show('fast');
        }else{
        	$('#insta_sec').hide('fast');
        }

      });

      $('#brain_sec1').change(function(){
        if($('#brain_sec1').is(':checked')){
        	$('#brain_sec').show('fast');
        }else{
        	$('#brain_sec').hide('fast');
        }

      });

      $('#razor_sec1').change(function(){
        if($('#razor_sec1').is(':checked')){
        	$('#razor_sec').show('fast');
        }else{
        	$('#razor_sec').hide('fast');
        }

      });

      $('#paystack_sec1').change(function(){
        if($('#paystack_sec1').is(':checked')){
        	$('#paystack_sec').show('fast');
        }else{
        	$('#paystack_sec').hide('fast');
        }

      });

      $('#paytm_sec1').change(function(){
        if($('#paytm_sec1').is(':checked')){
        	$('#paytm_sec').show('fast');
        }else{
        	$('#paytm_sec').hide('fast');
        }

      });

      $('#captcha_sec1').change(function(){
        if($('#captcha_sec1').is(':checked')){
        	$('#captcha_sec').show('fast');
        }else{
        	$('#captcha_sec').hide('fast');
        }

      });

      $('#aws_sec1').change(function(){
        if($('#aws_sec1').is(':checked')){
        	$('#aws_sec').show('fast');
        }else{
        	$('#aws_sec').hide('fast');
        }

      });

      $('#vapulus_sec1').change(function(){
        if($('#vapulus_sec1').is(':checked')){
        	$('#vapulus_sec').show('fast');
        }else{
        	$('#vapulus_sec').hide('fast');
        }

      });
  });

})(jQuery);

</script>

@endsection


