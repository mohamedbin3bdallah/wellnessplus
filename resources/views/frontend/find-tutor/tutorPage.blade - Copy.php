{{--{{substr(\Illuminate\Support\Carbon::today()->addDay(6),0, 10)}}--}}
@extends('frontend.layouts.layout')
@section('title', \Lang::get('Tutor page'))

@section('pageContent')

<section class="findtutor">
    @include('admin.message')
    <div class="container">
        <div class="content-all">
            <div class="row">
                <div class="col-sm-8 contenuser findinner" id="content">
                    <div class="itemtutor">
                        <div class="flex-box">
                            <div class="tu-photo">
                                <div class="img">
                                    {{--                                    <span class="featured">Featured</span>--}}
                                    <!--a(href="#" class="fas fa-heart")-->
                                    {{--    <span class="online"></span>--}}
                                    <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="Arabia"
                                        title="Arabia">
                                </div>
                                <div class="price">
                                    {{ number_format($tutor->PricePerHour * $userExchangeRate, 2, '.', '')}}</div>
                                <div class="price-to">{{$currency_code}}/H</div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead">
                                    <h3 class="title" style="color: #af8b62 !important;">{{$tutor->user->fname}}
                                        {{$tutor->user->lname}}.</h3>
                                    <div class="flag" title="{{$tutor->country_name}}">
                                        {{country($tutor->user->country->iso)->getEmoji()}}</div>
                                    <div class="safy">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="16.436" height="19.301"
                                            viewBox="0 0 16.436 19.301">
                                            <defs>
                                                <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                                    gradientUnits="objectBoundingBox">
                                                    <stop offset="0" stop-color="#ba9a74"></stop>
                                                    <stop offset="1" stop-color="#877456"></stop>
                                                </linearGradient>
                                            </defs>
                                            <g id="surface1" transform="translate(0 0.001)">
                                                <path id="Path_28769" data-name="Path 28769"
                                                    d="M124.119,158.457a3.677,3.677,0,1,0,3.677,3.677A3.682,3.682,0,0,0,124.119,158.457Zm2.183,2.985-2.635,2.635a.566.566,0,0,1-.8,0l-1.007-1.007a.566.566,0,1,1,.8-.8l.606.606,2.234-2.234a.566.566,0,0,1,.8.8Zm0,0"
                                                    transform="translate(-115.901 -152.485)"
                                                    fill="url(#linear-gradient)"></path>
                                                <path id="Path_28770" data-name="Path 28770"
                                                    d="M16.417,5.236V5.221c-.008-.185-.014-.382-.017-.6a2.046,2.046,0,0,0-1.926-2A7.938,7.938,0,0,1,9.07.34L9.058.328a1.235,1.235,0,0,0-1.679,0L7.366.34a7.939,7.939,0,0,1-5.4,2.277,2.045,2.045,0,0,0-1.926,2c0,.217-.009.413-.017.6v.035a20.918,20.918,0,0,0,.845,7.635A9.72,9.72,0,0,0,3.2,16.523a12.2,12.2,0,0,0,4.563,2.7,1.413,1.413,0,0,0,.187.051,1.381,1.381,0,0,0,.543,0,1.418,1.418,0,0,0,.188-.051,12.206,12.206,0,0,0,4.558-2.7,9.733,9.733,0,0,0,2.332-3.633A20.949,20.949,0,0,0,16.417,5.236Zm-8.2,9.224a4.81,4.81,0,1,1,4.81-4.81A4.815,4.815,0,0,1,8.218,14.46Zm0,0"
                                                    transform="translate(0)" fill="url(#linear-gradient)"></path>
                                            </g>
                                        </svg>
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
                                <h3 class="title siz-titl">{{$tutor->headline}}.</h3>

                                <div class="minhead towhead">
                                    @foreach($tutor->languages as $language)
                                    <div class="speaks">
                                        <p>speaks :</p>
                                        <span>{{$language->language->isoName}}</span><strong>{{$language->level->name}}</strong>
                                    </div>
                                    @endforeach
                                </div>
                                @if($isFavourite == null)
                                <div id="makeFav">
                                    <a class="md-heart" href="#"><img src="/frontAssets/images/md-heart.png"
                                            alt="Arabia" title="Arabia"></a>
                                </div>
                                @else
                                <div id="removeFav">
                                    <a class="md-heart" href="#"><img src="/frontAssets/images/redHeart.png"
                                            alt="Arabia" title="Arabia"></a>
                                </div>
                                @endif

                                <!--<div class="row">
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="Arabia"
                                                title="Arabia">
                                            <input value="{{$tutor->id}}" class="input-group tutor_id" id="tutor_id"
                                                hidden>

                                            <div class="con-item">
                                                <h4 class="title">Active students</h4><span>{{count($activeStudents)}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="Arabia"
                                                title="Arabia">
                                            <div class="con-item">
                                                <h4 class="title">Lessons</h4><span>{{count($bookedSlots)}} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/review.png" alt="Arabia"
                                                title="Arabia">
                                            <div class="con-item">
                                                <h4 class="title">Reviews</h4><span>{{$reviewCounter}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <div class="childbox">
                            <h3 class="title">About Me</h3>
                            <!--<div class="headtext">
                                <p class="textline">{{substr($tutor->detail, 0, 50)}}</p>
                                <div class="onclick"><span class="more">+ Read more</span><span class="cancel">X
                                        hide</span></div>
                                <p class="divhidslid">{{substr($tutor->detail, 50, 500)}}</p>
                            </div>-->
							<div class="headtext">
								<p class="textline">{{$tutor->detail}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col std-item">
                                <ul class="list-item">
                                    <li class="great">Preferred student age</li>
                                    <li><i class="fas fa-circle"></i> {{$tutor->age}}</li>

                                </ul>
                            </div>
                            <div class="col std-item">
                                <ul class="list-item">
                                    <li class="great">Preferred level of students</li>
                                    <li><i class="fas fa-circle"></i> {{$tutor->student_level}} </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="itemtutor bord-colo">
                        <h3 class="title"> Schedule</h3>

                        <div class="responsive">
                            <?php $week = 0?>
                            <?php $dayOfMonth = substr(\Carbon\Carbon::today(), 8,2 ) ?>
                            <?php $origDate = \Illuminate\Support\Carbon::now()?>
                            <?php $i = \Illuminate\Support\Carbon::now()?>
                            @while($week < 4) <div>
                                <div class="between">
                                    <p class="day-ma">{{substr($origDate, 0, 10) }} TO
                                        {{substr($origDate->addDay(6),0, 10)}} </p>
                                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                        local timezone</p>
                                </div>
                                <div class="num-book">
                                    <div class="row">
                                        <form action="/course/appointment/{{$tutor->id}}" method="post"
                                            enctype="multipart/form-data" class="bookingForm"
                                            onsubmit="myButton.disabled = true;">
                                            @csrf
                                            <?php $dayOfWeek = \Carbon\Carbon::today()?>
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
                                                                    $currentTime= $schedule->start_time;
                                                                    $currentDate= $i->format('Y-m-d');
                                                                ?>

                                                            @while($currentTime < $schedule->end_time)
                                                                <?php $bookedFlag = false ?>
                                                                <?php $passedFlag = false ;
                                                                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                                        // get slot time format to conver it
                                                                        $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                        // convert from time zone to time zone saved in session
                                                                        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )
                                                                            ->setTimezone(session('currentTimeZoneName') );

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
                                                                        @if($passedFlag==false) <li
                                                                        class="active bookingData" onmouseover=""
                                                                        style="cursor: pointer;"
                                                                        slotTime="{{substr($currentTime, 0, 5)}}"
                                                                        selectedDate="{{$currentDate}}">
                                                                        {{ $correct_time  }}
                                                                        </li>
                                                                        @endif
                                                                        @else
                                                                        <li class="active">Booked</li>
                                                                        @endif
                                                                        <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour"))?>
                                                                        @endwhile
                                                        </nav>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <input name="date" type="text" id="date" value="" hidden>
                                                <input name="time" type="text" id="time" value="" hidden>
                                                <div><button type="submit" id="submitBooking" name="myButton"
                                                        hidden="hidden">Search</button></div>
                                        </form>
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
                </div>
                <div class="bot-show"><a class="bottom view-sce"> <span class="viw-show">View Full Scedule <i
                                class="fas fa-angle-down"></i></span></a></div>
                <div class="itemtutor reviews">
                    <div class="head-rv">
                        <div class="text-rev">
                            <h3 class="title"> Reviews</h3>
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
                            <p class="numb-rev"><span>{{$reviewCounter}}</span> Reviews</p>
                        </div>
                        @php( $hasReview = false )
                        @foreach($tutorReviews as $review)
                        @if($review->user_id == auth()->id())
                        @php( $hasReview = true )
                        @endif
                        @endforeach

                        @php( $hasConfirmedLesson = false )
                        @foreach($confirmedLessons as $confirmedLesson)
                        @if($confirmedLesson->user_id == auth()->id())
                        @php( $hasConfirmedLesson = true )
                        @endif
                        @endforeach
                        @if($hasConfirmedLesson == true && $hasReview == false)
                        <a class="add-rev" href="#addreview" data-toggle="modal"><i class="fas fa-plus"></i> Add
                            review</a>
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
                <div class="itemtutor bord-colo">
                    <h3 class="title"> Resume</h3>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="education-tab" data-toggle="tab"
                                href="#education" role="tab" aria-controls="education"
                                aria-selected="true">Education</a></li>
                        <li class="nav-item"><a class="nav-link" id="experience-tab" data-toggle="tab"
                                href="#experience" role="tab" aria-controls="experience" aria-selected="false">Work
                                experience</a></li>
                        <li class="nav-item"><a class="nav-link" id="certifications-tab" data-toggle="tab"
                                href="#certifications" role="tab" aria-controls="certifications"
                                aria-selected="false">Certifications</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="education" role="tabpanel"
                            aria-labelledby="education-tab">
                            @if(count($tutorEducations))
							@foreach($tutorEducations as $education)
                            <div class="item-edit">
                                <div class="date">{{$education->from}}-{{$education->to}}</div>
                                <div class="primary">
                                    <h5 class="title">{{$education->university}}</h5><small>{{$education->specialty}} ,
                                        {{$education->degree}}</small>
                                    {{--                                                <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                </div>
                            </div>
                            @endforeach
							@else
								{{ __('frontstaticword.noeducations') }}
							@endif

                        </div>
                        <div class="tab-pane fade " id="experience" role="tabpanel" aria-labelledby="experience-tab">
                            @if(count($tutorExperiences))
							@foreach($tutorExperiences as $experience)
                            <div class="item-edit">
                                <div class="date">{{$experience->from}}-{{$experience->to}}</div>
                                <div class="primary">
                                    <h5 class="title">{{$experience->company}}</h5><small>{{$experience->title}}</small>
                                    {{--                                                <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                </div>
                            </div>
                            @endforeach
							@else
								{{ __('frontstaticword.noexperiences') }}
							@endif
                        </div>
                        <div class="tab-pane fade " id="certifications" role="tabpanel"
                            aria-labelledby="certifications-tab">
                            @if(count($tutorCertificates))
							@foreach($tutorCertificates as $certificate)
                            <div class="item-edit">
                                <div class="date">{{$certificate->from}}-{{$certificate->to}}</div>
                                <div class="primary">
                                    <h5 class="title">{{$certificate->certificate}}</h5>
                                    <small>{{$certificate->description}}</small>
                                    {{--                                                <span class="textmap"><i class="fas fa-check"></i> Verified</span>--}}
                                </div>
                            </div>
                            @endforeach
							@else
								{{ __('frontstaticword.nocertificates') }}
							@endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 contenuser sidbar">
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
                    <div class="bot-de bot-card"><a class="bottom book-trial" href="#booktrial" data-toggle="modal">Book
                            Now</a><a class="bottom" href="#sendmessage" data-toggle="modal">Send Message </a></div>
                    <p class="timezone">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24.229" height="28.2" viewBox="0 0 24.229 28.2">
                            <linearGradient id="linear-gradient" x1="0.89" y1="0.843" x2="0.11" y2="0.173"
                                gradientUnits="objectBoundingBox">
                                <stop offset="0" stop-color="#ba9a74"></stop>
                                <stop offset="1" stop-color="#877456"></stop>
                            </linearGradient>
                            <path id="timer"
                                d="M14.048,23.2a11.286,11.286,0,0,1,20.278-8.975.415.415,0,1,0,.683-.473,12.127,12.127,0,0,0-2.768-2.849l1.2-2.089a.415.415,0,0,0-.153-.567l-1.7-.975a.415.415,0,0,0-.567.153l-1.2,2.087a12.1,12.1,0,0,0-3.39-.907V7.344h.842a.415.415,0,0,0,.415-.415V4.972a.415.415,0,0,0-.415-.415H22.8a.415.415,0,0,0-.415.415V6.929a.415.415,0,0,0,.415.415h.842V8.611a12.017,12.017,0,0,0-3.392.9l-1.2-2.085a.415.415,0,0,0-.567-.153l-1.7.975a.415.415,0,0,0-.153.567l1.2,2.089a12.122,12.122,0,0,0-4.6,12.484.415.415,0,0,0,.4.321.43.43,0,0,0,.095-.011A.415.415,0,0,0,14.048,23.2Zm17.489-15,.977.561-.96,1.671c-.317-.2-.64-.392-.975-.564ZM23.22,5.387H26.86V6.513H23.22Zm1.257,1.956H25.6v1.2c-.187-.009-.373-.018-.563-.018s-.376.006-.563.014Zm-6.91,1.422.977-.561.959,1.67q-.5.259-.976.563ZM37.154,20.644A12.114,12.114,0,0,1,15.576,28.2a.415.415,0,1,1,.648-.519,11.287,11.287,0,0,0,19.03-11.848A.415.415,0,0,1,36,15.484a12.014,12.014,0,0,1,1.15,5.159ZM15.084,25.96a.415.415,0,1,1-.732.392c-.176-.329-.338-.669-.483-1.012a.415.415,0,0,1,.765-.322C14.769,25.336,14.921,25.655,15.084,25.96ZM33.157,15.886a.4.4,0,0,0-.024-.032,9.474,9.474,0,0,0-3.346-3.328.359.359,0,0,0-.036-.026l-.042-.019a9.373,9.373,0,0,0-9.385.025l-.042.019-.032.024A9.476,9.476,0,0,0,16.923,15.9a.224.224,0,0,0-.044.077,9.374,9.374,0,0,0,.026,9.385.411.411,0,0,0,.019.042c.005.009.013.016.019.024a9.474,9.474,0,0,0,3.35,3.336.4.4,0,0,0,.036.026c.01.006.022.008.032.014a9.376,9.376,0,0,0,9.405-.027c.01,0,.021-.007.031-.013a.354.354,0,0,0,.032-.024,9.476,9.476,0,0,0,3.335-3.355c.006-.009.014-.016.02-.026a.342.342,0,0,0,.019-.042,9.374,9.374,0,0,0-.026-9.385A.383.383,0,0,0,33.157,15.886ZM29.728,27.821l-.533-.909a.415.415,0,1,0-.716.42l.534.911a8.516,8.516,0,0,1-3.558.968V28.152a.415.415,0,0,0-.83,0v1.059a8.513,8.513,0,0,1-3.514-.947l.529-.914a.415.415,0,1,0-.719-.416l-.528.913a8.644,8.644,0,0,1-2.53-2.516l.91-.533a.415.415,0,1,0-.42-.716l-.911.534a8.516,8.516,0,0,1-.968-3.558h1.059a.415.415,0,1,0,0-.83H16.473a8.516,8.516,0,0,1,.947-3.515l.914.529a.415.415,0,1,0,.416-.719l-.913-.528a8.644,8.644,0,0,1,2.516-2.529l.533.91a.415.415,0,1,0,.716-.42l-.534-.911a8.511,8.511,0,0,1,3.558-.968v1.059a.415.415,0,1,0,.83,0V12.076a8.516,8.516,0,0,1,3.515.946l-.53.914a.415.415,0,1,0,.719.416l.528-.914a8.644,8.644,0,0,1,2.53,2.517l-.91.533a.415.415,0,1,0,.42.716l.912-.534a8.519,8.519,0,0,1,.968,3.558H32.548a.415.415,0,1,0,0,.83h1.059a8.516,8.516,0,0,1-.947,3.514l-.914-.529a.415.415,0,0,0-.416.719l.913.528A8.643,8.643,0,0,1,29.728,27.821ZM31.3,20.643a.415.415,0,0,0-.415-.415h-4a1.9,1.9,0,0,0-1.434-1.434v-4a.415.415,0,0,0-.83,0v4a1.9,1.9,0,1,0,2.264,2.264h4a.415.415,0,0,0,.415-.415ZM25.04,21.709a1.066,1.066,0,1,1,1.066-1.066A1.066,1.066,0,0,1,25.04,21.709Z"
                                transform="translate(-12.925 -4.557)" fill="url(#linear-gradient)"></path>
                        </svg>Usually response in: 5 hrs
                    </p>
                </div>
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
            <h3 class="title">Add Review</h3>
            <form action="/reviewrating" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="row">
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="review" placeholder="Add your review" autocomplete="off"
                            autofocus="" required="required" minlength="2" maxlength="500"></textarea>
                        <label class="floating-label">Review</label>
                    </div>
                    @if(auth()->check())
                    <input type="text" name="userId" value="{{auth()->user()->id}}" hidden>
                    @endif
                    <input type="text" name="tutorId" value="{{$tutor->id}}" hidden>
                    <input type="text" name="starsValue" id="starsValue" value="starsValue" hidden>
                    <div class="col-sm-12 fild">
                        <h3 class="title charact">characteristics of a tutor</h3>
                        <div class="row">
                            <div class="col">
                                <div class="rev-item" name="">
                                    <p>Effectiveness</p>
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
                                    <p>Methodology</p>
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
                                    <p>Motivation</p>
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
                                    <p>Interpersonal skills</p>
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
                                    <p>Strictness</p>
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
                                    <p>Punctuality</p>
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
                    <button class="bottom" type="submit">Post Review</button><a class="bottom" href="#"
                        data-dismiss="modal">Cancel </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog popreview" style="margin-top: 100px;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                        fill="#000"></path>
                </svg>
            </button>
            <div class="photo"> <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="" title=""></div>
            <div class="text-center mt-4">
                <h3 class="title">{{$tutor->user->fname}} {{$tutor->user->lname}}</h3>
                <p class="mt-2">{{$tutor->headline}}</p>
            </div>
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->fname) && Auth::user()->fname !='') hidden
                        @endif>
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.fname') }}"
                            name="fname" value="@if(isset(Auth::user()->id)){{ Auth::user()->fname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                    </div>

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->lname) && Auth::user()->lname !='') hidden
                        @endif>
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.lname') }}"
                            name="lname" value="@if(isset(Auth::user()->id)){{ Auth::user()->lname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                    </div>
                    <div class="col-sm-12 fild" @if(isset(Auth::user()->email) && Auth::user()->email !='') hidden
                        @endif>
                        <input class="form-control" type="email"
                            placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.email') }}"
                            name="email" value="@if(isset(Auth::user()->id)){{ Auth::user()->email }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.email') }}</label>
                    </div>
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="message"
                            placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus=""
                            required="" maxlength="300" minlength="2"></textarea>
                        <label class="floating-label">{{ __('frontstaticword.message') }}</label>
                    </div>

                    <input type="text" name="recipientId" value="{{ $tutor->id }}" hidden readonly>

                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom" type="submit">{{ __('frontstaticword.send') }}</button> <a class="bottom"
                        href="#" data-dismiss="modal">Cancel </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="box-book-trial" id="#booktrial">
    <div class="modal-content">
        <button class="close clo-item" type="button">
            <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                    fill="#000"></path>
            </svg>
        </button>
        <div class="photo"> <img src="{{url('/images/user_img/'.$tutor->user->user_img)}}" alt="" title=""></div>
        <div class="text-center mt-4">
            <h3 class="title">Instant Booking</h3>
            <p class="mt-2"> Check tutor's vacant hours and choose what suits you </p>
        </div>
        <div class="responsive">
            <?php $week = 0?>
            <?php $dayOfMonth = substr(\Carbon\Carbon::today(), 8,2 ) ?>
            <?php
                                $origDate = \Illuminate\Support\Carbon::now();
                                $i = \Illuminate\Support\Carbon::now();
                                //dd($tutor->schedule);
                            ?>

            @while($week < 4) <div>
                <div class="between">
                    <p class="day-ma">{{substr($origDate, 0, 10) }} TO {{substr($origDate->addDay(6),0, 10)}} </p>
                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your local timezone</p>
                </div>
                <div class="num-book">
                    <div class="row">
                        <form action="/course/appointment/{{$tutor->id}}" method="post" enctype="multipart/form-data"
                            class="bookingForm" onsubmit="myButton2.disabled = true;">
                            @csrf
                            <?php $dayOfWeek = \Carbon\Carbon::today()?>
                            @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                <div class="col innerbook">
                                    <div class="innernum active">
                                        <p class="sat active">{{substr($dayOfWeek->format('l'), 0, 3)}}</p>
                                        <div class="numb dayOfMonth"> {{$dayOfMonth}}</div>
                                        @foreach($tutor->schedule as $schedule)

                                        @if($schedule->day == $dayOfWeek->format('l'))
                                        <nav class="listnum">
                                            <?php
                                                                            $currentTime= $schedule->start_time;
                                                                            $currentDate= substr($i,0, 8).$dayOfMonth;
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
                                                <li class="active bookingData" onmouseover="" style="cursor: pointer;"
                                                    slotTime="{{substr($currentTime, 0, 5)}}"
                                                    selectedDate="{{$currentDate}}">{{$correct_time}}

                                                </li>
                                                @endif

                                                @else
                                                <li class="active">Booked</li>
                                                @endif
                                                <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour"))?>

                                        </nav>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <input name="date" type="text" id="date" value="" hidden>
                                <input name="time" type="text" id="time" value="" hidden>
                                <div><button type="submit" id="submitBooking" name="myButton2"
                                        hidden="hidden">Search</button></div>
                        </form>
                        <?php $dayOfWeek->addDay(1) ?>
                        @if($dayOfMonth < substr(\Carbon\Carbon::now()->endOfMonth(), 8,2))
                            <?php $dayOfMonth++ ?>
                            @else
                            <?php $dayOfMonth = 1 ?>
                            @endif
                            @endwhile
                            <?php $i = $i->addDay(1) ?>
                    </div>
                </div>
        </div>
        <?php $week++ ?>
        <?php $origDate->addDay(1) ?>
        @endwhile
    </div>
    <div class="bot-de bot-card pt-0">
        <a class="bottom" href="#" data-dismiss="modal">Cancel </a>
    </div>
</div>
</div>

@endsection
@section('footerAssets')
<script>
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


$('#makeFav').click(function() {
    var tutor_id = $("#tutor_id").val();
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
        }
    })
})
$('#removeFav').click(function() {
    var tutor_id = $("#tutor_id").val();
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
</script>
@endsection
