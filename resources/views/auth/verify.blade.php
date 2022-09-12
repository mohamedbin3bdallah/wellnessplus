@extends('frontend.layouts.layout')

@section('title', __('frontend.verify_email'))
@include('theme.head')
@section('Verify Email', 'Sign Up')

@include('admin.message')

<!-- end head -->
<!-- body start-->

<body>
    <!-- top-nav bar start-->
    <!-- <section id="nav-bar" class="nav-bar-main-block nav-bar-main-block-one">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    <div class="logo text-center btm-10">
                        @php
                        $logo = App\Setting::first();
                        @endphp

                        @if($logo->logo_type == 'L')
                        <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid" alt="logo"></a>
                        @else()
                        <a href="{{ url('/') }}"><b>
                                <div class="logotext">{{ $logo->project_title }}</div>
                            </b></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="Login-btn txt-rgt">
                        <a href="{{ route('logout') }}" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                            {{ __('frontstaticword.Logout') }}

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                @csrf
                            </form>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- top-nav bar end-->
    <section id="signup" class=" signup-block-main-block sign-up">
        <div class="container-fluid">
            <div class="row align-items-center">
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
                            <a href="javascript:;" class="logo"><img src="/frontAssets/images/thanku.svg" alt="" title="">
                            </a>
                            <h3 class="mb-2"> {{ __('frontend.thank_you') }}</h3>
                            <h6>{{ __('frontend.verify_text_6') }} <span style=" color:#000">{{ auth()->user()->email }}</span><br />
                                {{ __('frontend.verify_text_7') }}</h6>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12 fild text-center">
                                    <!-- <button class="bottom" type="submit">{{ __('Submit') }}</button> -->
                                    <!--<button class="bottom" type="submit">Open Email & confirm</button>-->
									<p>{{ __('frontend.verify_text_8') }}</p>
									
									@if (session('resent'))
										<div class="alert alert-success" role="alert">
											{{ __('frontend.verify_text_2') }}
										</div>
									@endif

									{{ __('frontend.verify_text_3') }}
									{{ __('frontend.verify_text_4') }} <a href="{{ route('verification.resend') }}">{{ __('frontend.verify_text_5') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
            <!-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div> -->
        </div>
    </section>

    @include('theme.scripts')
    <!-- end jquery -->
</body>
<!-- body end -->

</html>
