@extends('frontend.layouts.layout')
@section('title', __('frontend.login'))

@section('pageContent')
<section class="sign-up">
    @include('admin.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 coverform">
                <div class="cover-form-part">
                    <img src="/frontAssets/images/cover-forms.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
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
                                {{ __('frontend.dont_have_an_account_register_ss') }}

                            </p>

                            <div class="bottoms">
                                <a href="{{ url('/register') }}" class="btn bottom btn-green"> {{ __('frontend.student') }}</a>
                                <a href="{{ url('/registration') }}" class="btn bottom btn-blue"> {{ __('frontend.tutor') }}</a>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-sm-6 item">
                <div class="wrapper-inputs">
                    <!-- <h1 class="title">{{ __('frontend.login') }}</h1> -->
                    <div class="title__form mb-4">
                        <a href="javascript:;" class="logo"><img src="/frontAssets/images/logo.svg" alt="" title="">
                        </a>
                        <h2> {{ __('frontend.sign_in_to_your_account') }} </h2>
                        <h6>{{ __('frontend.enter_your_details_to_proceed_further') }}</h6>
                    </div>
                    <form method="POST" class="signup-form" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 fild">
                                <input class="form-control" type="text" name="email" placeholder="{{ __('frontend.enter_your_email') }}" autocomplete="off" value="{{ old('email') }}" autocomplete="off" autofocus required>
                                <label class="floating-label">{{ __('frontstaticword.email') }}</label>
                                @if($errors->has('email'))
                                <span class="error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-12 fild"><i class="fas fa-eye-slash icon-pass"></i><i class="fas fa-eye icon-pass"></i>
                                <input class="form-control pass" type="password" name="password" placeholder="{{ __('frontend.enter_your_password') }}" autocomplete="off" required>
                                <label class="floating-label">{{ __('frontstaticword.Password') }}</label>
                                @if ($errors->has('password'))
                                <span class="error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-12 fild line-pass">
                                <label class="che-box">
                                    <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontstaticword.RememberMe') }}</span>
                                </label>
                                <!-- <a class="forget" href="{{ '/password/reset' }}">{{ __('frontstaticword.ForgotPassword') }} ? </a> -->
                                <a class="forget" href="{{ '/password/reset' }}"> {{ __('frontend.forget_password') }} </a>
                            </div>
                            <div class="col-sm-12 fild text-center">
                                <!-- <button class="bottom" type="submit">{{ __('frontstaticword.Login') }}</button> -->
                                <button class="bottom" type="submit">{{ __('frontend.login') }}</button>

                                <p class="text"><span> {{ __('frontend.or') }} </span> </p>
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

            {{-- <div class="fild text-center">--}}
            {{-- <p class="text ithave"><a href="/register" style="text-decoration: underline">Signup as student </a> OR <a--}}
            {{-- href="/registration" style="text-decoration: underline">Signup as Tutor</a></p>--}}
            {{-- <a class="bottom" href="/login">{{ __('frontstaticword.Login') }}</a>--}}
            {{-- </div>--}}
        </div>
    </div>
    </div>
</section>
@endsection
