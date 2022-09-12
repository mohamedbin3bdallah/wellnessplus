{{--{{substr(\Illuminate\Support\Carbon::today()->addDay(6),0, 10)}}--}}
@extends('frontend.layouts.layout')
@section('title', __('frontend.tutor_page'))

@section('pageContent')

<section class="findtutor">
    @include('admin.message')
    <div class="container-fluid">
        <div class="content-all">
            <div class="row contenuser findinner" id="content">
                <div class="col-12 justify-content-between ">
                    <div class="flex-box">
                        <div class="tu-photo">
                            <div class="img">
                                {{-- <span class="featured">Featured</span>--}}
                                <!--a(href="#" class="fas fa-heart")-->
                                {{-- <span class="online"></span>--}}
                                <!-- <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="{{ __('frontend.website_name') }}"
                                        title="{{ __('frontend.website_name') }}"> -->
                                <img src="/frontAssets/images/l1.png">
                            </div>
                            <!-- <div class="price">
                                @php
                                $tutor_country_price_per_hour =
                                $tutor->tutor_country_price_per_hour()->where(['country_id'=>$user_ip_country_info['country_id'],'status'=>1])->first();
                                if($tutor_country_price_per_hour) { $price_per_hour =
                                number_format($tutor_country_price_per_hour->pricePerHour * $userExchangeRate, 2, '.',
                                ''); $currency_code = $tutor_country_price_per_hour->currency; }
                                else $price_per_hour = number_format($tutor->PricePerHour * $userExchangeRate, 2, '.',
                                '');
                                @endphp
                                {{ $price_per_hour }}
                            </div> -->
                            <!-- <div class="price-to">{{ $currency_code }}/H</div> -->
                        </div>
                        <div class="tu-content">
                            <div class="minhead">
                                <h3 class="title txt-blue">{{$tutor->user->fname}}
                                    {{$tutor->user->lname}}.
                                </h3>
                                <div class="flag" title="{{$tutor->country_name}}">
                                    {{country($tutor->user->country->iso)->getEmoji()}}
                                </div>
                                <div class="safy">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16.436" height="19.301" viewBox="0 0 16.436 19.301">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#ba9a74"></stop>
                                                <stop offset="1" stop-color="#877456"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="surface1" transform="translate(0 0.001)">
                                            <path id="Path_28769" data-name="Path 28769" d="M124.119,158.457a3.677,3.677,0,1,0,3.677,3.677A3.682,3.682,0,0,0,124.119,158.457Zm2.183,2.985-2.635,2.635a.566.566,0,0,1-.8,0l-1.007-1.007a.566.566,0,1,1,.8-.8l.606.606,2.234-2.234a.566.566,0,0,1,.8.8Zm0,0" transform="translate(-115.901 -152.485)" fill="url(#linear-gradient)">
                                            </path>
                                            <path id="Path_28770" data-name="Path 28770" d="M16.417,5.236V5.221c-.008-.185-.014-.382-.017-.6a2.046,2.046,0,0,0-1.926-2A7.938,7.938,0,0,1,9.07.34L9.058.328a1.235,1.235,0,0,0-1.679,0L7.366.34a7.939,7.939,0,0,1-5.4,2.277,2.045,2.045,0,0,0-1.926,2c0,.217-.009.413-.017.6v.035a20.918,20.918,0,0,0,.845,7.635A9.72,9.72,0,0,0,3.2,16.523a12.2,12.2,0,0,0,4.563,2.7,1.413,1.413,0,0,0,.187.051,1.381,1.381,0,0,0,.543,0,1.418,1.418,0,0,0,.188-.051,12.206,12.206,0,0,0,4.558-2.7,9.733,9.733,0,0,0,2.332-3.633A20.949,20.949,0,0,0,16.417,5.236Zm-8.2,9.224a4.81,4.81,0,1,1,4.81-4.81A4.815,4.815,0,0,1,8.218,14.46Zm0,0" transform="translate(0)" fill="url(#linear-gradient)"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="recommendation">
                                    @if($tutor->recommendation)
                                    <i class="fas fa-lg fa-user-check" title="{{ __('adminstaticword.recommended') }}"></i>
                                    @else
                                    <i class="fas fa-lg fa-user" title="{{ __('adminstaticword.notrecommended') }}"></i>
                                    @endif
                                </div>
                                @if($averageRating != 0)
                                <ul class="rating">
                                    @if($averageRating == 1)
                                    <li class="fas fa-star active"></li>
                                    @elseif($averageRating == 2)
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @elseif($averageRating == 3 )
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @else
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @endif
                                </ul>
                                @endif
                            </div>
                            <!--
								<h3 class="title siz-titl">
										@php $organizations = array(); @endphp
										@foreach($tutor->tutor as $partner)
											@php
												$user_org = App\UserOrganization::with('organization')->where(['user_id'=>$partner->partner_id])->first();
												$organizations[] = $user_org->organization->name;
											@endphp
										@endforeach
										{{implode(",",$organizations)}}
								</h3>
								-->
                            <!-- <h3 class="title siz-titl">{{$tutor->headline}}.</h3> -->
                            <h6>Psychotherapist</h6>

                            <div class="minhead towhead">
                                @foreach($tutor->languages as $language)
                                <div class="speaks">
                                    <p>{{ __('frontend.speaks') }} :</p>
                                    <span>{{$language->language->isoName}}</span><strong class="txt-blue">{{$language->level->name}}</strong>
                                </div>
                                @endforeach
                            </div>
                            <p>
                                <span>{{ __('frontstaticword.Specialties') }} :</span> Mood disorders (depression), Anxiety disorders and
                                obsessions,<br />
                                Marriage Counselling/Relationship Disorders,<br />
                                Addiction, Sexual disorders,<br />
                            </p>

                            <!-- @if(Auth::check() && Auth::user()->role == 'user')
                            @if($isFavourite == null)
                            <div id="makeFav" tutor_id="{{$tutor->id}}">
                                <a class="md-heart" href="#"><img src="/frontAssets/images/md-heart.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></a>
                            </div>
                            @else
                            <div id="removeFav" tutor_id="{{$tutor->id}}">
                                <a class="md-heart" href="#"><img src="/frontAssets/images/redHeart.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></a>
                            </div>
                            @endif
                            @endif -->

                            <!--<div class="row">
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                            <input value="{{$tutor->id}}" class="input-group tutor_id" id="tutor_id"
                                                hidden>

                                            <div class="con-item">
                                                <h4 class="title">Active students</h4><span>{{count($activeStudents)}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                            <div class="con-item">
                                                <h4 class="title">Lessons</h4><span>{{count($bookedSlots)}} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/review.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                            <div class="con-item">
                                                <h4 class="title">Reviews</h4><span>{{$reviewCounter}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                        </div>
                            <ul class="rating">

                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                </ul>
                    </div>

                </div>
                <div class="col-12 col-md-6 ">
                    <div class="itemtutor">

                        <div class="childbox">
                            <h3 class="title mb-2"><svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="30.641" height="30.641" viewBox="0 0 30.641 30.641">
                                    <g id="info-circle" transform="translate(0 0)">
                                        <path id="Path_8875" data-name="Path 8875" d="M15.32,28.726A13.405,13.405,0,1,0,1.915,15.32,13.405,13.405,0,0,0,15.32,28.726Zm0,1.915A15.32,15.32,0,1,0,0,15.32,15.32,15.32,0,0,0,15.32,30.641Z" transform="translate(0 0)" fill="#006b99" fill-rule="evenodd" />
                                        <path id="Path_8876" data-name="Path 8876" d="M19.279,14.823l-4.385.55-.157.728.861.159c.563.134.674.337.552.9L14.738,23.8c-.371,1.718.2,2.526,1.547,2.526A3.966,3.966,0,0,0,19.09,25.18l.169-.8a2.121,2.121,0,0,1-1.314.471c-.527,0-.718-.369-.582-1.021Z" transform="translate(-2.178 -2.207)" fill="#006b99" />
                                        <path id="Path_8877" data-name="Path 8877" d="M19.58,9.79a1.915,1.915,0,1,1-1.915-1.915A1.915,1.915,0,0,1,19.58,9.79Z" transform="translate(-2.345 -1.172)" fill="#006b99" />
                                    </g>
                                </svg>
                                <span>{{ __('frontend.about_me') }}</span>
                            </h3>
                            <!--<div class="headtext">
                                <p class="textline">{{substr($tutor->detail, 0, 50)}}</p>
                                <div class="onclick"><span class="more">+ Read more</span><span class="cancel">X
                                        hide</span></div>
                                <p class="divhidslid">{{substr($tutor->detail, 50, 500)}}</p>
                            </div>-->
                            <div class="headtext">
                                <p class="textline">{!! $tutor->detail !!}</p>
                            </div>
                        </div>
                        <div class="row">
                            @php
                            if(session()->has('changed_language') && session('changed_language') == 'ar') { $age =
                            'age_ar'; $student_level = 'student_level_ar'; }
                            else { $age = 'age'; $student_level = 'student_level'; }
                            @endphp
                            <div class="col std-item">
                                <ul class="list-item">
                                    <li class="great">{{ __('frontstaticword.PreferredStudentAge') }}</li>
                                    @if($tutor->prefered_student_age->count())
                                    @foreach($tutor->prefered_student_age as $prefered_student_age)
                                    <li><i class="fas fa-circle"></i>
                                        {{$prefered_student_age->prefered_student_age->$age}}
                                    </li>
                                    @endforeach
                                    @else
                                    <span class="">{{ __('frontstaticword.thereAreNoData') }}</span>
                                    @endif
                                </ul>
                            </div>
                            <div class="col std-item">
                                <ul class="list-item">
                                    <li class="great">{{ __('frontstaticword.preferredStudentLevel') }}</li>
                                    @if($tutor->prefered_student_level->count())
                                    @foreach($tutor->prefered_student_level as $prefered_student_level)
                                    <li><i class="fas fa-circle"></i>
                                        {{$prefered_student_level->prefered_student_level->$student_level}}
                                    </li>
                                    @endforeach
                                    @else
                                    <span class="">{{ __('frontstaticword.thereAreNoData') }}</span>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <nav class="bord-colo">
                                    <ul class="nav nav-tabs nav-Therapist" id="nav-tab" role="tablist">
                                   <li class="nav-item">    <a class="nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true"> {{ __('frontend.profile') }} </a>
                                     </li> <li class="nav-item">   <a class="nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">{{ __('frontend.video') }}</a>
                                     </li><li class="nav-item">  <a class="nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">{{ __('frontend.reviews') }}</a>
                                  </li>   </ul>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="point-profile" id="education">
                                            <h5 class="title t-point">{{ __('frontend.education') }}</h5>

                                            @if(count($tutorEducations))
                                            @foreach($tutorEducations as $education)
                                            <div class="item-edit">
                                                <div class="primary">
                                                    <h5 class="title">{{$education->university}}</h5>
                                                    <small>{{$education->specialty}} ,
                                                        {{$education->degree}}</small>
                                                    {{-- <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                                </div>
                                                <div class="date txt-blue">{{$education->from}}-{{$education->to}}</div>

                                            </div>
                                            @endforeach
                                            @else
                                            {{ __('frontstaticword.noeducations') }}
                                            @endif

                                        </div>
                                        <div class="point-profile" id="experience">
                                            <h5 class="title t-point">{{ __('frontend.work_experience') }}</h5>

                                            @if(count($tutorExperiences))
                                            @foreach($tutorExperiences as $experience)
                                            <div class="item-edit">
                                                <div class="primary">
                                                    <h5 class="title">{{$experience->company}}</h5>
                                                    <small>{{$experience->title}}</small>
                                                    {{-- <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                                </div>
                                                <div class="date txt-blue">{{$experience->from}}-{{$experience->to}}</div>

                                            </div>
                                            @endforeach
                                            @else
                                            {{ __('frontstaticword.noexperiences') }}
                                            @endif
                                        </div>
                                        <div class="point-profile" id="certifications">
                                            <h5 class="title t-point">{{ __('frontend.certifications') }}</h5>

                                            @if(count($tutorCertificates))
                                            @foreach($tutorCertificates as $certificate)
                                            <div class="item-edit">
                                                <div class="primary">
                                                    <h5 class="title">{{$certificate->certificate}}</h5>
                                                    <small>{{$certificate->description}}</small>
                                                    {{-- <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                                </div>
                                                <div class="date txt-blue">{{$certificate->from}}-{{$certificate->to}}</div>

                                            </div>
                                            @endforeach
                                            @else
                                            {{ __('frontstaticword.nocertificates') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                                              <div id="sidebar">
                                                @if($tutor->user->youtube_url == null)
                                                <div class="iframe">
                                                    <video class="player-course-chapter-list" loop width="400px"
                                                        src="{{ asset('files/instructor/'.$tutor->video) }}" controls>
                                                    </video>
                                                </div>
                                                @else
                                                <div class="iframe">
                                                    <iframe
                                                        src="{{preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1",$tutor->user->youtube_url)}}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
                                                </div>
                                                @endif


                                            </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">

                    <div class=" reviews">
                        <div class="head-rv">
                            <div class="text-rev">
                                <h3 class="title"> {{ __('frontend.reviews') }}</h3>
                                @if($averageRating != 0)
                                <ul class="rating">
                                    @if($averageRating == 1)
                                    <li class="fas fa-star active"></li>
                                    @elseif($averageRating == 2)
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @elseif($averageRating == 3 )
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @else
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    <li class="fas fa-star active"></li>
                                    @endif
                                </ul>
                                @endif
                                <p class="numb-rev"><span>{{$reviewCounter}}</span> {{ __('frontend.reviews') }}</p>
                            </div>
                            @php $hasReview = false; @endphp
                            @foreach($tutorReviews as $review)
                            @if($review->user_id == auth()->id())
                            @php $hasReview = true; @endphp
                            @endif
                            @endforeach

                            @php $hasConfirmedLesson = false; @endphp
                            @foreach($confirmedLessons as $confirmedLesson)
                            @if($confirmedLesson->user_id == auth()->id())
                            @php $hasConfirmedLesson = true; @endphp
                            @endif
                            @endforeach
                            @if($hasConfirmedLesson == true && $hasReview == false)
                            <a class="add-rev" href="#addreview" data-toggle="modal"><i class="fas fa-plus"></i> {{ __('frontend.add_review') }}
                            @endif
                        </div>
                        <div class="allcomint">
                            {{--                                {{dd($tutorReviews)}}--}}
                            @foreach($tutorReviews as $review)
                            <div class="comment">
                                <div class="photo"> <img src="{{ url('/images/user_img/'.$review->user->user_img) }}" alt=""
                                        title=""></div>
                                <div class="content">
                                    <h3 class="title">{{$review->user->fname}} {{$review->user->lname}}</h3><span
                                        class="date">{{$review->created_at}}</span>
                                    <p class="text"> {{$review->review}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{--                            <div class="text-center"><a class="bottom"> <span class="viw-rev">View more  <i class="fas fa-angle-down"></i></span><span class="rev-hide">hide reviews  <i class="fas fa-chevron-up"></i></span></a></div>--}}
                    </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
                <div class="col-12 col-md-6 contenuser sidbar">
                         <div class="row tu-content p-0 mx-0 mb-3">
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv bg-white"><img src="/frontAssets/images/mactiv1.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.active_students') }}</h4>
                                                    <span>{{count($tutor->bookedSlots->groupBy('user_id'))}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv bg-white"><img src="/frontAssets/images/clock.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.lessons') }}</h4><span>{{count($tutor->bookedSlots)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv bg-white"><img src="/frontAssets/images/review.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.reviews') }}</h4><span>{{count($tutor->reviews)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                    @if(Auth::check() && Auth::user()->role == 'user' || Auth::guest())
                        <form action="/slots/appointment" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="itemtutor bord-colo pt-0">
                                <div class="head-block">
                                <h3 class="title"> {{ __('frontend.booking_information') }}</h3>

                                </div>
                                <div class="between ">
                                    <h6 class="txt-blue font-weight-bold mb-2">
                                        {{ __('frontend.book_now') }}
                                    </h6>
                                        <p>
                                                {{ __('frontend.tutor_slots_text') }}
                                            </p>
                                            <p class="timezone txt-grey"><i class="fas fa-globe-americas"></i> {{ __('frontend.tutor_slots_week_text_1') }}</p>
                                </div>
                                    <div class="wrapper-cal mx-3">

                                <div class="responsive">
                                    <?php $week = 0 ?>
                                    <?php $dayOfMonth = substr(\Carbon\Carbon::today() , 8, 2) ?>
                                    <?php $origDate = \Illuminate\Support\Carbon::now() ?>
                                    <?php $i = \Illuminate\Support\Carbon::now() ?>
                                    @while($week < 4) <div>
									@php
									$week_first_day = $origDate->format('d');
									$week_first_month = $origDate->format('F');
									$week_first_year = $origDate->format('Y');
									$week_last_date = $origDate->addDay(6);
									$week_last_day = $week_last_date->format('d');
									$week_last_month = $week_last_date->format('F');
									$week_last_year = $week_last_date->format('Y');
									@endphp

                                        <div class="between custom-bg">

                                            <p class="day-ma">{{$week_first_day.' '.__('frontend.'.$week_first_month).' '.$week_first_year}}  {{ __('frontend.to') }}  {{$week_last_day.' '.__('frontend.'.$week_last_month).' '.$week_last_year}} </p>

                                        </div>
                                        <div class="num-book">
                                            <div class="row">
                                                    <?php $dayOfWeek = \Carbon\Carbon::today() ?>
                                                    @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                                        <div class="col innerbook">
                                                            <div class="innernum active">
                                                                <p class="sat active">{{substr($dayOfWeek->format('l'), 0, 3)}}
                                                                </p>
                                                                <div class="numb dayOfMonth"> {{$dayOfMonth}}</div>
                                                                @foreach($tutor->schedule as $schedule)
                                                                @if($schedule->day == $dayOfWeek->format('l'))
                                                                <nav class="listnum">
                                                                    <?php
                                                                        $currentTime = $schedule->start_time;
                                                                        $currentDate = $i->format('Y-m-d');
                                                                        ?>

                                                                    @while($currentTime < $schedule->end_time)
                                                                        <?php $bookedFlag = false ?>
                                                                        <?php $passedFlag = false;
                                                                            $time_zone = \App\Time_zone::find($tutor
                                                                                ->user
                                                                                ->time_zone_id);

                                                                            // get slot time format to conver it
                                                                            $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                            // convert from time zone to time zone saved in session
                                                                            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time, $time_zone->time_zone_name)
                                                                                ->setTimezone(session('currentTimeZoneName'));

                                                                            $correct_time2 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                                            ?>
                                                                        @if($currentDate ==
                                                                        \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName')
                                                                        ))->format('Y-m-d') && $correct_time2 <
                                                                            \Illuminate\Support\Carbon::now()->
                                                                            timezone((session('currentTimeZoneName')
                                                                            ))->format('H:i'))
                                                                            <?php $passedFlag = true ?>
                                                                            @endif
                                                                            @foreach($tutor->bookedSlots as $bookedSlot)

                                                                            @if(substr($currentTime, 0, 8) ==
                                                                            $bookedSlot->start_time && $currentDate ==
                                                                            $bookedSlot->date)
                                                                            <?php $bookedFlag = true ?>
                                                                            @endif

                                                                            @endforeach

                                                                            @if($bookedFlag == false)

                                                                            {{-- 1- get time off foreach tutor
                                                                                2- convert that time into student time zone
                                                                                3- append that time to today so you know the date
                                                                                4- check if the date inside the time off  --}}

                                                                            @php
                                                                            // get tutor time zone
                                                                            $time_zone =
                                                                            \App\Time_zone::find($tutor->user->time_zone_id);


                                                                            // get slot time format to conver it
                                                                            $slot_time = date(" H:i:s",
                                                                            strtotime("$currentTime"));

                                                                            // convert from time zone to time zone saved in session
                                                                            $slot_time_converted =
                                                                            \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,
                                                                            date('Y-m-d'). $slot_time ,
                                                                            $time_zone->time_zone_name )
                                                                            ->setTimezone(session('currentTimeZoneName') );

                                                                            $correct_time =
                                                                            \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                                                                            // 1- get time off for this tutor
                                                                            // 2- convert that time into student time zone
                                                                            // 3- append that time to today so you know the date
                                                                            // 4- check if the date inside the time off
                                                                            $time_offs = \App\TutorTimeOff::where('tutor_id',
                                                                            $tutor->id )->where('start_date' , '>=' ,
                                                                            \Carbon\Carbon::now()->format('Y-m-d') )->get();
                                                                            foreach ($time_offs as $time_off) {

                                                                            if($time_off != null){
                                                                            $start_date_time =
                                                                            \Carbon\Carbon::parse($time_off->start_date . ' '
                                                                            .$time_off->start_time )->format('Y-m-d H:i:s');
                                                                            $end_date_time =
                                                                            \Carbon\Carbon::parse($time_off->end_date . ' '
                                                                            .$time_off->end_time )->format('Y-m-d H:i:s');

                                                                            $session_time = \Carbon\Carbon::parse($currentDate .
                                                                            ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                                                            if( ($session_time > $start_date_time) &&
                                                                            ($session_time < $end_date_time)){ //
                                                                                dd($start_date_time , $end_date_time ,
                                                                                $session_time); $correct_time="" ; } } } @endphp
                                                                                @if($passedFlag==false)
                                                                                <!--<li
                                                                                class="active bookingData" onmouseover=""
                                                                                style="cursor: pointer;"
                                                                                slotTime="{{substr($currentTime, 0, 5)}}"
                                                                                selectedDate="{{$currentDate}}">
                                                                                {{ $correct_time  }}
                                                                                </li>-->
                                                                                <li id="ck-button" class="active" onmouseover="" style="cursor: pointer;">
                                                                                    <label class="required">
                                                                                        <input type="checkbox" id="checkboxSlot" name="slots[]" value="{{$tutor->id.','.$currentDate.','.substr($currentTime, 0, 5)}}">
                                                                                        <span> {{$correct_time}} </span>
                                                                                    </label>
                                                                                </li>
                                                                                @endif
                                                                                @else
                                                                                <!--<li class="active">Booked</li>-->
                                                                                <li id="ck-book" class="active"><label><span>{{ __('frontend.booked') }}</span></label></li>
                                                                                @endif
                                                                                <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour")) ?>
                                                                                @endwhile
                                                                </nav>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <input name="date" type="text" id="date" value="" hidden>
                                                        <input name="time" type="text" id="time" value="" hidden>
                                                        <div><button type="submit" id="submitBooking" name="myButton"
                                                                hidden="hidden">{{ __('frontend.search') }}</button></div>

                                                <?php $dayOfWeek->addDay(1); ?>
                                                @if($dayOfMonth < substr(\Carbon\Carbon::now()->endOfMonth(), 8,2))
                                                    <?php $dayOfMonth++ ?>
                                                    @else
                                                    <?php $dayOfMonth = 1 ?>
                                                    @endif
                                                    <?php $i = $i->addDay(1) ?>

                                                    @endwhile
                                            </div>
                                        </div>
                                </div>
                                <?php $week++ ?>
                                <?php $origDate->addDay(1) ?>

                                @endwhile
                            </div>
                        <!-- <div class="bot-de bot-card slots_sticky_footer">
                            <button type="submit" class="bottom booknow" id="checkBtn">Submit</button>
                        </div> -->
                        </form>
                        <div class="bot-show">
                            <a class=" view-sce " href="javascript:;"> <span class="">{{ __('frontend.view_full_schedule') }}</span></a>
                        </div>
                    @endif
                                @if(Auth::check() && Auth::user()->role == 'user' || Auth::guest())
                                                <div class="bot-de bot-card">
                                                    <a class="bottom book-trial btn-green" href="#booktrial" data-toggle="modal">{{ __('frontend.book_now') }}</a>

                                                @endif
                                                                                                </div>
                                                </div>

                                               @if(Auth::check() && Auth::user()->role == 'user' || Auth::guest())
                                                <div class="bot-de bot-card">

                                                        <a class="bottom btn-outline-blue " href="#sendmessage" data-toggle="modal">{{ __('frontend.send_message') }} </a>
                                                    </div>
                                                <p class="timezone">
                                                    <img class="mr-2" src="/frontAssets/images/timer.svg"/>
													{{ __('frontend.usually_response_in_5_hrs') }}
												</p>
                                                @endif

                </div>

            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addreview" role="dialog">
    <div class="modal-dialog popreview">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                        fill="#000"></path>
                </svg>
            </button>
            <h3 class="title">{{ __('frontend.add_review') }}</h3>
            <form action="/reviewrating" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="row">
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="review" placeholder="Add your review" autocomplete="off"
                            autofocus="" required="required" minlength="2" maxlength="500"></textarea>
                        <label class="floating-label">{{ __('frontend.review') }}</label>
                    </div>
                    @if(auth()->check())
                    <input type="text" name="userId" value="{{auth()->user()->id}}" hidden>
                    @endif
                    <input type="text" name="tutorId" value="{{$tutor->id}}" hidden>
                    <input type="text" name="starsValue" id="starsValue" value="starsValue" hidden>
                    <div class="col-sm-12 fild">
                        <h3 class="title charact">{{ __('frontend.characteristics_of_a_tutor') }}</h3>
                        <div class="row">
                            <div class="col">
                                <div class="rev-item" name="">
                                    <p>{{ __('frontend.effectiveness') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="rev-item">
                                    <p>{{ __('frontend.methodology') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="rev-item">
                                    <p>{{ __('frontend.motivation') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col">
                                <div class="rev-item">
                                    <p>{{ __('frontend.interpersonal_skills') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="rev-item">
                                    <p>{{ __('frontend.strictness') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="rev-item">
                                    <p>{{ __('frontend.punctuality') }}</p>
                                    <ul class="stars">
                                        <li value="1" class="star" title="" data-value="1"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="2" class="star" title="" data-value="2"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="3" class="star" title="" data-value="3"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="4" class="star" title="" data-value="4"><i class="fas fa-star"></i>
                                        </li>
                                        <li value="5" class="star" title="" data-value="5"><i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom" type="submit">{{ __('frontend.post_review') }}</button><a class="bottom" href="#"
                        data-dismiss="modal">{{ __('frontend.cancel') }} </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog popreview findtutor" style="margin-top: 100px;">
        <div class="modal-content  contenuser findinner">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                        fill="#000"></path>
                </svg>
            </button>
            <!-- <div class=" photo mt-2"> <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="" title=""></div> -->
            <div class="d-flex">
                        <div class="tu-photo">
                            <div class="img">


                                <img src="/frontAssets/images/l1.png">
                            </div>

                        </div>
                        <div class="tu-content">
                            <div class="minhead">
                                <h3 class="title txt-blue">{{$tutor->user->fname}} {{$tutor->user->lname}}
                                </h3>


                             </div>

                            <h6>{{$tutor->headline}}</h6>

                            <div class="minhead towhead">
                                                                <div class="speaks">
                                    <p>{{ __('frontend.speaks') }} :</p>
                                    <span>Arabic</span><strong class="txt-blue">Native</strong>
                                </div>
                                                                <div class="speaks">
                                    <p>{{ __('frontend.speaks') }} :</p>
                                    <span>English</span><strong class="txt-blue">C2</strong>
                                </div>
                                                                <div class="speaks">
                                    <p>{{ __('frontend.speaks') }} :</p>
                                    <span>French</span><strong class="txt-blue">B2</strong>
                                </div>
                                                            </div>
                            <p>
                                <span>{{ __('frontstaticword.Specialties') }} :</span> Mood disorders (depression), Anxiety disorders and
                                obsessions,<br>
                                Marriage Counselling/Relationship Disorders,<br>
                                Addiction, Sexual disorders,<br>
                            </p>


                        </div>

                    </div>

            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->fname) && Auth::user()->fname !='')
                        @endif>
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontend.enter_your_fname') }}"
                            name="fname" value="@if(isset(Auth::user()->id)){{ Auth::user()->fname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                    </div>

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->lname) && Auth::user()->lname !='')
                        @endif>
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontend.enter_your_lname') }}"
                            name="lname" value="@if(isset(Auth::user()->id)){{ Auth::user()->lname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                    </div>
                    <div class="col-sm-12 fild" @if(isset(Auth::user()->email) && Auth::user()->email !='')
                        @endif>
                        <input class="form-control" type="email"
                            placeholder="{{ __('frontend.enter_your_email') }}"
                            name="email" value="@if(isset(Auth::user()->id)){{ Auth::user()->email }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.Email') }}</label>
                    </div>
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="message"
                            placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus=""
                            required="" maxlength="300" minlength="2"></textarea>
                        <label class="floating-label">{{ __('frontstaticword.message') }}</label>
                    </div>

                    <input type="text" name="recipientId" value="{{ $tutor->id }}" hidden readonly>

                </div>
                <div class="fild bot-de bot-card border-0 m-0">
                    <button class="bottom btn-green w-50" type="submit">{{ __('frontstaticword.send') }}</button> <a class="bottom btn-outline-grey w-50"
                        href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="box-book-trial findtutor" id="#booktrial">
    <div class="modal-content  contenuser findinner">
        <button class="close clo-item" type="button">
            <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                    fill="#000"></path>
            </svg>
        </button>
        <div class="d-flex align-items-center p-3">
                        <div class="tu-photo sm">
                            <div class="img">


                                <img src="{{url('/images/user_img/'.$tutor->user->user_img)}}" alt="" title="">
                            </div>

                        </div>
                        <div class="tu-content">
                            <div class="minhead">
                                <h5 class="title txt-blue">{{ __('frontend.book_now') }}
                                </h5>


                             </div>

                            <p>
                                {{ __('frontend.tutor_slots_text') }}
                            </p>
                            <p class="timezone txt-grey justify-content-start">
                                 <i class="fas fa-globe-americas"></i> {{ __('frontend.tutor_slots_week_text_1') }}</p>

                        </div>


                    </div>

		<form action="/slots/appointment" method="get" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;" id="slots_form">
                <div class="wrapper-cal mx-3 mb-3">

        <div class="responsive">
            <?php $week = 0?>
            <?php $dayOfMonth = substr(\Carbon\Carbon::today(), 8,2 ) ?>
            <?php
                                $origDate = \Illuminate\Support\Carbon::now();
                                $i = \Illuminate\Support\Carbon::now();
                                //dd($tutor->schedule);
                            ?>

            @while($week < 4) <div>
				<?php
					$week_first_day = $origDate->format('d');
					$week_first_month = $origDate->format('F');
					$week_first_year = $origDate->format('Y');
					$week_last_date = $origDate->addDay(6);
					$week_last_day = $week_last_date->format('d');
					$week_last_month = $week_last_date->format('F');
					$week_last_year = $week_last_date->format('Y');
				?>
                <div class="between custom-bg">
                    <p class="day-ma">{{$week_first_day.' '.__('frontend.'.$week_first_month).' '.$week_first_year}}  {{ __('frontend.to') }}  {{$week_last_day.' '.__('frontend.'.$week_last_month).' '.$week_last_year}} </p>
                </div>

                <div class="num-book">
                    <div class="row">
                        <!--<form action="/course/appointment/{{$tutor->id}}" method="post" enctype="multipart/form-data"
                            class="bookingForm" onsubmit="myButton2.disabled = true;">-->
                            <?php $dayOfWeek = \Carbon\Carbon::today()?>
                            @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                <div class="col innerbook">
                                    <div class="innernum active">
                                        <p class="sat active">{{substr($dayOfWeek->format('l'), 0, 3)}}</p>
                                        <div class="numb dayOfMonth"> {{$dayOfMonth}}</div>
                                        @foreach($tutor->schedule as $schedule)

                                        @if($schedule->day == $dayOfWeek->format('l'))
                                        <!--<nav class="listnum">-->
                                            <?php
                                                                            $currentTime= $schedule->start_time;
                                                                            $currentDate= $i->format('Y-m-d');
                                                                        ?>

                                            <?php $bookedFlag = false ?>
                                            <?php $passedFlag = false;
                                                                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                                        // get slot time format to conver it
                                                                        $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                        // convert from time zone to time zone saved in session
                                                                        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )
                                                                            ->setTimezone(session('currentTimeZoneName') );

                                                                        $correct_time1 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                                        ?>
                                            @foreach($bookedSlots as $bookedSlot)

                                            @if(substr($currentTime, 0, 8) == $bookedSlot->start_time && $currentDate ==
                                            $bookedSlot->date)
                                            <?php $bookedFlag = true ?>
                                            @endif
                                            {{--{{dd( \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))}}--}}
                                            @if($currentDate ==
                                            \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName')
                                            ))->format('Y-m-d') && $correct_time1 < \Illuminate\Support\Carbon::now()->
                                                timezone((session('currentTimeZoneName') ))->format('H:i:s'))
                                                {{--                                                                                    {{dd(\Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('h:i:s'))}}--}}
                                                <?php $passedFlag = true ?>
                                                {{--                                                                                    {{dd($passedFlag)}}--}}
                                                @endif
                                                @endforeach

                                                @if($bookedFlag == false)



                                                {{-- 1- get time off foreach tutor
                                                                        2- convert that time into student time zone
                                                                        3- append that time to today so you know the date
                                                                        4- check if the date inside the time off  --}}

                                                <?php
                                                                        // get tutor time zone
                                                                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                                        // get slot time format to conver it
                                                                        $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                        // convert from time zone to time zone saved in session
                                                                        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )
                                                                        ->setTimezone(session('currentTimeZoneName') );

                                                                        $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                                                                        // 1- get time off for this tutor
                                                                        // 2- convert that time into student time zone
                                                                        // 3- append that time to today so you know the date
                                                                        // 4- check if the date inside the time off
                                                                        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('start_date' , '>=' ,  \Carbon\Carbon::now()->format('Y-m-d') )->get();
                                                                        foreach ($time_offs as $time_off) {

                                                                            if($time_off != null){
                                                                                $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                                                                                $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');

                                                                                $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                                                                if( ($session_time > $start_date_time) && ($session_time < $end_date_time)){
                                                                                    // dd($start_date_time , $end_date_time , $session_time);
                                                                                    $correct_time = "";
                                                                                }
                                                                            }
                                                                        }

                                                                        ?>
                                                @if($passedFlag == false)
												<li id="ck-button" class="active" onmouseover="" style="cursor: pointer;">
													<label class="required">
														<input type="checkbox" id="checkboxSlotModal" name="slots[]" value="{{$tutor->id.','.$currentDate.','.substr($currentTime, 0, 5)}}">
														<span>{{$correct_time}}</span>
													</label>
												</li>
                                                @endif

                                                @else
                                                <!--<li class="active">Booked</li>-->
												<li id="ck-book" class="active"><label><span>{{ __('frontend.booked') }}</span></label></li>
                                                @endif
                                                <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour"))?>

                                        <!--</nav>-->
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <input name="date" type="text" id="date" value="" hidden>
                                <input name="time" type="text" id="time" value="" hidden>
                                <div><button type="submit" id="submitBooking" name="myButton2"
                                        hidden="hidden">{{ __('frontend.search') }}</button></div>
                        <?php $dayOfWeek->addDay(1) ?>
                        @if($dayOfMonth < substr(\Carbon\Carbon::now()->endOfMonth(), 8,2))
                            <?php $dayOfMonth++ ?>
                            @else
                            <?php $dayOfMonth = 1 ?>
                            @endif
							<?php $i = $i->addDay(1) ?>
                            @endwhile
                    </div>
                </div>
        </div>
        <?php $week++ ?>
        <?php $origDate->addDay(1) ?>
        @endwhile
    </div>
    <div class="p-3 text-center">
                                                    <button type="submit" class="bottom btn btn-green w-100 py-2 font-weight-bold" href="#" id="checkBtnModal">{{ __('frontend.submit') }}</button>

                                                                                                                                                </div>

                                                                    </div>
    <!-- <div class="bot-de bot-card modal_sticky_footer">
        <button type="submit" class="bottom booknow" id="checkBtnModal">Submit</button>
		<span class="bottom clo-item">Cancel </span>
    </div> -->
	</form>
</div>
</div>

@endsection
@section('footerAssets')
<script>
(function($){
$(".responsive").slick({ infinite: false, });
$(document).ready(function ()
{
	$("#checkBtnModal").click(function()
	{
		checked = $("input[id=checkboxSlotModal]:checked").length;
		if(!checked)
		{
			alert("{{ __('frontend.slots_alert') }}");
			return false;
		}
	});
});
$(".clo-item").on("click", function()
{
	$(".bookingModal").removeClass("active");
});

$(document).ready(function () {
	$("#checkBtn").click(function() {
		checked = $("input[id=checkboxSlot]:checked").length;
		if(!checked) { alert("{{ __('frontend.slots_alert') }}");
			return false;
		}
	});
});

$('.bookingData').on('click', function() {

    var time = $(this).attr('slotTime');
    var day = $('.day').text();
    var selectedDate = $(this).attr('selectedDate');
    // alert(selectedDate)
    document.getElementById("date").value = selectedDate;
    document.getElementById("time").value = time;

    currentActionURL = $('.bookingForm').attr('action');
    updatedActionURL = currentActionURL + "/" + selectedDate + "/" + time;

    $('.bookingForm').attr('action', updatedActionURL);

    //alert($('.bookingForm').attr('action'));

    $("#submitBooking").click();
    $("#submitBooking").prop("disabled", true);
})

$('.stars li').on('click', function() {
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
    }

    for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
    }

    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    } else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    // console.log(onStar);
    $('#starsValue').val(onStar);

});

$('.book-trial').on('click', function() {
    $(".slickPrev").click();
})
})(jQuery);
</script>
@endsection
