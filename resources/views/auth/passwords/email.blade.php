@extends('frontend.layouts.layout')
@section('title', __('frontend.forget_password'))

@section('pageContent')
<section class="sign-up">
    <div class="container-fluid">
        <div class="row align-items-center">
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
                    <div class="title__form mb-4">
                        <a href="javascript:;" class="logo"><img src="/frontAssets/images/lostpass.svg" alt="" title="">
                        </a>
                        <h3> {{ __('frontend.lost_your_password') }}<br />
                            {{ __('frontend.enter_your_details_to_recover') }}</h3>
                        <h6>{{ __('frontend.enter_your_details_to_proceed_further') }}</h6>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 fild">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="text" placeholder="{{ __('frontend.enter_your_email') }}" autocomplete="off" autofocus required>
                                <label class="floating-label">{{ __('frontstaticword.email') }}</label>
                                @if($errors->has('email'))
                                <span class="error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-12 fild text-center">
                                <!-- <button class="bottom" type="submit">{{ __('Submit') }}</button> -->
                                <button class="bottom" type="submit">{{ __('frontend.recover') }}</button>

                            </div>
                        </div>
                    </form>
                </div>

                @if (session('status'))
                <h2 class="title sacand">{{ session('status') }}</h2>
                <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('passwords.sentDetails') }} <a href='/password/reset'>{{ __('passwords.ResendRequest') }}</a></p>

                @endif



            </div>
        </div>
    </div>
</section>
@endsection
