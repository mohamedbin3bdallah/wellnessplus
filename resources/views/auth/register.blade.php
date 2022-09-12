@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.SignUpAsStudent'))

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
        <div class="row">
            <div class="col-sm-6 coverform">
                <div class="cover-form-part">
                    <img src="/frontAssets/images/cover-patient.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
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
                                <a href="{{ url('/login') }}" class="btn bottom btn-green"> {{ __('frontend.login') }}</a>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-sm-6 item">
                <div class="wrapper-inputs">
                    <div class="title__form mb-4">
                        <a href="javascript:;" class="logo"><img src="/frontAssets/images/logo.svg" alt="" title="">
                        </a>
                        <h2> {{ __('frontstaticword.SignUpAsStudent') }} </h2>
                        <h6>{{ __('frontend.enter_your_details_to_proceed_further') }}</h6>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6 fild">
                                <input class="form-control" type="text" name="fname" placeholder="{{ __('frontend.enter_your_fname') }}" autocomplete="off" value="{{ old('fname') }}">
                                <label class="floating-label"> {{ __('frontstaticword.fname') }}</label>


                                @if ($errors->has('fname'))

                                <span class="error">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-6 fild">
                                <input class="form-control" type="text" name="lname" placeholder="{{ __('frontend.enter_your_lname') }}" autocomplete="off" value="{{ old('lname') }}">
                                <label class="floating-label">{{ __('frontstaticword.lname') }}</label>

                                @if($errors->has('lname'))
                                <span class="error">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="col-sm-12 fild">
                                <input class="form-control" type="text" name="email" placeholder="{{ __('frontend.enter_your_email') }}" autocomplete="off" value="{{ old('email') }}">
                                <label class="floating-label"> {{ __('frontstaticword.email') }}</label>

                                @if($errors->has('email'))
                                <span class="error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif


                            </div>

                           
                            <?php $countries = \App\Allcountry::all();
                            $countries = \App\Country::all();
                             ?>
                            <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                <select class="form-control required select2 country_id" name="country_id" autocomplete="off" autofocus>
                                    <option> </option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}" data-phonecode="{{$country->phonecode}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <label class="floating-label">{{ __('frontstaticword.CountryOfOrigin') }}</label>
                                @if($errors->has('country_id'))
                                <span class="error">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-12 fild">
                                <div class="col-sm-3" style="float: left;">
                                    <input class="form-control code" type="number" name="code" placeholder="" autocomplete="off" value="{{ old('code') }}" readonly>
                                </div>
                                <div class="col-sm-9" style="float: left;">
                                     <input class="form-control" type="number" name="mobile" placeholder="{{ __('frontend.enter_your_mobile') }}" autocomplete="off" value="{{ old('mobile') }}">
                                <label class="floating-label"> {{ __('frontstaticword.mobile') }}</label>
                                </div>
                                @if($errors->has('mobile'))
                                <span class="error">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif


                            </div>

                            <div class="col-sm-12 fild"><i class="fas fa-eye-slash icon-pass"></i><i class="fas fa-eye icon-pass"></i>
                                <input class="form-control pass" type="password" name="password" placeholder="{{ __('frontend.enter_a_password') }}" autocomplete="off" autofocus>
                                <label class="floating-label"> {{ __('frontstaticword.password') }}</label>

                                @if ($errors->has('password'))
                                <span class="error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-12 fild"><i class="fas fa-eye-slash icon-pass"></i><i class="fas fa-eye icon-pass"></i>
                                <input class="form-control pass" type="password" name="password_confirmation" placeholder="{{ __('frontend.enter_confirm_password') }}" autocomplete="off" autofocus>
                                <label class="floating-label"> {{ __('frontstaticword.passwordConfirmation') }}</label>

                                @if ($errors->has('password_confirmation'))
                                <span class="error">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>

                            <input hidden class="form-control pass" name="type" value="student" type="text" placeholder="" autocomplete="off" autofocus>


                            {{--<div class="col-sm-12 fild">--}}
                            {{--<label class="che-box">--}}
                            {{--<input type="checkbox" name="checkbox"><span--}}
                            {{--class="label-text">{{ __('frontstaticword.rememberMe') }}</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}

                            @if($gsetting->captcha_enable == 1)
                            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                            </div>
                            @endif


                            <div class="col-sm-12 fild">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                    <label class="form-check-label text" for="flexCheckDefault">
                                        {{ __('frontend.i_agree') }} <a href="/privacy_policy" target="_blank">{{ __('frontend.privacy_policy') }}</a>. {{ __('frontend.and') }} <a href="/terms_condition" target="_blank"> {{ __('frontend.terms_and_conditions') }}</a>.
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 fild text-center">
                                <div class="waiting" style="color:red;"></div>
                                <!-- <button class="bottom" type="submit">{{ __('frontstaticword.Signup') }}</button> -->
                                <button class="bottom" type="submit">{{ __('frontend.register') }}</button>

                                <p class="text">{{ __('frontend.or') }}</p>
                                <nav class="social">

                                    @if($gsetting->google_login_enable == 1)
                                    <a href="{{ url('/auth/google/login') }}" title="google" class="" title="google">
                                        <img src="/frontAssets/images/google.png" alt="" title=""> {{ __('frontend.sign_in_with_param', ['param'=>'Google']) }}
                                    </a>
                                    @endif
                                    @if($gsetting->fb_login_enable == 1)
                                    <a href="{{ url('/auth/facebook/login') }}" title="Apple" class="" title="Apple"><img src="/frontAssets/images/icon-apple.svg" alt="" title=""> {{ __('frontend.sign_in_with_param', ['param'=>'Apple']) }}
                                    </a>
                                    @endif
                                </nav>

                                {{--@if($gsetting->amazon_enable == 1)--}}
                                {{--<div class="signin-link amazon-button">--}}
                                {{--<a href="{{ url('/auth/amazon') }}" target="_blank" title="amazon"--}}
                                {{--class="btn btn-info btm-10" title="Amazon"><i--}}
                                {{--class="fab fa-amazon"></i>{{ __('frontstaticword.ContinuewithAmazon') }}--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--@endif--}}

                                {{--@if($gsetting->linkedin_enable == 1)--}}
                                {{--<div class="signin-link linkedin-button">--}}
                                {{--<a href="{{ url('/auth/linkedin') }}" target="_blank" title="linkedin"--}}
                                {{--class="btn btn-info btm-10" title="Linkedin"><i--}}
                                {{--class="fab fa-linkedin"></i>{{ __('frontstaticword.ContinuewithLinkedin') }}--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--@endif--}}

                                {{--@if($gsetting->twitter_enable == 1)--}}
                                {{--<div class="signin-link twitter-button">--}}
                                {{--<a href="{{ url('/auth/twitter') }}" target="_blank" title="twitter"--}}
                                {{--class="btn btn-info btm-10" title="Twitter"><i--}}
                                {{--class="fab fa-twitter"></i>{{ __('frontstaticword.ContinuewithTwitter') }}--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--@endif--}}

                                {{--@if($gsetting->gitlab_login_enable == 1)--}}
                                {{--<div class="signin-link btm-10">--}}
                                {{--<a href="{{ url('/auth/gitlab') }}" target="_blank" title="gitlab"--}}
                                {{--class="btn btn-white" title="gitlab"><i--}}
                                {{--class="fab fa-gitlab"></i>{{ __('frontstaticword.ContinuewithGitLab') }}--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--@endif--}}


                                </nav>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="col-sm-4 item offset-sm-1"><img src="/frontAssets/images/img-1.png" alt="Arabie"
                                                            title="Arabie">
                    <div class="fild text-center">
                        <p class="text ithave"><a href="/Login">{{ __('frontstaticword.alreadyHaveAccount') }}?</a></p><a class="bottom"
                                                                                              href="/login">{{ __('Login') }}</a>
                    </div>
                </div> -->
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
<script>
    (function($) {
        $("form").submit(function() {
            $(".waiting").text("{{ __('frontstaticword.pleasewaituntilregister') }}");
            $(".bottom").prop('disabled', true);
        });
    })(jQuery);
    $('.country_id').on('change',function(){
      
        var code=$(this).find(':selected').data('phonecode');
        $('.code').val(code)


    })
</script>

@endsection
