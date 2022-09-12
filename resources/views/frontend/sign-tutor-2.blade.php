@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.register_tutor'))

@section('pageContent')

<style>
    .select2-selection {
        height: 51px !important;
    }

    .select2-selection__rendered {
        padding: 9px;
    }
</style>

<section class="sign-up">
    <div class="container-fluid">
		@include('admin.message')
        <div class="row">
            <div class="col-sm-6">
                <div class="cover-form-part">
                    <img src="/frontAssets/images/cover-reg.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                    <div class="layout-cover">
                        <a href="{{ url('/') }}" class="bkhome d-inline-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="11.417" height="11.417" viewBox="0 0 11.417 11.417">
                                <g id="back-arrow" transform="translate(-0.001 -4)">
                                    <g id="Group_38125" data-name="Group 38125" transform="translate(0.001 4)">
                                        <path id="Path_38972" data-name="Path 38972" d="M4.492,2.457V.408A.408.408,0,0,0,3.781.135L.111,4.212a.408.408,0,0,0-.013.53l3.67,4.485a.408.408,0,0,0,.723-.257V6.939c3.221.1,5.231,1.482,6.137,4.2a.408.408,0,0,0,.387.278.4.4,0,0,0,.066-.005.408.408,0,0,0,.342-.4C11.423,6.208,8.533,2.68,4.492,2.457Z" transform="translate(-0.007 0)" fill="#fff" />
                                    </g>
                                </g>
                            </svg>
                            {{ __('frontend.back_to') }} {{ __('frontend.home') }}
                        </a>
                        <h1> {{ __('frontend.register_tutor_1') }} <br />
                            {{ __('frontend.register_tutor_2') }}<br />
                            {{ __('frontend.register_tutor_3') }}</h1>
                        <div class="reg d-flex justify-content-between align-items-center">
                            <p>
                                {{ __('frontstaticword.alreadyHaveAccount') }}

                            </p>

                            <div class="bottoms">
                                <a href="/login" class="btn bottom btn-green"> {{ __('frontstaticword.Login') }}</a>

                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <div class="col-sm-6 item">
                <div class="wrapper-inputs">
                    <!-- <h1 class="title">{{ __('frontstaticword.Login') }}</h1> -->
                    <div class="title__form mb-4">
                        <a href="javascript:;" class="logo"><img src="/frontAssets/images/logo.svg" alt="" title="">
                        </a>
                        <h2> {{ __('frontstaticword.register_tutor') }}</h2>
                        <h6 style="text-align:justify;">{{ __('frontend.register_tutor_4') }}</h6>
                    </div>
                    <form action="{{ route('therapist-register-Step-2') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 fild">
								<input class="form-control" name="national_id_name" value="{{ old('national_id_name') }}" type="text" placeholder="{{ __('frontstaticword.national_id_name') }}" autocomplete="off" autofocus required>
								<label class="floating-label">{{ __('frontstaticword.national_id_name') }}</label>
								@if($errors->has('national_id_name'))
									<div class="error">
										{{ $errors->first('national_id_name') }}
									</div>
								@endif
							</div>
						
							<div class="col-sm-12 fild">
								<input class="form-control" id="national_id_image" name="national_id_image" type="file" required />
								<label class="floating-label">{{ __('frontstaticword.national_id_image') }} *</label>
								@if($errors->has('national_id_image'))
									<div class="error">
										{{ $errors->first('national_id_image') }}
									</div>
								@endif
								<div class="row" style="display: none;" id="previewHolderDiv">
									<img class="img_prev" src="" id="previewHolder" style="width: 30%;">
								</div>
							</div>
							
							<div class="col-sm-12 fild">
								<input class="form-control" name="address" value="{{ old('address') }}" type="text" placeholder="{{ __('frontstaticword.address') }}" autocomplete="off" autofocus required>
								<label class="floating-label">{{ __('frontstaticword.address') }}</label>
								@if($errors->has('address'))
									<div class="error">
										{{ $errors->first('address') }}
									</div>
								@endif
							</div>
							
							<div class="col-sm-12 fild">
								<input class="form-control" name="user_img" id="user_img" type="file" required />
								<label class="floating-label">{{ __('frontstaticword.profileImage') }} *</label>
								@if($errors->has('user_img'))
									<div class="error">
										{{ $errors->first('user_img') }}
									</div>
								@endif
								<div class="row" style="display: none;" id="previewHolde2rDiv">
									<img class="img_prev" src="" id="previewHolder2" style="width: 30%;">
								</div>
							</div>
						
							<div class="col-sm-12 fild">
								<select class="form-control select2" name="work_other_platform" autocomplete="off" autofocus required>
									<option value="1" @if(old('work_other_platform') == 1) {{ 'selected' }} @endif>{{ __('frontstaticword.yes') }}</option>
									<option value="0" @if(old('work_other_platform') == 0) {{ 'selected' }} @endif>{{ __('frontstaticword.no') }}</option>
								</select>
								<label class="floating-label">{{ __('frontstaticword.work_with_other_platform') }}</label>
								@if($errors->has('work_other_platform'))
									<div class="error">
										{{ $errors->first('work_other_platform') }}
									</div>
								@endif
							</div>
							{{-- <div class="col-sm-12 fild">
								@php
									$yesno = ['Yes', 'No'];
								@endphp
								<label class="">{{ __('frontstaticword.do_you_work_in_a_hospital') }}</label>
								<div class="row">
								@foreach($yesno as $hear)
									<div class="col-sm-4">
										<input type="radio" class="hear" id="{{ $hear }}" class="" name="work_hospital" value="{{ $hear }}" @if(old('work_hospital') == $hear) {{ 'checked' }} @endif>
										<label for="{{ $hear }}">{{ $hear }}</label>
									</div>
								@endforeach
								</div>
								
								@if($errors->has('work_hospital'))
									<div class="error">
										{{ $errors->first('work_hospital') }}
									</div>
								@endif
								
							</div> --}}
						{{-- 	<div class="col-sm-12 fild">
								@php
									$yesno = ['Yes', 'No'];
								@endphp
								<label class="">{{ __('frontstaticword.do_you_work_in_a_center') }}</label>
								<div class="row">
								@foreach($yesno as $hear)
									<div class="col-sm-4">
										<input type="radio" class="hear" id="work_center_{{ $hear }}" class="" name="work_center" value="{{ $hear }}" @if(old('work_center') == $hear) {{ 'checked' }} @endif>
										<label for="work_center_{{ $hear }}">{{ $hear }}</label>
									</div>
								@endforeach
								</div>
								
								@if($errors->has('work_hospital'))
									<div class="error">
										{{ $errors->first('work_hospital') }}
									</div>
								@endif
								
							</div> --}}
							{{-- <div class="col-sm-12 fild">
								@php
									$yesno = ['Yes', 'No'];
								@endphp
								<label class="">{{ __('frontstaticword.do_you_work_in_a_sanatorium') }}</label>
								<div class="row">
								@foreach($yesno as $hear)
									<div class="col-sm-4">
										<input type="radio" class="hear" id="work_sanatorium_{{ $hear }}" class="" name="work_sanatorium" value="{{ $hear }}" @if(old('work_sanatorium') == $hear) {{ 'checked' }} @endif>
										<label for="work_sanatorium_{{ $hear }}">{{ $hear }}</label>
									</div>
								@endforeach
								</div>
								
								@if($errors->has('work_sanatorium'))
									<div class="error">
										{{ $errors->first('work_sanatorium') }}
									</div>
								@endif
								
							</div> --}}
							<div class="col-sm-12 fild">
								@php
									$hears = ['Friends', 'Social Networks', 'Direct'];
								@endphp
								<label class="">{{ __('frontstaticword.hear_about_via') }}</label>
								<div class="row">
								@foreach($hears as $hear)
									<div class="col-sm-4">
										<input type="radio" class="hear" id="{{ $hear }}" class="" name="hear_about" value="{{ $hear }}" @if(old('hear_about') == $hear) {{ 'checked' }} @endif>
										<label for="{{ $hear }}">{{ $hear }}</label>
									</div>
								@endforeach
								</div>
								<div class="row">
									<div class="col-sm-4">
										<input type="radio" class="hear" id="other" class="" name="hear_about" value="other" @if(old('hear_about') == 'other') {{ 'checked' }} @endif>
										<label for="other">{{ __('frontstaticword.other') }}</label>
									</div>
									<div class="col-sm-8">
										<input class="form-control" id="hear_about_other" name="hear_about_other" value="{{ old('hear_about_other') }}" type="text" placeholder="{{ __('frontstaticword.other') }}" autocomplete="off" autofocus required>
									</div>
								</div>
								@if($errors->has('hear_about'))
									<div class="error">
										{{ $errors->first('hear_about') }}
									</div>
								@endif
								@if($errors->has('hear_about_other'))
									<div class="error">
										{{ $errors->first('hear_about_other') }}
									</div>
								@endif
							</div>
							
							<input hidden class="form-control pass" name="type" value="tutor" type="text" placeholder="" autocomplete="off" autofocus>
							
                            <div class="col-sm-12 fild text-center">
								<div class="waiting" style="color:green;"></div>
                                <!-- <button class="bottom" type="submit">{{ __('frontstaticword.Signup') }}</button> -->
                                <button class="bottom" type="submit"> {{ __('frontend.register') }} </button>
                                <p class="text">{{ __('frontend.or') }} </p>
                                <nav class="social">


                                    @if($gsetting->google_login_enable == 1)
                                    <a href="{{ url('/auth/google/login') }}" title="google" class="" title="google">
                                        <img src="/frontAssets/images/google.png" alt="" title=""> {{ __('frontend.sign_in_with_param', ['param'=>'Google']) }}
                                    </a>
                                    @endif
                                    @if($gsetting->fb_login_enable == 1)
                                    <a href="{{ url('/auth/facebook/login') }}" title="Apple" class="" title="Apple"><img src="/frontAssets/images/icon-apple.svg" alt="" title=""> {{ __('frontend.sign_in_with_param', ['param'=>'Apple']) }}
                                    </a>
                                </nav>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    (function($) {
        $(".select2").select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});
		
		 $("form").submit(function() {
            $(".waiting").text("{{ __('frontstaticword.pleasewaituntilregister') }}");
            $(".bottom").prop('disabled', true);
        });
		
		$('.hear').click(function() {
			if($('#other').is(':checked'))
			{
				$('#hear_about_other').removeAttr('disabled');
				$('#hear_about_other').removeAttr('readonly');
			}
			else
			{
				$('#hear_about_other').attr('disabled', 'true');
				$('#hear_about_other').attr('readonly', 'true');
			}
		});
		
		var hear_about = "{{ old('hear_about') }}";
		if(hear_about == 'other')
		{
			$('#hear_about_other').removeAttr('disabled');
			$('#hear_about_other').removeAttr('readonly');
		}
		else
		{
			$('#hear_about_other').attr('disabled', 'true');
			$('#hear_about_other').attr('readonly', 'true');
		}
    })(jQuery);
</script>

<!--<script>
  $("form").submit(function(){
	  $(".waiting").text("{{ __('frontstaticword.pleasewaituntilregister') }}");
	  $(".bottom").prop('disabled',true);
  });
</script>-->

@endsection
@push('special-scripts')
<script type="text/javascript">
      
	$(document).ready(function (e) {
	 
	   $('#national_id_image').change(function(){
		//debugger;

		let reader = new FileReader();
	 
		reader.onload = (e) => { 
			$('#previewHolderDiv').fadeIn(600)
				  $('#previewHolder').attr('src', e.target.result); 
	
		 // $('#preview-image-before-upload').attr('src', e.target.result); 
		}
	 
		reader.readAsDataURL(this.files[0]); 
	   
	   });
	   
	   
	   $('#user_img').change(function(){
				var imgSrc='';
				let reader2 = new FileReader();
			 
				reader2.onload = (e) => { 
					imgSrc=e.target.result;
					$('#previewHolder2Div').fadeIn(600)

				 $('#previewHolder2').attr('src', e.target.result); 
				}
			   // var item="<li><img src='"+imgSrc+"'  alt='preview image' style='max-height: 150px;'></li>";
						  //  $('#filesList').append(item);
				   // console.log("Src=>"+id);
				   
				reader2.readAsDataURL(this.files[0]); 
			   
			   });
	   
	});
	 
	</script>
@endpush
