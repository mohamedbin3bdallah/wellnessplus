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
	
	.select2-selection--multiple{
		overflow: hidden !important;
		height: auto !important;
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
                    <form action="{{ route('therapist-register-Step-1') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 fild">
                                <input class="form-control" name="email" value="{{ old('email') }}" type="text" placeholder="{{ __('frontend.enter_your_email') }}" autocomplete="off" autofocus required>
                                <label class="floating-label">{{ __('frontstaticword.Email') }}</label>

                                @error('email')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            @php
								$categories = App\Categories::where(['status'=>1])->get();
							@endphp
							<div class="col-sm-12 fild">
								<select class="form-control required select2" name="categories[]" autocomplete="off" autofocus required multiple="multiple">
									@foreach($categories as $category)
										<optgroup label="{{ $category->title }}">
											@foreach($category->subcategory->where('status', 1) as $subcategory)
												<option value="{{ $subcategory->id }}" @if(collect(old('categories'))->contains($subcategory->id)) {{ 'selected' }} @endif>{{ $subcategory->title }}</option>
											@endforeach
										</optgroup>
									@endforeach
								</select>
								<label class="floating-label">{{ __('frontstaticword.speciality') }}</label>
								@if($errors->has('categories'))
									<div class="error">
										{{ $errors->first('categories') }}
									</div>
								@endif
							</div>

                            <div class="col-sm-12 fild">
                                <input class="form-control" type="text" name="mobile" placeholder="{{ __('frontend.enter_your_mobile') }}" autocomplete="off" value="{{ old('mobile') }}" required>
                                <label class="floating-label"> {{ __('frontstaticword.mobile') }}</label>

                                @if($errors->has('mobile'))
                                <span class="error">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif


                            </div>
                            <div class="col-sm-12 fild"><i class="fas fa-eye-slash icon-pass"></i><i class="fas fa-eye icon-pass"></i>
                                <input class="form-control pass" name="password" value="{{ old('password') }}" type="password" placeholder="{{ __('frontend.enter_a_password') }}" autocomplete="off" autofocus required>
                                <label class="floating-label">{{ __('frontstaticword.Password') }}</label>
                                @if($errors->has('password'))
                                <div class="error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @enderror
                            </div>
                            
							<input hidden class="form-control pass" name="type" value="tutor" type="text" placeholder="" autocomplete="off" autofocus>

                            <!--<div class="col-sm-12 fild">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree" id="flexCheckDefault" @if(old('agree') == 'on') {{ 'checked' }} @endif>

                                    <label class="form-check-label text" for="flexCheckDefault">
                                        I Agree <a href="/privacy_policy" target="_blank">Privacy Policy</a>. And <a href="/terms_condition" target="_blank"> Terms Of Conditions</a>.
                                    </label>
									
									@if($errors->has('agree'))
										<span class="error">
											<strong>{{ $errors->first('agree') }}</strong>
										</span>
									@endif
                                </div>

                            </div>-->
                            <div class="col-sm-12 fild text-center">
                                <!-- <button class="bottom" type="submit">{{ __('frontstaticword.Signup') }}</button> -->
                                <button class="bottom" type="submit"> {{ __('frontend.next') }} </button>
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
        $(".select2").select2();
    })(jQuery);
</script>
<!--<script>
  $("form").submit(function(){
	  $(".waiting").text("{{ __('frontstaticword.pleasewaituntilregister') }}");
	  $(".bottom").prop('disabled',true);
  });
</script>-->

@endsection
