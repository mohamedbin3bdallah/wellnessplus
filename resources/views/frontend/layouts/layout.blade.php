<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="wellness is a marketplace for arabic language for non natives, book online arabic courses with best arabic tutors worldwide and suitable price. Try It for free">
    <title>@if($gsetting and trim($gsetting->project_title) != '' and $gsetting->project_title != NULL) {{ $gsetting->project_title }} @endif @if(Request::is('/')) {{ ' ' }} @else @yield('title') @endif </title>
    <link rel="shortcut icon" href="{{ asset('images/logo/'.$gsetting->logo) }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/'.$gsetting->logo) }}">
    <!-- Styles -->

    <!-- Google Tag Manager head -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T79JS82');
    </script>
    <!-- End Google Tag Manager -->

    <style>
        .error {
            color: red;
        }

        .unread_notification {
            background: #f0ecec9a !important;
        }
    </style>
    <!-- include header file -->
    @include('frontend.layouts.head')
    @yield('headerAssets')

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '438607774183219');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=438607774183219&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=438607774183219&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Ads: 437506638 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-437506638"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-437506638');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3TSMNYBXBV">
        < script >
            window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-3TSMNYBXBV');
    </script>

    <!-- ManyChat -->
    <script src="//widget.manychat.com/114238373695322.js" async="async"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="/frontAssets/css/checkbox.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                @if($gsetting->logo_type == 'L')
                <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$gsetting->logo) }}" alt="wellness" title="wellness"></a>
                @else()
                <a href="{{ url('/') }}"><b>
                        <div class="logotext">{{ $gsetting->project_title }}</div>
                    </b></a>
                @endif
            </div>

            <nav class="setting-menu">
                <a href="/">{{ __('frontstaticword.home') }}</a>
                {{-- <a href="/about">About Us</a> --}}
                <!-- <a href="/find/tutor">{{ __('frontstaticword.FindATutor') }}</a> -->

                <a href="/registration">{{ __('frontstaticword.SignUpAsTutor') }}</a>
            </nav>
            <!--Shimaa-->
            <form class="formsearch" action="#" method="">
                {{-- <input class="form-control" type="text" placeholder="Search for courses ?">--}}
                {{-- <button class="btn" type="submit">--}}
                {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                {{-- width="25.427" height="27.094" viewBox="0 0 25.427 27.094">--}}
                {{-- <path--}}
                {{-- d="M403.084,301.3l-6.278-6.529a10.691,10.691,0,1,0-2.051,1.875l6.328,6.581a1.386,1.386,0,0,0,1.963.039,1.39,1.39,0,0,0,.038-1.965Zm-14.433-21.251a7.873,7.873,0,1,1-7.872,7.872,7.883,7.883,0,0,1,7.872-7.872Zm0,0"--}}
                {{-- --}}{{-- transform="translate(-378 -277.112)"></path>--}}
                {{-- </svg>--}}
                {{-- </button>--}}
            </form>
            <!--Shimaa-->
            <div class="detals">
                <div class="icons"><span class="icon-search">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25.427" height="27.094" viewBox="0 0 25.427 27.094">
                            <path d="M403.084,301.3l-6.278-6.529a10.691,10.691,0,1,0-2.051,1.875l6.328,6.581a1.386,1.386,0,0,0,1.963.039,1.39,1.39,0,0,0,.038-1.965Zm-14.433-21.251a7.873,7.873,0,1,1-7.872,7.872,7.883,7.883,0,0,1,7.872-7.872Zm0,0" transform="translate(-378 -277.112)"></path>
                        </svg></span><span class="cancel"></span></div>
                <!--a(href="login.html" class="bottom") #[img(src='assets/images/user.png' alt="" title="")] Log in-->
                <!--shimaa-->
                @guest
                <div class="icons-signup"><span class="icon-opne-signup"> {{ __('frontend.sign_up') }}</span></div>
                <span class="signup-btns">
                    @if (Route::has('register'))
                    <a href="/register" style="color: #4D25B9;margin-right: 30px">{{ __('frontstaticword.SignUpAsStudent') }}</a>
                    @endif
                    @if (Route::has('registration'))
                    <a href="/registration" style="color: #4D25B9;margin-right: 30px">Register As Therapist</a>
                    @endif
                </span>
                <a class="bottom" href="/login"> {{ __('frontstaticword.Login') }}</a>
                @else
                <div class="icons-men"><span class="fas fa-bars icon-opne"></span><span class="icon-cancel"></span>
                </div>

                @if(Auth::check() && Auth::user()->role == 'user')
                <a class="balance disbox" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="25.788" height="30" viewBox="0 0 25.788 30">
                <path id="timer" d="M14.12,24.393A12.008,12.008,0,0,1,35.7,14.844a.442.442,0,0,0,.727-.5,12.9,12.9,0,0,0-2.945-3.031l1.277-2.223a.442.442,0,0,0-.163-.6L32.783,7.446a.442.442,0,0,0-.6.163L30.9,9.829A12.874,12.874,0,0,0,27.3,8.864V7.522h.9a.442.442,0,0,0,.442-.442V5a.442.442,0,0,0-.442-.442H23.432A.442.442,0,0,0,22.991,5V7.081a.442.442,0,0,0,.442.442h.9V8.87a12.786,12.786,0,0,0-3.609.958L19.442,7.61a.442.442,0,0,0-.6-.163L17.03,8.484a.442.442,0,0,0-.163.6l1.277,2.223A12.9,12.9,0,0,0,13.25,24.593a.442.442,0,0,0,.426.342.458.458,0,0,0,.1-.012.442.442,0,0,0,.344-.53ZM32.728,8.433l1.04.6-1.021,1.778c-.337-.213-.681-.417-1.037-.6ZM23.879,5.44h3.873v1.2H23.879Zm1.337,2.081h1.195V8.8c-.2-.01-.4-.019-.6-.019s-.4.006-.6.015ZM17.865,9.034l1.039-.6,1.02,1.777q-.532.276-1.038.6ZM38.7,21.673a12.889,12.889,0,0,1-22.958,8.039.442.442,0,0,1,.689-.552A12.009,12.009,0,0,0,36.683,16.554a.442.442,0,0,1,.794-.371A12.783,12.783,0,0,1,38.7,21.672ZM15.223,27.329a.442.442,0,1,1-.779.417c-.187-.35-.36-.712-.514-1.077a.442.442,0,0,1,.814-.343C14.888,26.665,15.049,27,15.223,27.329ZM34.452,16.611a.424.424,0,0,0-.026-.034,10.08,10.08,0,0,0-3.56-3.541.382.382,0,0,0-.038-.028l-.045-.02a9.973,9.973,0,0,0-9.985.027l-.045.02-.034.026a10.082,10.082,0,0,0-3.54,3.565.238.238,0,0,0-.047.082,9.974,9.974,0,0,0,.028,9.985.438.438,0,0,0,.02.045.236.236,0,0,0,.02.026,10.08,10.08,0,0,0,3.564,3.549.426.426,0,0,0,.038.028c.011.006.023.009.034.015a9.976,9.976,0,0,0,10.007-.029.073.073,0,0,0,.033-.014.376.376,0,0,0,.034-.026,10.082,10.082,0,0,0,3.548-3.57c.006-.01.015-.017.021-.028a.363.363,0,0,0,.02-.045,9.974,9.974,0,0,0-.028-9.985.407.407,0,0,0-.021-.049ZM30.8,29.309l-.567-.967a.442.442,0,0,0-.762.447l.568.969a9.061,9.061,0,0,1-3.786,1.03V29.661a.442.442,0,0,0-.883,0v1.127a9.058,9.058,0,0,1-3.739-1.008l.563-.972a.442.442,0,1,0-.765-.443l-.562.971a9.2,9.2,0,0,1-2.692-2.677l.968-.567a.442.442,0,0,0-.447-.762l-.969.568a9.061,9.061,0,0,1-1.03-3.786h1.127a.442.442,0,1,0,0-.883H16.7a9.061,9.061,0,0,1,1.008-3.74l.972.563a.442.442,0,0,0,.443-.765l-.971-.562a9.2,9.2,0,0,1,2.677-2.691L21.4,15a.442.442,0,0,0,.762-.447l-.568-.969a9.055,9.055,0,0,1,3.786-1.03v1.127a.442.442,0,0,0,.883,0V12.557A9.061,9.061,0,0,1,30,13.564l-.564.972a.442.442,0,1,0,.765.443l.562-.972a9.2,9.2,0,0,1,2.692,2.678l-.968.567a.442.442,0,0,0,.447.762l.97-.568a9.064,9.064,0,0,1,1.03,3.786H33.8a.442.442,0,0,0,0,.883h1.127a9.061,9.061,0,0,1-1.008,3.739l-.972-.563a.442.442,0,1,0-.443.765l.971.562A9.2,9.2,0,0,1,30.8,29.309Zm1.673-7.637a.442.442,0,0,0-.442-.442H27.779A2.022,2.022,0,0,0,26.253,19.7V15.449a.442.442,0,0,0-.883,0V19.7a2.022,2.022,0,1,0,2.409,2.409h4.256A.442.442,0,0,0,32.476,21.672Zm-6.66,1.134a1.134,1.134,0,1,1,1.134-1.134,1.134,1.134,0,0,1-1.134,1.134Z" transform="translate(-12.916 -4.557)" fill="#006b99"/>
                </svg>

                    <p>{{ __('frontend.balance') }} : <span>
                            {{$user_balance->balance}}
                        </span> {{ __('frontend.hours') }}</p>
                </a>
                @endif
                <!-- <a class="bottom hours" href="#">Buy Hours</a>  -->

                @endguest
                @php
                $languages = App\Language::all();
                @endphp

                {{-- <div class="dropdown"><a class="el-lang"><span> {{Session::has('changed_language') ? Session::get('changed_language') : 'en'}}</span>
                <span> , USD</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="7" viewBox="0 0 8 7">
                    <path d="M4,0,8,7H0Z" transform="translate(8 7) rotate(180)"></path>
                </svg></a>
                <div class="language">
                    <div class="fild"> <i class="fas fa-chevron-down iconsel"></i>
                        <select class="form-control required" id="site_lang" name="language" autocomplete="off" autofocus required>
                            @if (isset($languages) && count($languages) > 0)
                            @foreach ($languages as $language)
                            <option value="{{ $language->local }}" @if(session()->has('changed_language') && session('changed_language') == $language->local) {{ 'selected' }} @endif>{{$language->name}} ({{$language->local}})</option>
                            @endforeach
                            @endif
                        </select>
                        <label class="floating-label">language</label>
                    </div>
                    <div class="fild"> <i class="fas fa-chevron-down iconsel"></i>
                        <select class="form-control required" name="currency" autocomplete="off" autofocus required>
                            <option> </option>
                            <option>$</option>
                            <option>EGP</option>
                            <option>Currency</option>
                        </select>
                        <label class="floating-label">Currency</label>
                    </div>
                </div>
            </div>--}}


            <?php         /*  <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><span> {{Session::has('changed_language') ? Session::get('changed_language') : ''}}</span>
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="8" height="7" viewBox="0 0 8 7">
                                                     <path d="M4,0,8,7H0Z" transform="translate(8 7) rotate(180)"></path>
                                                     </svg>
                                                     </a>
                                                     <div class="dropdown-menu">
                                                     @if (isset($languages) && count($languages) > 0)
                                                     @foreach ($languages as $language)
                                                     <a class="dropdown-item" href="{{ route('languageSwitch', $language->local) }}">{{$language->name}}
                                         ({{$language->local}}) </a>
                                                     @endforeach
                                                     @endif
                                                     </div>
                                                     </div> */ ?>
            @guest
            @else
            <!--shimaa-->
            <nav class="user-det">
         <a href="#" class="chat-btn" id="read_notifications">
         <svg xmlns="http://www.w3.org/2000/svg" width="30.477" height="30" viewBox="0 0 30.477 30">
            <g id="conversation" transform="translate(0 -4.011)">
                <g id="Group_38637" data-name="Group 38637" transform="translate(0 4.011)">
                <g id="Group_38636" data-name="Group 38636" transform="translate(0 0)">
                    <path id="Path_39108" data-name="Path 39108" d="M30.367,27.692,28.6,22.541A12.887,12.887,0,0,0,17.24,4.013a12.873,12.873,0,0,0-13.081,12.7A9.38,9.38,0,0,0,1.311,28.242L.092,31.791a1.677,1.677,0,0,0,1.579,2.22,1.688,1.688,0,0,0,.549-.092L5.768,32.7a9.42,9.42,0,0,0,4.011.906h.015a9.367,9.367,0,0,0,7.574-3.851,12.914,12.914,0,0,0,5.319-1.3l5.152,1.77a2.006,2.006,0,0,0,.652.11,1.992,1.992,0,0,0,1.876-2.639Zm-20.574,4.1H9.782a7.587,7.587,0,0,1-3.524-.875.907.907,0,0,0-.719-.056L1.9,32.11l1.25-3.638a.907.907,0,0,0-.056-.719,7.564,7.564,0,0,1,1.233-8.769A12.923,12.923,0,0,0,15.1,29.614,7.544,7.544,0,0,1,9.794,31.791ZM28.61,28.464a.164.164,0,0,1-.182.042l-5.515-1.9a.907.907,0,0,0-.719.056,11.081,11.081,0,0,1-5.146,1.278h-.017A11.1,11.1,0,0,1,5.973,17.064,11.06,11.06,0,0,1,17.211,5.827a11.062,11.062,0,0,1,9.6,16.221.907.907,0,0,0-.056.719l1.9,5.515A.165.165,0,0,1,28.61,28.464Z" transform="translate(0 -4.011)" fill="#006b99"/>
                </g>
                </g>
                <g id="Group_38639" data-name="Group 38639" transform="translate(11.206 12.11)">
                <g id="Group_38638" data-name="Group 38638" transform="translate(0 0)">
                    <path id="Path_39109" data-name="Path 39109" d="M191.057,139.512H180.943a.849.849,0,0,0,0,1.7h10.114a.849.849,0,1,0,0-1.7Z" transform="translate(-180.094 -139.512)" fill="#006b99"/>
                </g>
                </g>
                <g id="Group_38641" data-name="Group 38641" transform="translate(11.206 15.856)">
                <g id="Group_38640" data-name="Group 38640">
                    <path id="Path_39110" data-name="Path 39110" d="M191.057,202.183H180.943a.849.849,0,0,0,0,1.7h10.114a.849.849,0,1,0,0-1.7Z" transform="translate(-180.094 -202.183)" fill="#006b99"/>
                </g>
                </g>
                <g id="Group_38643" data-name="Group 38643" transform="translate(10.985 19.602)">
                <g id="Group_38642" data-name="Group 38642" transform="translate(0 0)">
                    <path id="Path_39111" data-name="Path 39111" d="M187.163,264.852h-6.221a.849.849,0,1,0,0,1.7h6.221a.849.849,0,0,0,0-1.7Z" transform="translate(-180.093 -264.852)" fill="#006b99"/>
                </g>
                </g>
            </g>
            </svg>
                    @if(Auth::user()->notifications->whereNull('read_at')->count()) <span class="alarm" id="notifications_alarm">{{Auth::user()->notifications->whereNull('read_at')->count()}}</span>@endif
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25.4" height="30.4" viewBox="0 0 25.4 30.4">
                        <g id="Group_10" data-name="Group 10" transform="translate(0.2 0.2)">
                            <g id="bell">
                            <path id="Shape" d="M4.375,5.225A.625.625,0,0,1,3.75,4.6V2.5a1.25,1.25,0,0,0-2.5,0V4.6A.625.625,0,0,1,0,4.6V2.5a2.5,2.5,0,0,1,5,0V4.6a.624.624,0,0,1-.625.625Z" transform="translate(10)" fill="#006b99" stroke="#006b99" stroke-miterlimit="10" stroke-width="0.4"/>
                            <path id="Shape-2" data-name="Shape" d="M4.375,5A4.38,4.38,0,0,1,0,.625a.625.625,0,0,1,1.25,0,3.125,3.125,0,0,0,6.25,0,.625.625,0,1,1,1.25,0A4.38,4.38,0,0,1,4.375,5Z" transform="translate(8.125 25)" fill="#006b99" stroke="#006b99" stroke-miterlimit="10" stroke-width="0.4"/>
                            <path id="Shape-3" data-name="Shape" d="M23.125,22.5H1.875A1.875,1.875,0,0,1,.656,19.2,8.7,8.7,0,0,0,3.75,12.548V8.75a8.75,8.75,0,0,1,17.5,0v3.8a8.685,8.685,0,0,0,3.083,6.644A1.875,1.875,0,0,1,23.125,22.5ZM12.5,1.25A7.508,7.508,0,0,0,5,8.75v3.8a9.932,9.932,0,0,1-3.527,7.6.625.625,0,0,0,.4,1.1h21.25a.625.625,0,0,0,.407-1.1A9.94,9.94,0,0,1,20,12.548V8.75A7.508,7.508,0,0,0,12.5,1.25Z" transform="translate(0 3.75)" fill="#006b99" stroke="#006b99" stroke-miterlimit="10" stroke-width="0.4"/>
                            </g>
                        </g>
                    </svg>
                </a>

            <a href="#">
                    {{--// <svg id="question" xmlns="http://www.w3.org/2000/svg" width="22.133" height="22.133"
                        //        viewBox="0 0 22.133 22.133">
                        //        <path id="Path_28710" data-name="Path 28710"
                        //            d="M18.892,3.241A11.068,11.068,0,0,0,1.482,16.6L0,22.133l5.532-1.482a11.067,11.067,0,0,0,13.36-17.41Zm-7.825,17.6a9.748,9.748,0,0,1-5.1-1.435l-.238-.146L1.834,20.3l1.044-3.9-.146-.238a9.771,9.771,0,1,1,8.334,4.67Z"
                        //            fill="#ba9a74"></path>
                        //        <rect id="Rectangle_35" data-name="Rectangle 35" width="1.297" height="1.297"
                        //            transform="translate(10.418 15.281)" fill="#ba9a74"></rect>
                        //        <path id="Path_28711" data-name="Path 28711"
                        //            d="M184.242,128.5A3.246,3.246,0,0,0,181,131.742h1.3a1.945,1.945,0,1,1,3.395,1.3l-2.1,2.346v1.545h1.3V135.88l1.768-1.977a3.242,3.242,0,0,0-2.416-5.4Z"
                        //            transform="translate(-173.176 -122.945)" fill="#ba9a74"></path>
                        //    </svg> --}}
                </a>

          {{--      // @if(Auth::check() && Auth::user()->role == 'user')
                // <?php $countFav = \App\Favourites::where('user_id', '=', auth()->id())->count() ?>
                // <a href="/user/favourites/{{auth()->id()}}">
                //     <svg xmlns="http://www.w3.org/2000/svg" width="21.561" height="19.183" viewBox="0 0 21.561 19.183">
                //         <path id="heart_1_" data-name="heart (1)" d="M10.781,19.183a1.264,1.264,0,0,1-.834-.313c-.871-.762-1.711-1.477-2.452-2.109l0,0a45.6,45.6,0,0,1-5.353-5.024A8.025,8.025,0,0,1,0,6.48a6.739,6.739,0,0,1,1.71-4.6A5.8,5.8,0,0,1,6.023,0,5.423,5.423,0,0,1,9.411,1.169a6.931,6.931,0,0,1,1.37,1.43,6.932,6.932,0,0,1,1.37-1.43A5.423,5.423,0,0,1,15.538,0a5.8,5.8,0,0,1,4.313,1.877,6.739,6.739,0,0,1,1.71,4.6,8.024,8.024,0,0,1-2.138,5.253,45.591,45.591,0,0,1-5.353,5.024c-.742.632-1.583,1.349-2.456,2.113a1.265,1.265,0,0,1-.833.313ZM6.023,1.263a4.549,4.549,0,0,0-3.384,1.47A5.482,5.482,0,0,0,1.263,6.48a6.752,6.752,0,0,0,1.848,4.447,44.869,44.869,0,0,0,5.2,4.869l0,0c.744.634,1.587,1.352,2.464,2.12.883-.769,1.727-1.488,2.472-2.123a44.881,44.881,0,0,0,5.2-4.869A6.753,6.753,0,0,0,20.3,6.48a5.482,5.482,0,0,0-1.376-3.746,4.548,4.548,0,0,0-3.384-1.47,4.189,4.189,0,0,0-2.615.905,6.129,6.129,0,0,0-1.457,1.686.8.8,0,0,1-1.37,0A6.123,6.123,0,0,0,8.638,2.169a4.189,4.189,0,0,0-2.615-.905Zm0,0" transform="translate(0 0)" fill="#ba9a74"></path>
                //     </svg>
                //     @if($countFav != 0)<span class="alarm">{{$countFav}}</span> @endif
                // </a>
                // @endif--}}

                <div class="dropdown not-box">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18.181" height="25.8"--}}
                        {{-- viewBox="0 0 18.181 25.8">--}}
                        {{-- <path id="Path_28708" data-name="Path 28708"--}}
                        {{-- d="M93.62,21.557l-1.543-2.572a7.781,7.781,0,0,1-.832-3.508v-5.9a6.562,6.562,0,0,0-4.939-6.35,2.016,2.016,0,1,0-3.224,0,6.562,6.562,0,0,0-4.939,6.35v5.9a7.782,7.782,0,0,1-.832,3.507l-1.543,2.572a1.138,1.138,0,0,0,.976,1.724h4.969a3.023,3.023,0,0,0,5.961,0h4.969A1.138,1.138,0,0,0,93.62,21.557ZM84.694,1.008a1.008,1.008,0,1,1-1.008,1.008A1.009,1.009,0,0,1,84.694,1.008ZM79.152,15.477v-5.9a5.543,5.543,0,0,1,11.086,0v5.9a9.151,9.151,0,0,0,.835,3.772H78.316A9.151,9.151,0,0,0,79.152,15.477Zm5.543,9.315a2.024,2.024,0,0,1-1.952-1.517h3.9A2.024,2.024,0,0,1,84.694,24.792Zm7.95-2.52h-15.9a.13.13,0,0,1-.112-.2l1.091-1.818H91.665l1.091,1.819A.129.129,0,0,1,92.645,22.273Z"--}}
                        {{-- transform="translate(-75.604)" fill="#ba9a74"></path>--}}
                        {{-- </svg></a>--}}
                        <div class="dropdown-menu"><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a message .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a><a class="dropdown-item" href="#"> <img src="assets/images/profile-4.jpg" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                <div class="content-not">
                                    <h3 class="title">Ana Send you a 40 .</h3>
                                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam
                                        nonumy</p>
                                </div>
                            </a>
                        </div>
                </div><a class="bottom" href="#">Buy Hours </a><a class="balance" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28.058" height="25.107" viewBox="0 0 28.058 25.107">
                        <path id="Path_28715" data-name="Path 28715" d="M58.59,25.946a.474.474,0,0,1-.474-.474V19.532H53.379a.474.474,0,0,1,0-.947H58.59a.474.474,0,0,1,.474.474v6.415a.474.474,0,0,1-.474.473Z" transform="translate(-30.723 -7.86)" fill="#ba9a74"></path>
                        <path id="Path_28716" data-name="Path 28716" d="M27.867,34.55H5.839a4.031,4.031,0,0,1-4.027-4.027v-18a.474.474,0,0,1,.947,0v18a3.083,3.083,0,0,0,3.08,3.08H27.393V27.227a.474.474,0,0,1,.947,0v6.85a.474.474,0,0,1-.474.473Z" transform="translate(0 -3.93)" fill="#ba9a74"></path>
                        <path id="Path_28717" data-name="Path 28717" d="M55.472,41.306H49.28a3.316,3.316,0,0,1,0-6.632h6.192a.948.948,0,0,1,.947.947v4.737a.948.948,0,0,1-.947.947Zm0-5.685H49.28a2.369,2.369,0,1,0,0,4.737h6.192Z" transform="translate(-26.549 -17.535)" fill="#ba9a74"></path>
                        <path id="Path_28718" data-name="Path 28718" d="M22.656,11.671H4.891a3.079,3.079,0,0,1,0-6.158H22.18a.952.952,0,0,1,.949.952V11.2A.474.474,0,0,1,22.656,11.671ZM4.891,6.46a2.132,2.132,0,0,0,0,4.264H22.18V6.465Z" fill="#ba9a74"></path>
                        <path id="Path_28719" data-name="Path 28719" d="M29.687,13H13.979a.474.474,0,0,1,0-.947H29.687a.474.474,0,0,1,0,.947Z" transform="translate(-7.031 -3.93)" fill="#ba9a74" stroke="#ba9a74" stroke-width="1">
                        </path>
                        <path id="Path_28720" data-name="Path 28720" d="M52.941,41.882A1.583,1.583,0,1,1,54.524,40.3,1.583,1.583,0,0,1,52.941,41.882Zm0-2.33a.747.747,0,1,0,.746.748A.747.747,0,0,0,52.941,39.552Z" transform="translate(-29.792 -19.965)" fill="#ba9a74"></path>
                    </svg>
                    <p>Balance : <span>0</span> hours</p>
                </a>
            </nav>
            <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                    <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" alt="" title="">
                    @else
                    <img src="{{ asset('images/default/user.jpg')}}" alt="" title="">
                    @endif
                    <div class="dropdown-menu">
                        @if(Auth::User()->role == "user")
                        <a class="dropdown-item" href="{{route('profile.show',Auth::User()->id)}}">{{ __('frontstaticword.UserProfile') }}</a>
                        <a class="dropdown-item" href="{{route('myLessons.show',Auth::User()->id)}}">{{ __('frontstaticword.MyLessons') }}</a>
                        <a class="dropdown-item" href="{{route('myTeachers.show',Auth::User()->id)}}">{{ __('frontstaticword.MyTutors') }}</a>
                        <a class="dropdown-item" href="/user/favourites/{{auth()->id()}}">{{ __('frontstaticword.Favourites') }}</a>
                        @elseif(Auth::User()->role == "instructor")
                        <a class="dropdown-item" href="/tutor/profile">{{ __('frontstaticword.UserProfile') }}</a>
                        <a class="dropdown-item" href="/tutor/lessons/{{auth()->id()}}">{{ __('frontstaticword.MyLessons') }}</a>
                        <a class="dropdown-item" href="/myStudents/{{auth()->id()}}">{{ __('frontstaticword.MyStudents') }}</a>
                        <a class="dropdown-item" href="/myCalendar/{{auth()->id()}}">{{ __('frontstaticword.Calender') }}</a>
                        @endif
                        {{-- <a class="dropdown-item" href="{{ route('wishlist.show') }}">{{ __('frontstaticword.MyWishlist') }}
                </a>--}}
                {{-- <a class="dropdown-item" href="{{ route('purchase.show') }}">{{ __('frontstaticword.PurchaseHistory') }}</a>--}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('frontstaticword.Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
            <div class="show-itemchat" id="chat">
                <div class="friends">
                    <div class="head">
                        <!--a(href="#" class="goback") <i class="fas fa-angle-right"></i>-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="true"><i class="fas fa-comments"></i>
                                    {{ __('frontend.messages') }}</a></li>
                            <li class="nav-item"><a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false"><i class="fas fa-file-alt"></i> {{ __('frontend.notifications') }}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">{{ __('frontend.all') }}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="unread-tab" data-toggle="tab" href="#unread" role="tab" aria-controls="unread" aria-selected="false">{{ __('frontend.unread') }}</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent" class="display:block">
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    {{-- <div class="formsearch">
                                            <input class="form-control filter-all" type="text"
                                                placeholder="Search..." />
                                        </div> --}}
                                    {{-- All messages  --}}
                                    <ul class="mylistall">
                                        @if(Auth::check())
                                        @foreach(Auth::user()->messages as $message)
                                        @if($message->user != null )
                                        <li class="{{ ($message->is_read == 0) ? "active" : "imgage" }}"><a href="{{route('get.chat' , $message->user->id )}}">
                                                <div class="imgage"><img src="@if($message->user->user_img == null) /frontAssets/images/profile-1.png @else {{ url('/images/user_img/'.$message->user->user_img) }} @endif" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" />
                                                </div>

                                                <div class="content">
                                                    <h4 class="title">{{$message->user->fname}}
                                                        {{$message->user->lname}}<span class="">
                                                            {{-- <small>Hover over
                                                                    me Hover
                                                                    over me Hover over me</small>  --}}
                                                        </span>
                                                    </h4>
                                                    <p class="text">{{$message->body}}</p>
                                                </div><span class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                                    {{-- <div class="formsearch">
                                            <input class="form-control filter-unread" type="text"
                                                placeholder="Search..." />
                                        </div> --}}
                                    <ul class="mylistunread">
                                        @if(Auth::check())
                                        @foreach(Auth::user()->unReadMessages as $message)
                                        @if($message->user != null )
                                        <li class="{{ ($message->is_read == 0) ? "active" : "imgage" }}"><a href="{{route('get.chat' , $message->user->id )}}">
                                                <div class="imgage"><img src="@if($message->user->user_img == null) /frontAssets/images/profile-1.png @else {{ url('/images/user_img/'.$message->user->user_img) }} @endif" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" />
                                                </div>

                                                <div class="content">
                                                    <h4 class="title">{{$message->user->fname}}
                                                        {{$message->user->lname}}<span class="fas fa-question tooltiptext"><small>Hover
                                                                over
                                                                me Hover
                                                                over me Hover over me</small> </span>
                                                    </h4>
                                                    <p class="text">{{$message->body}}</p>
                                                </div><span class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div style="display:none">
                                <div class="files">
                                    <div class="imgage"><a class="fas fa-angle-left" href="#"> </a><img src="/frontAssets/images/profile-1.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" />
                                        <div class="text-da">
                                            <h4 class="title">mohamed </h4>
                                        </div>
                                    </div>
                                    <div class="ex-files"><a class="files-bot" href="#"><i class="fas fa-folder-open"></i> files</a><a class="close" href="#">
                                            <svg width="10" height="10" viewBox="0 0 12 12" f="f" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                                            </svg></a></div>
                                </div>
                                <div class="chat-text">
                                    <p class="text-dat">September 30,2020</p>
                                    <div class="userchat"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM</span>
                                                    <div class="dropdown"><a class="dropdown-toggle fas fa-ellipsis-h" href="#" data-toggle="dropdown"></a>
                                                        <div class="dropdown-menu"><a class="dropdown-item" href="#"><i class="fas fa-pen"></i>
                                                                edit</a><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle"></i>
                                                                Report a
                                                                Message</a><a class="dropdown-item" href="#delete-message" data-toggle="modal"><i class="far fa-times-circle"></i> delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="userchat tow"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM
                                                        <!--i(class="fas fa-check it-che")--><i class="fas fa-check-double it-che active"></i>
                                                    </span></div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dat">September 30,2020 </p>
                                    <div class="userchat"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM</span>
                                                    <div class="dropdown"><a class="dropdown-toggle fas fa-ellipsis-h" href="#" data-toggle="dropdown"></a>
                                                        <div class="dropdown-menu"><a class="dropdown-item" href="#"><i class="fas fa-pen"></i>
                                                                edit</a><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle"></i>
                                                                Report a
                                                                Message</a><a class="dropdown-item" href="#delete-message" data-toggle="modal"><i class="far fa-times-circle"></i> delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="userchat tow"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM
                                                        <!--i(class="fas fa-check it-che")--><i class="fas fa-check-double it-che active"></i>
                                                    </span></div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dat">September 30,2020 </p>
                                    <div class="userchat"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM</span>
                                                    <div class="dropdown"><a class="dropdown-toggle fas fa-ellipsis-h" href="#" data-toggle="dropdown"></a>
                                                        <div class="dropdown-menu"><a class="dropdown-item" href="#"><i class="fas fa-pen"></i>
                                                                edit</a><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle"></i>
                                                                Report a
                                                                Message</a><a class="dropdown-item" href="#delete-message" data-toggle="modal"><i class="far fa-times-circle"></i> delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="userchat tow"><a class="photo" href="#"><img src="/frontAssets/images/profile-1.png" alt=""></a>
                                        <div class="padcht">
                                            <div class="text">
                                                <p>Lessoon Hasn't Started Yet Lessoon Hasn't Started Yet Lessoon
                                                    Hasn't
                                                    Started Yet</p>
                                                <div class="actions"><span class="time">3:16 PM
                                                        <!--i(class="fas fa-check it-che")--><i class="fas fa-check-double it-che active"></i>
                                                    </span></div>
                                            </div>
                                            <div class="attach">
                                                <p>
                                                    <svg width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.804705 13.9427L1.39068 14.5287C2.46361 15.6017 4.20314 15.6017 5.27606 14.5288C5.27606 14.5288 5.27606 14.5288 5.2761 14.5287L12.7642 7.04061C13.5229 6.28194 13.5229 5.05188 12.7642 4.29321L12.3736 3.90255C11.6008 3.17869 10.3989 3.17869 9.62617 3.90255L4.09742 9.4313C3.96501 9.55921 3.96135 9.77022 4.08923 9.90266C4.21714 10.0351 4.42814 10.0387 4.56058 9.91084C4.56336 9.90816 4.56608 9.90544 4.56877 9.90266L10.0975 4.3739C10.6053 3.8988 11.3945 3.8988 11.9022 4.3739L12.2929 4.76456C12.7912 5.26285 12.7913 6.07078 12.293 6.56913C12.293 6.56916 12.2929 6.56922 12.2929 6.56925L4.80478 14.0574C3.98082 14.8422 2.68599 14.8422 1.86207 14.0574L1.27606 13.4714C0.463761 12.6587 0.463761 11.3414 1.27606 10.5287L9.6262 2.17855C10.7532 1.05197 12.5799 1.05197 13.7069 2.17855L14.4883 2.95922C15.6149 4.08621 15.6149 5.91296 14.4883 7.03995L8.09749 13.4307C7.96508 13.5586 7.96139 13.7696 8.0893 13.9021C8.21721 14.0345 8.42821 14.0382 8.56065 13.9103C8.56344 13.9076 8.56615 13.9049 8.56884 13.9021L14.9596 7.51196C16.3468 6.12481 16.3468 3.87577 14.9596 2.48859C14.9596 2.48856 14.9596 2.48856 14.9596 2.48856L14.1783 1.7072C12.7911 0.320019 10.5421 0.319986 9.15488 1.70714C9.15488 1.70717 9.15485 1.70717 9.15485 1.7072L0.804705 10.0573C-0.268221 11.1302 -0.268251 12.8698 0.804705 13.9427C0.804673 13.9427 0.804673 13.9427 0.804705 13.9427Z">
                                                        </path>
                                                        <path d="M11.6669 0.666493C12.6095 0.664431 13.5139 1.03909 14.1789 1.70717L14.9596 2.48787C16.3468 3.87502 16.3468 6.12406 14.9596 7.51124L14.9596 7.51127L8.56881 13.9021C8.4409 14.0345 8.2299 14.0382 8.09746 13.9103C7.96505 13.7823 7.96136 13.5713 8.08927 13.4389C8.09196 13.4361 8.09468 13.4334 8.09746 13.4307L14.4882 7.04061C15.6148 5.91362 15.6148 4.08687 14.4882 2.95988L13.7069 2.17852C12.5799 1.05194 10.7532 1.05194 9.62617 2.17852L1.27603 10.5287C0.463738 11.3414 0.463738 12.6586 1.27603 13.4714L1.86204 14.0574C2.68599 14.8421 3.98083 14.8421 4.80475 14.0574L12.2929 6.56928C12.7913 6.07099 12.7913 5.26307 12.293 4.76472C12.293 4.76469 12.2929 4.76463 12.2929 4.7646L11.9022 4.37393C11.3945 3.89883 10.6053 3.89883 10.0976 4.37393L4.56881 9.90269C4.4409 10.0351 4.22989 10.0388 4.09745 9.91087C3.96505 9.78297 3.96139 9.57196 4.08927 9.43952C4.09195 9.43674 4.09467 9.43402 4.09745 9.43133L9.62617 3.90255C10.3989 3.17869 11.6008 3.17869 12.3736 3.90255L12.7642 4.29321C13.5229 5.05188 13.5229 6.28194 12.7642 7.04061L5.2761 14.5287C4.20317 15.6017 2.46365 15.6017 1.39072 14.5288C1.39072 14.5288 1.39072 14.5288 1.39069 14.5287L0.804682 13.9427C-0.268242 12.8698 -0.268242 11.1303 0.80465 10.0573C0.80465 10.0573 0.80465 10.0573 0.804682 10.0573L9.15482 1.70717C9.81983 1.03909 10.7242 0.664431 11.6669 0.666493Z">
                                                        </path>
                                                    </svg>Original textbooks
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="formchat" action="#" method="post"><a class="goback" href="#"><i class="fas fa-plus"></i></a>
                                    <div class="input-text">
                                        <textarea type="text" placeholder="Write your message..."></textarea><i class="far fa-smile"> </i>
                                    </div>
                                    <button class="send" type="submit"><i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <div class="files">
                                {{-- <div class="imgage"><a class="fas fa-angle-left" href="#"> </a><img
                                            src="/frontAssets/images/profile-1.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" />
                                        <div class="text-da">
                                            <h4 class="title">mohamed</h4><span class="time">September 30,2020</span>
                                        </div>
                                    </div> --}}
                                <!-- <div class="ex-files"><a class="files-bot" href="#"><i class="fas fa-folder-open"></i>
                                        files</a><a class="close" href="#">
                                        <svg width="10" height="10" viewBox="0 0 12 12" f="f"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                                                fill="#000"></path>
                                        </svg></a></div> -->
                            </div>
                            <form class="formnotes" action="#" method="post" style="display:none">
                                <div class="row">
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="sessions" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">sessions objective</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="vocabulary" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">new vocabulary</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="correction" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">error correction</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="objective" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">text session objective</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="homework" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">home work</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" placeholder="filled by thrpiate" name="material" autocomplete="off" autofocus="autofocus" required="required" />
                                        <label class="floating-label">material</label>
                                    </div>
                                </div>
                            </form>
                            <div class="item-fridy">
                                {{-- <form class="formnotes mt-3" action="#" method="post">
                                        <div class="row">
                                            <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i>
                                                <select class="form-control" name="hour" autocomplete="off"
                                                    required="required">
                                                    <option> </option>
                                                    <option>date</option>
                                                    <option>date</option>
                                                    <option>date</option>
                                                </select>
                                                <label class="floating-label">date </label>
                                            </div>
                                            <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i>
                                                <select class="form-control" name="hour" autocomplete="off"
                                                    required="required">
                                                    <option> </option>
                                                    <option>thrpiate</option>
                                                    <option>thrpiate</option>
                                                    <option>thrpiate</option>
                                                </select>
                                                <label class="floating-label">thrpiate </label>
                                            </div>
                                        </div>
                                    </form> --}}
                                <nav class="items-box">
                                    @if(Auth::check())
                                    @foreach(Auth::user()->notifications as $notification)
                                    <a class=" @if($notification->read_at == null) unread_notification @endif ">
                                        {{-- <img src="/frontAssets/images/profile-1.png"
                                                    alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}" /> --}}
                                        <div class="text-da">
                                            <h4 class="title">{{$notification->data}}</h4><span class="time">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endguest
        </div>
        </div>
    </header>
    <div class="menubab d-block d-md-none">
        <div class="container">
{{--            <nav class="setting-menu">--}}
{{--                <a href="/">Home</a>--}}

{{--                <a href="/find/tutor">Find A Tutor</a>--}}
{{--                <a href="/registration">Become A Tutor</a>--}}
{{--            </nav>--}}
            <nav class="social">
                <a class="fab fa-facebook-f icon-facebook" href="https://www.facebook.com/Arabie-114238373695322" target="_blank" title="Facebook"></a>
                <a class="fab fa-twitter icon-twitter" href="https://twitter.com/ArabiePlatform" target="_blank" title="Twitter"></a>
                <a class="fab fa-instagram icon-instagram" href="https://instagram.com/arabieplatform?igshid=7lamdlyg2kf2" target="_blank" title="Instagram"></a>

                <a class="fab fa-youtube icon-youtube" href="https://www.youtube.com/channel/UCKVoz6IAXIVE0dsMbzxy1sQ" target="_blank" title="YouTube"> </a>

            </nav>
        </div>
    </div>
    <!--End Header-->
    @yield('pageContent')
    <!-- Scripts -->

    @if($gsetting->whatsapp_mobile) <a href="https://wa.me/{{ $gsetting->whatsapp_mobile }}" class="whatsapp_float" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a> @endif

    @include('frontend.layouts.footer')

    <!-- Hotjar Tracking Code for https://arabie.live/ -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 2254007,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <!-- this is to include custom js files -->

    <script type="text/javascript">
        var read_notifications_url = "{{route('mark.user.notifications.read')}}"
        // document.ready function
        (function($) {
            $(function() {
                // selector has to be . for a class name and # for an ID
                $('#read_notifications').click(function(e) {
                    e.preventDefault(); // prevent form from reloading page
                    $.ajax({
                        'url': read_notifications_url,
                        'type': 'GET',
                        beforeSend: function() {},
                        error: function() {
                            alert('Error');
                        },
                        'success': function(data) {
                            if (data.success == "true") {
                                $("#notifications_alarm").hide();
                            }
                        }
                    });
                });

                // Change Site Language
                $('#site_lang').on('change', function(e) {
                    var site_lang = $(this).val(); // get selected lang
                    if (site_lang) { // require a URL
                        window.location = '/language-switch/' + site_lang; // redirect
                    }
                    return false;
                });
            })
        })(jQuery);
    </script>

    <script>
        (function($) {
            $('#makeFav').click(function() {
                var tutor_id = $("#makeFav").attr('tutor_id');
                $.ajax({
                    url: "/api/makeFavouriteTutor",
                    type: "POST",
                    data: {
                        tutor_id: tutor_id
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
            });

            $('#removeFav').click(function() {
                var tutor_id = $("#removeFav").attr('tutor_id');
                $.ajax({
                    url: "/api/removeFavourite",
                    type: "POST",
                    data: {
                        tutor_id: tutor_id
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        location.reload();
                    }
                })
            })
        })(jQuery);
    </script>

    {{-- sumo integration --}}
    {{-- <script async>(function(s,u,m,o,j,v){j=u.createElement(m);v=u.getElementsByTagName(m)[0];j.async=1;j.src=o;j.dataset.sumoSiteId='bd1920672b8b1c68fe5a852443fe071cb643c70eb09ac4810a6c88dc32e263bc';v.parentNode.insertBefore(j,v)})(window,document,'script','//load.sumo.com/');</script> --}}

    <!-- Google Tag Manager body (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T79JS82" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

</body>

</html>
