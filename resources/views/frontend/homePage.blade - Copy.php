@extends('frontend.layouts.layout')
@section('title', 'Home Page')
@section('pageContent')
    @include('admin.message')
    <div class="menubab">
        <div class="container">
            <nav class="setting-menu">
                <a href="/">{{ __('frontstaticword.home') }}</a>
                {{-- <a href="/about">About Us</a> --}}
                <a href="/find/tutor">{{ __('frontstaticword.FindATutor') }}</a>
                @if(Auth::guest())<a href="/registration">{{ __('frontstaticword.BecomeATutor') }}</a>@endif
            </nav>
            <nav class="social">
                <a class="fab fa-facebook-f icon-facebook" href="https://www.facebook.com/Arabie-114238373695322"
                    target="_blank" title="Facebook"></a>
                <a class="fab fa-twitter icon-twitter" href="https://twitter.com/ArabiePlatform" target="_blank"
                    title="Twitter"></a>
                <a class="fab fa-instagram icon-instagram" href="https://instagram.com/arabieplatform?igshid=7lamdlyg2kf2"
                    target="_blank" title="Instagram"></a>
                {{-- <a class="fab fa-linkedin-in icon-linkedin" href="#" target="_blank" title="linkedin"></a> --}}
                <a class="fab fa-youtube icon-youtube" href="https://www.youtube.com/channel/UCKVoz6IAXIVE0dsMbzxy1sQ"
                    target="_blank" title="YouTube"> </a>
                {{-- <a class="fab fa-google icon-gplus" href="#" target="_blank" title="google"></a> --}}
            </nav>
        </div>
    </div>
    <section class="slider">
   
                <div class=" item">
                    <div class="prod-slider">
                        <div class="slider-item">
                                    <div class="slider-img"><img src="/frontAssets/images/slide.png" alt="Arabia" title="Arabia"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
    <div class="inner">
                                <!-- <p class="text-top">Arabie is your way to.. </p> -->
                        <h2 class="title">Join Hundreds of <br />  professional tutors</h2>
                            <p class="text-bot">Meet hundreds of arabic tutors to learn the language<br /> from it’s
                                native source</p>
                            
                                <div class="bottoms"><a
                                        href="/registration">{{ __('frontstaticword.BecomeATutor') }}</a>
                                    <!--a(href="#") Contact Us-->
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</div>
                        
                        <div class="slider-item">
                                    <div class="slider-img">            <img src="/frontAssets/images/slide2.png" alt="Arabia" title="Arabia">
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
    <div class="inner">
                                <!-- <p class="text-top">Arabie is your way to.. </p> -->
                        <h2 class="title">Speak like a native <br />  arabian speaker</h2>
                            <p class="text-bot">Join hundreds of students learning and practicing arabic with our
                                <br /> verified tutors</p>
                            
                                <div class="bottoms"><a
                                        href="/register">{{ __('frontstaticword.SignUpAsStudent') }}</a>
                                    <!--a(href="#") Contact Us-->
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</div>
                        
                   
                </div>
        </div>
    </section>
    <section class="consetetur">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 item"><i class="b-1"><img src="/frontAssets/images/b-1.png" alt="Arabia"
                            title="Arabia"></i><i class="b-2"><img src="/frontAssets/images/b-2.png" alt="Arabia"
                            title="Arabia"></i><i class="b-3"><img src="/frontAssets/images/b-3.png" alt="Arabia"
                            title="Arabia"></i><i class="b-4"><img src="/frontAssets/images/b-4.png" alt="Arabia"
                            title="Arabia"></i>
                    <div class="bg-img"><img src="/frontAssets/images/bg-img.png" alt="Arabia" title="Arabia"></div>
                    <!--<div class="bg-photo">-->
                    <div class="bg-photo" style="width:500px;">
                        <!--<img src="/frontAssets/images/bg-photo.png" alt="Arabia" title="Arabia">
                                        <a class="bla-2 cd-single-point" data-fancybox data-width="780" data-height="440"
                                            href="/frontAssets/images/arabie-s1-eng-vo.mp4"> <i class="cd-img-replace"> </i><i
                                                class="fa fa-play innerbc"> </i></a>-->
                        <video width="100%" style="padding-top:55px;" controls autoplay muted>
                            <source src="/frontAssets/images/arabie-s1-eng-vo.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <h2 class="title">Speak, Write, And Practice <br /> Arabic Easily On Arabie </h2>
                    <p class="text"> At Arabie you can reach and choose between different tutors from all over the
                        world. So regardless your aim behind learning, whether it’s for Islamic reasons, Tourism,
                        Business needs or even just knowledge.<br /><br /> With a click you will get into one of the
                        biggest Arabic Teaching platforms.</p>
                </div>
            </div>
        </div>
    </section>
      <section class="cons-tow">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 texitem">
                    <div>
                        <h2 class="title">Based On Strong Four<br /> Axes Arabie Has Been <br /> Founded </h2>
                        <p class="text"> The first and most solid factor is our expert tutors in terms of academic
                            studies, skills, and experience. Second comes the online based platform accessible anywhere,
                            regardless your time zone you can choose the time best works for you and your tutors. You
                            can get both with the most affordable fees. So finally, you can join Arabie’s committed
                            students from all over the world and reach the Arabic level you have been seeking.</p>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-sm-6 inner-bg">
                            <div class="in-text">
                                <div class="photo"><img src="/frontAssets/images/img-22.png" alt="Arabia"
                                        title="Arabia">
                                </div>
                                <h3 class="title-in">Expert tutors</h3>
                                <p class="text">Find native speakers and certified private tutors</p>
                            </div>
                        </div>
                        <div class="col-sm-6 inner-bg">
                            <div class="in-text">
                                <div class="photo"><img src="/frontAssets/images/img-33.png" alt="Arabia"
                                        title="Arabia">
                                </div>
                                <h3 class="title-in">Learn anytime</h3>
                                <p class="text">Take online lessons at the perfect time for your busy schedule</p>
                            </div>
                        </div>
                        <div class="col-sm-6 inner-bg">
                            <div class="in-text">
                                <div class="photo"><img src="/frontAssets/images/img-11.png" alt="Arabia"
                                        title="Arabia">
                                </div>
                                <h3 class="title-in">Affordable prices</h3>
                                <p class="text">Choose an experienced tutor that fits your budget</p>
                            </div>
                        </div>
                        <div class="col-sm-6 inner-bg">
                            <div class="in-text">
                                <div class="photo"><img src="/frontAssets/images/img-44.png" alt="Arabia"
                                        title="Arabia">
                                </div>
                                <h3 class="title-in">Comitted Students</h3>
                                <p class="text">Join hundreds of students learning and practicing Arabic with our
                                    verified tutors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
				@if(count($tutorPackages))
					<section class="packages">
                        <div class="container">
                            <h2 class="title"><span></span> Our Ready to go packages</h2>
                            <p class="texttop"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                            <div class="row">
                            
							@foreach($tutorPackages as $tutorPackage)
								<div class="col-sm-4 item">
                                    <div class="inner-bg">
                                        <div class="photo"><img src="{{ url('/images/user_img/'.$tutorPackage->tutor->user->user_img) }}" alt="Arabia" title="Arabia">
											
											@if($tutorPackage->featured)
											<div class="feature">{{ __('frontstaticword.featured') }}</div>
											@endif
											
											@if($tutorPackage->status)
											<a href="#" class="ico-status">
												<i></i>
											</a>
											@endif
											
                                            @if(Auth::check() && Auth::user()->role == 'user')
												@php
													if($tutorPackage->tutor->favourite->where('user_id', Auth::user()->id)->count()) { $a_id = 'removeFav'; $color = 'red'; }
													else { $a_id = 'makeFav'; $color = '#d9dfe8'; }
												@endphp
												
												<a tutor_id="{{$tutorPackage->tutor_id}}" class="ico-fav" id="{{$a_id}}">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="25.7" height="24.665" viewBox="0 0 25.7 24.665">
                                                    <defs>
                                                        <filter id="Icon_ionic-md-heart" x="0" y="0" width="25.7" height="24.665"
                                                            filterUnits="userSpaceOnUse">
                                                            <feOffset dy="1" input="SourceAlpha" />
                                                            <feGaussianBlur stdDeviation="1.5" result="blur" />
                                                            <feFlood flood-opacity="0.161" />
                                                            <feComposite operator="in" in2="blur" />
                                                            <feComposite in="SourceGraphic" />
                                                        </filter>
                                                    </defs>
                                                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_ionic-md-heart)">
                                                        <path id="Icon_ionic-md-heart-2" data-name="Icon ionic-md-heart"
                                                            d="M11.225,18.992l-1.138-1.027c-4.043-3.712-6.711-6.121-6.711-9.121A4.269,4.269,0,0,1,7.692,4.5a4.644,4.644,0,0,1,3.532,1.659A4.644,4.644,0,0,1,14.757,4.5a4.269,4.269,0,0,1,4.317,4.344c0,3-2.669,5.41-6.711,9.121Z"
                                                            transform="translate(1.63 -0.5)" fill="{{$color}}" stroke="#fff"
                                                            stroke-width="1" />
                                                    </g>
													</svg>
												</a>
											@endif
											
                                        </div>
                                        <div class="session-price">
                                            <h3>$ {{ $tutorPackage->pricePerHour }}/<span>{{ __('frontstaticword.session') }}</span></h3>
                                        </div>
                                        <h4 class="name">{{ $tutorPackage->title }} </h4>
										@php
											if($tutorPackage->tutor->user->gender == 'f') $gender = 'ms';
											else $gender = 'mr';
										@endphp
                                        <div class="name-inst"> {{ __('frontstaticword.with').' '.__('frontstaticword.'.$gender) }}/ {{ $tutorPackage->tutor->user->fname.' '.$tutorPackage->tutor->user->lname }} </div>

                                        <p class="text" style="text-align:justify"> {{ $tutorPackage->about }}</p>
                                        <a href="#" class="btn-more"> {{ __('frontstaticword.details') }} </a>
                                    </div>
                                </div>
							@endforeach
							
                            </div>
                        </div>
                    </section>
				@endif
  
  
    <section class="register">
        <div class="container">
            <h3 class="title">SignUp now</h3>
            <h4 class="title-want">You can now become an Arabie verified tutor</h4>
            <p class="text"> Reach foreign student from all over the world, and get featured.</p><a
                class="bottom" href="/registration">{{ __('frontstaticword.Signup') }}</a>
        </div>
    </section>
    <section class="how-does">
        <div class="container">
            <h2 class="title"><span></span> How does Arabie works</h2>
            <p class="texttop"> Take a quick tour and see arabie in action!</p>
            <div class="se-items">
                <div class="row">
                    <div class="col-sm-6 it-text">
                        <div>
                            <h2 class="title-dos"><span>1</span> Find the best tutor</h2>
                            <p class="text">Choose from over 12,000 online tutors. Use filters to narrow your
                                search and
                                find the perfect fit For You .</p>
                        </div>
                    </div>
                    <div class="col-sm-6 item"><img src="/frontAssets/images/how-1.png" alt="Arabia" title="Arabia">
                    </div>
                </div>
            </div>
            <div class="se-items">
                <div class="row">
                    <div class="col-sm-6 item"><img src="/frontAssets/images/how-2.png" alt="Arabia" title="Arabia">
                    </div>
                    <div class="col-sm-6 it-text">
                        <div>
                            <h2 class="title-dos"><span>2</span> Anytime Anywhere Learning</h2>
                            <p class="text">No matter how busy your schedule is, with Arabie, you'll always be able to schedule your sessions in your free time. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="se-items">
                <div class="row">
                    <div class="col-sm-6 it-text">
                        <div>
                            <h2 class="title-dos"><span>3</span> Classroom Virtual Simulation </h2>
                            <p class="text">When it’s class time you will connect with your tutor through arabie’s video platform, for more commitment and a better learning experience. </p>
                        </div>
                    </div>
                    <div class="col-sm-6 item"><img src="/frontAssets/images/how-3.png" alt="Arabia" title="Arabia">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="all-students">
        <div class="container">
            <h2 class="title"><span></span> Learning Testimonials</h2>
            <p class="texttop"> Check what students think of Arabie</p>
            <div class="row">
                <div class="col-sm-4 item"><a class="inner-bg" href="#">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#ba9a74"></stop>
                                        <stop offset="1" stop-color="#877456"></stop>
                                    </linearGradient>
                                </defs>
                                <g id="left-quote" transform="translate(0 -7.858)">
                                    <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                        <path id="Path_700" data-name="Path 700"
                                            d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                            transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                        <path id="Path_701" data-name="Path 701"
                                            d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                            transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="photo"><img src="/frontAssets/images/clip.png" alt="Arabia" title="Arabia">
                        </div>
                        <h4 class="name">Laila Omar</h4>
                        <ul class="rating">
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <p class="text"> By Parent: My daughter's learning
                            sessions went excellent. I was pleased
                            with all of the tips and personalized
                            information given to help her to write,
                            speak and practice Arabic. </p>
                    </a></div>
                <div class="col-sm-4 item"><a class="inner-bg" href="#">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#ba9a74"></stop>
                                        <stop offset="1" stop-color="#877456"></stop>
                                    </linearGradient>
                                </defs>
                                <g id="left-quote" transform="translate(0 -7.858)">
                                    <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                        <path id="Path_700" data-name="Path 700"
                                            d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                            transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                        <path id="Path_701" data-name="Path 701"
                                            d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                            transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="photo"><img src="/frontAssets/images/clip2.png" alt="Arabia" title="Arabia">
                        </div>
                        <h4 class="name">Jamal Mcfee</h4>
                        <ul class="rating">
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <p class="text"> I love Arabie. It was extremely helpful
                            when I needed to read Quran. All of
                            the tutors that I have had are great
                            and are so helpful! This is the best
                            idea for a website.</p>
                    </a></div>
                <div class="col-sm-4 item"><a class="inner-bg" href="#">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#ba9a74"></stop>
                                        <stop offset="1" stop-color="#877456"></stop>
                                    </linearGradient>
                                </defs>
                                <g id="left-quote" transform="translate(0 -7.858)">
                                    <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                        <path id="Path_700" data-name="Path 700"
                                            d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                            transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                        <path id="Path_701" data-name="Path 701"
                                            d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                            transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="photo"><img src="/frontAssets/images/clip3.png" alt="Arabia" title="Arabia">
                        </div>
                        <h4 class="name">Farida osama</h4>
                        <ul class="rating">
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <p class="text">The most reasonable fees with the
                            best learning experience I ever had
                            through my long Arabic learning
                            journey </p>
                    </a></div>
            </div>
        </div>
    </section>
    <section class="instructors">
        <div class="container">
            <h2 class="title"><span></span> Teaching Testimonials</h2>
            <p class="texttop">Check what Tutors think of Arabie</p>
            <div class="instructors-slider">
                <div class="slider-item">
                    <div class="row">
                        <div class="col-sm-6 item"><i class="b-1"><img src="/frontAssets/images/b-1.png"
                                    alt="Arabia" title="Arabia"></i><i class="b-2"><img
                                    src="/frontAssets/images/b-2.png" alt="Arabia" title="Arabia"></i><i
                                class="b-3"><img src="/frontAssets/images/b-3.png" alt="Arabia"
                                    title="Arabia"></i><i class="b-4"><img src="/frontAssets/images/b-4.png"
                                    alt="Arabia" title="Arabia"></i>
                            <div class="bg-img"><img src="/frontAssets/images/bg-img.png" alt="Arabia"
                                    title="Arabia">
                            </div>
                            <div class="bg-photo"><img src="/frontAssets/images/bg3-photo.png" alt="Arabia"
                                    title="Arabia">
                            </div>
                        </div>
                        <div class="col-sm-6 item flex">
                            <div>
                                <div class="icon-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <p class="text"> I would like to take this opportunity to thank Arabie teams for
                                    all
                                    their help. The service offered has been professional and friendly. The
                                    administration side has worked seamlessly</p>
                                <div class="icon-svg s-rot">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <h2 class="title">Marwa Mourad</h2><span class="pos">Freelance Arabic
                                    Tutor</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="row">
                        <div class="col-sm-6 item"><i class="b-1"><img src="/frontAssets/images/b-1.png"
                                    alt="Arabia" title="Arabia"></i><i class="b-2"><img
                                    src="/frontAssets/images/b-2.png" alt="Arabia" title="Arabia"></i><i
                                class="b-3"><img src="/frontAssets/images/b-3.png" alt="Arabia"
                                    title="Arabia"></i><i class="b-4"><img src="/frontAssets/images/b-4.png"
                                    alt="Arabia" title="Arabia"></i>
                            <div class="bg-img"><img src="/frontAssets/images/bg-img.png" alt="Arabia"
                                    title="Arabia">
                            </div>
                            <div class="bg-photo"><img src="/frontAssets/images/bg-photo1.png" alt="Arabia"
                                    title="Arabia">
                            </div>
                        </div>
                        <div class="col-sm-6 item flex">
                            <div>
                                <div class="icon-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <p class="text">When exchanging knowledge meets the highest durability, the
                                    simple
                                    outcome is Arabie</p>
                                <div class="icon-svg s-rot">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <h2 class="title">Samira Mahmoud</h2><span class="pos">Specialized
                                    Arabic Tutor</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="row">
                        <div class="col-sm-6 item"><i class="b-1"><img src="/frontAssets/images/b-1.png"
                                    alt="Arabia" title="Arabia"></i><i class="b-2"><img
                                    src="/frontAssets/images/b-2.png" alt="Arabia" title="Arabia"></i><i
                                class="b-3"><img src="/frontAssets/images/b-3.png" alt="Arabia"
                                    title="Arabia"></i><i class="b-4"><img src="/frontAssets/images/b-4.png"
                                    alt="Arabia" title="Arabia"></i>
                            <div class="bg-img"><img src="/frontAssets/images/bg-img.png" alt="Arabia"
                                    title="Arabia">
                            </div>
                            <div class="bg-photo"><img src="/frontAssets/images/bg4-photo.jpg" alt="Arabia"
                                    title="Arabia">
                            </div>
                        </div>
                        <div class="col-sm-6 item flex">
                            <div>
                                <div class="icon-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <p class="text">Since the lock down and I needed such a service to
                                    both fill my time and earn me money, and honestly I
                                    can
                                    ’t ask for more with Arabie.. It was the ultimate
                                    teaching experience for me</p>
                                <div class="icon-svg s-rot">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="44.977" height="37.562" viewBox="0 0 44.977 37.562">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="left-quote" transform="translate(0 -7.858)">
                                            <g id="Group_117" data-name="Group 117" transform="translate(0 7.858)">
                                                <path id="Path_700" data-name="Path 700"
                                                    d="M14.4,24.881A11.918,11.918,0,0,0,11.1,24.4a10.349,10.349,0,0,0-4.129.846c1.038-3.8,3.531-10.356,8.5-11.095a1.18,1.18,0,0,0,.962-.849L17.52,9.42a1.18,1.18,0,0,0-.976-1.486,8.245,8.245,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.358,15.133C-.387,28.219-.816,36.078,2.787,41.025a10.756,10.756,0,0,0,8.742,4.394h.046A10.464,10.464,0,0,0,14.4,24.881Z"
                                                    transform="translate(0 -7.858)" fill="url(#linear-gradient)"></path>
                                                <path id="Path_701" data-name="Path 701"
                                                    d="M69.312,29.822a10.488,10.488,0,0,0-6.291-4.942,11.917,11.917,0,0,0-3.293-.481,10.351,10.351,0,0,0-4.13.846c1.038-3.8,3.531-10.356,8.5-11.095a1.181,1.181,0,0,0,.962-.849L66.146,9.42a1.18,1.18,0,0,0-.976-1.486,8.235,8.235,0,0,0-1.111-.075c-5.962,0-11.867,6.223-14.359,15.133-1.462,5.227-1.891,13.087,1.712,18.034a10.754,10.754,0,0,0,8.741,4.393H60.2a10.464,10.464,0,0,0,9.111-15.6Z"
                                                    transform="translate(-25.685 -7.858)" fill="url(#linear-gradient)">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <h2 class="title">Ahmed El Tokhy</h2><span class="pos">Islamic Studies
                                    Head</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="conslast">
        <div class="container">
            <div class="item-img"><img src="/frontAssets/images/conslast.png" alt="Arabia" title="Arabia"></div>
            <h2 class="title">100% Satisfaction Guarantee</h2>
            <p class="text">If you are not satisfied with your trial lesson, we can offer you another session with a different tutor or a full refund</p>
        </div>
    </section>
@endsection
@section('footerAssets')
    <script src="/frontAssets/js/grt-youtube-popup.js"></script>
@endsection
