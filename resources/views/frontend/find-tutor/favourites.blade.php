@extends('frontend.layouts.layout')
@section('title', __('frontend.my_favourites'))

@section('pageContent')
{{--{{dd($favouriteTutors)}}--}}
<section class="findtutor">
    <div class="container">
        <div class="headtitle favo">
            <h1 class="title">{{ __('frontend.my_favourites') }}</h1><span class="num-to">@if(isset($favouriteTutorsCount)){{$favouriteTutorsCount}}@endif {{ __('frontend.tutors') }}</span>
        </div>
        <div class="content-all">
            @if(isset($favouriteTutors[0]))
            @php $x=0; @endphp
            @foreach($favouriteTutors as $tutor)

            <div class="tu-hover @if($x==0) firstItem show @endif">
                <div class="row">
                    <div class="col-sm-8 contenuser hoverbox">
                        <div class="itemtutor">
                            <div class="flex-box">
                                <div class="tu-photo">
                                    <div class="img">
                                        {{-- <span class="featured">{{ __('frontend.featured') }}</span>--}}
                                        @if(isset($tutor->favourite[0]))
                                        @foreach($tutor->favourite as $fav)
                                        @if(auth()->check())
                                        @if(auth()->user()->id == $fav->user_id && $tutor->id == $fav->instructor_id)
                                        <a href="#" tutor_id="{{$tutor->id}}" class="fas fa-heart red active" id="removeFav"></a>
                                        @endif
                                        @endif

                                        @endforeach
                                        @else
                                        <a href="#" id="{{$tutor->id}}" class="fas fa-heart makeFav"></a>
                                        @endif
                                        {{-- <span class="online"></span>--}}
                                        <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                        <input value="{{$tutor->id}}" class="input-group tutor_id" hidden>
                                    </div>
                                    <div class="price">{{$tutor->PricePerHour}}</div>
                                    <div class="price-to">@if($currency and trim($currency->currency) != '' and $currency->currency != NULL) {{ $currency->currency }} @else {{ __('frontend.current_currency') }} @endif/{{ __('frontend.hour') }}</div>
                                    <div class="fild bot-de bot-card">
                                        <a class="bottom book-trial bookingBottom" href="#booktrial{{$tutor->id}}" record_id="{{$tutor->id}}" tname="{{$tutor->user->fname}} {{$tutor->user->lname}}" timage="{{$tutor->user->user_img}}" data-toggle="modal">{{ __('frontend.book_now') }}</a>
                                        <a class="bottom" href="#sendmessage" record_id="{{$tutor->id}}" tname="{{$tutor->user->fname}} {{$tutor->user->lname}}" headline="{{$tutor->headline}}" timage="{{$tutor->user->user_img}}" data-toggle="modal">{{ __('frontend.send_message') }}</a>
                                    </div>
                                </div>
                                <div class="tu-content">
                                    <div class="minhead">
                                        <h3 class="title"><a style="color: #af8b62 !important;" href="/tutor/page/{{$tutor->id}}"> {{$tutor->user->fname}}
                                                {{$tutor->user->lname}}</a></h3>
                                        <div class="flag" title="{{$tutor->country_name}}">
                                            {{country($tutor->iso)->getEmoji()}}
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
                                                    <path id="Path_28769" data-name="Path 28769" d="M124.119,158.457a3.677,3.677,0,1,0,3.677,3.677A3.682,3.682,0,0,0,124.119,158.457Zm2.183,2.985-2.635,2.635a.566.566,0,0,1-.8,0l-1.007-1.007a.566.566,0,1,1,.8-.8l.606.606,2.234-2.234a.566.566,0,0,1,.8.8Zm0,0" transform="translate(-115.901 -152.485)" fill="url(#linear-gradient)"></path>
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
                                        @if(count($tutor->reviews) != 0)
                                        <?php $reviewTotalValue = 0 ?>
                                        @foreach($tutor->reviews as $review)
                                        <?php $reviewTotalValue += $review->value; ?>
                                        <?php $averageRating = round($reviewTotalValue / count($tutor->reviews)); ?>
                                        @endforeach
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
                                    <h3 class="title siz-titl">{{$tutor->headline}}.</h3>
                                    <div class="minhead towhead">
                                        @foreach($tutor->languages as $language)
                                        <div class="speaks">
                                            <p>{{ __('frontend.speaks') }} :</p>
                                            <span>{{$language->language->isoName}}</span><strong>{{$language->level->name}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.active_students') }}</h4>
                                                    <span>{{count($tutor->bookedSlots->groupBy('user_id'))}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.lessons') }}</h4><span>{{count($tutor->bookedSlots)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/review.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                <div class="con-item">
                                                    <h4 class="title">{{ __('frontend.reviews') }}</h4><span>{{count($tutor->reviews)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="headtext">
                                        <p class="textline">{{substr($tutor->detail, 0, 50)}}</p>
                                        <div class="onclick"><span class="more">+ {{ __('frontend.readMore') }}</span><span class="cancel">X {{ __('frontend.hide') }}</span></div>
                                        <p class="divhidslid"> {{substr($tutor->detail, 50, 500)}}</p>
                                    </div>
                                </div>
                                <div class="showitem"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 contenuser showbox">

                        <div class="hover-box"><i class="fas fa-caret-left arwoleft"></i>
                            @if($tutor->user->youtube_url == null)
                            <?php
                            $video = explode('.', $tutor->video);
                            ?>

                            @if(strtolower(end($video)) == 'mov')
                            <!-- if video mov-->


                            <div class="iframe">
                                <a data-fancybox href="#video">
                                    <video width="320" height="240">
                                        <source src="{{ asset('files/instructor/'.$tutor->video) }}" type="video/mp4">
                                    </video>
                                    <div class=" play-video">
                                        <div class="play-icon"></div>

                                    </div>
                                </a>
                                <video width="780" height="440" controls id="video" style="display:none;">
                                    <source src="{{ asset('files/instructor/'.$tutor->video) }}" type="video/mp4">

                                </video>
                            </div>

                            @else



                            <div class="iframe">
                                <a data-fancybox data-width="780" data-height="440" href="{{ asset('files/instructor/'.$tutor->video) }}">
                                    <!-- <img src="https://img.youtube.com/vi/VctaUNJpT6U/hqdefault.jpg" /> -->
                                    <video width="320" height="240">
                                        <source src="{{ asset('files/instructor/'.$tutor->video) }}" type="video/mp4">
                                    </video>
                                    <div class="play-video">
                                        <div class="play-icon"></div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @else


                            <?php
                            $youtube = explode('/', $tutor->user->youtube_url);
                            ?>
                            <div class="iframe">
                                <a data-fancybox data-width="780" data-height="440" href="{{$tutor->user->youtube_url}}">

                                    <img src="https://img.youtube.com/vi/{{ end($youtube) }}/hqdefault.jpg" />
                                    <div class="play-video">
                                        <div class="play-icon"></div>

                                    </div>
                                </a>
                            </div>
                            @endif

                            <p class="timezone"><i class="fas fa-globe-americas"></i>&nbsp; {{ __('frontend.tutor_content_text') }} </p>
                            <div class="calandar-wek">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="item-1-tab" data-toggle="tab" href="#item-1" role="tab" aria-controls="item-1" aria-selected="true"> </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <form action="/slots/appointment" method="get" enctype="multipart/form-data" id="slots_form_detals">
                                        @php
                                        // get tutor time zone
                                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
                                        // get tutor time off
                                        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('start_date' , '>=' , \Carbon\Carbon::now()->format('Y-m-d') )->get();

                                        if(date('D') == 'Sun') $last_sunday = date("Y-m-d", strtotime("today"));
                                        else $last_sunday = date("Y-m-d", strtotime("last Sunday"));
                                        $last_week = [
                                        'Sunday'=>$last_sunday,
                                        'Monday'=>date("Y-m-d", strtotime($last_sunday." +1 days")),
                                        'Tuesday'=>date("Y-m-d", strtotime($last_sunday." +2 days")),
                                        'Wednesday'=>date("Y-m-d", strtotime($last_sunday." +3 days")),
                                        'Thursday'=>date("Y-m-d", strtotime($last_sunday." +4 days")),
                                        'Friday'=>date("Y-m-d", strtotime($last_sunday." +5 days")),
                                        'Saturday'=>date("Y-m-d", strtotime($last_sunday." +6 days")),
                                        ];
                                        @endphp
                                        @foreach($tutor->schedule->groupBy('day') as $day => $schedule)

                                        <div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab">
                                            <div class="times-day">
                                                <h3 class="title">{{__('frontend.'.$day)}}</h3>
                                                <div class="row">
                                                    @foreach($schedule as $sch)

                                                    <!--<div class="col-sm-2 ch-item">
                                                                        <label class="chebox-time">
                                                                            <input type="checkbox" name="checkbox">
                                                                            <div class="label-text">
                                                                                <p>-->
                                                    <div class="active" id="ck-button" style="padding:9px 0px;">
                                                        <label class="required">
                                                            @php

                                                            // get slot time format to conver it
                                                            if($time_zone != null ){
                                                            $slot_time = date(" H:i:s", strtotime("$sch->start_time"));
                                                            // convert from time zone to time zone saved in session
                                                            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name)
                                                            ->setTimezone(session('currentTimeZoneName'));
                                                            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                            }else{
                                                            $correct_time = '';
                                                            }

                                                            // 1- get time off for this tutor
                                                            // 2- convert that time into student time zone
                                                            // 3- append that time to today so you know the date
                                                            // 4- check if the date inside the time off
                                                            foreach ($time_offs as $time_off) {
                                                            if($time_off != null){
                                                            $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                                                            $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');

                                                            $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                                            if( ($session_time > $start_date_time) && ($session_time < $end_date_time)){  $correct_time="" ; } } } @endphp <input type="checkbox" id="checkbox_slots_detals" name="slots[]" value="{{$tutor->id.','.$last_week[$day].','.substr($slot_time, 0, 5)}}">
                                                                <span class="label-text">{{$correct_time}}</span>
                                                        </label>
                                                    </div>
                                                    <!--</p>

                                                                            </div>
                                                                        </label>
                                                                    </div>-->
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="text-center"><button type="submit" class="bottom booknow" id="checkBtn_details">{{ __('frontend.submit') }}</button></div>
                                        <div class="text-center"><a class="bottom" href="/tutor/page/{{$tutor->id}}">{{ __('frontend.view_full_schedule') }}</a></div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @php $x++; @endphp

            <div class="box-book-trial myModal" id="#booktrial{{$tutor->id}}">
                <div class="modal-content">
                    <button class="close clo-item" type="button">
                        <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                        </svg>
                    </button>
                    <div class="photo" style="margin-top: -10px !important;"><img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" class="bookingImage" alt="" title=""></div>
                    <div class="text-center mt-4">
                        <h3 class="title">{{ __('frontend.instant_booking') }}</h3>
                        <p class="mt-2"> {{ __('frontend.tutor_slots_text') }} </p>
                    </div>
                    <!--<form action="/course/appointment/" method="post" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;">-->
                    <form action="/slots/appointment" method="get" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;" id="slots_form">
                        @csrf

                        @php
                        // get tutor time zone
                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
                        // get time off
                        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('end_date' , '>=' , \Carbon\Carbon::now()->format('Y-m-d') )->get();

                        @endphp
                        <div class="responsive">
                            <?php $week = 0 ?>
                            <?php $dayOfMonth = substr(\Carbon\Carbon::today(), 8, 2) ?>
                            <?php $origDate = \Illuminate\Support\Carbon::now() ?>
                            <?php $i = \Illuminate\Support\Carbon::now() ?>
                            @while($week < 4)
								@php
								$week_first_day = $origDate->format('d');
                                $week_first_month = $origDate->format('F');
                                $week_first_year = $origDate->format('Y');
                                $week_last_date = $origDate->addDay(6);
                                $week_last_day = $week_last_date->format('d');
                                $week_last_month = $week_last_date->format('F');
                                $week_last_year = $week_last_date->format('Y');
                                @endphp

                                <div>
                                    <div class="between">
                                        <p class="day-ma">{{$week_first_day.' '.__('frontend.'.$week_first_month).' '.$week_first_year}} {{ __('frontend.to') }} {{$week_last_day.' '.__('frontend.'.$week_last_month).' '.$week_last_year}} </p>
                                        <p class="timezone"><i class="fas fa-globe-americas"></i> {{ __('frontend.tutor_slots_week_text_1') }}</p>
                                        <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.tutor_slots_week_text_2') }}</p>
                                    </div>
                                    <div class="num-book">
                                        <div class="row">

                                            <?php $dayOfWeek = \Carbon\Carbon::today() ?>
                                            @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                                <div class="col innerbook">
                                                    <div class="innernum active">
                                                        <p class="sat active">{{__('frontend.'.$dayOfWeek->format('l'))}}</p>
                                                        <div class="numb dayOfMonth"> {{$dayOfMonth}}</div>

                                                        @foreach($tutor->schedule as $schedule)
                                                        @if($schedule->day == $dayOfWeek->format('l'))
                                                        <!--<nav class="listnum">-->
                                                        <?php
                                                        $currentTime = $schedule->getOriginal()['start_time'];
                                                        $currentDate = $i->format('Y-m-d');
                                                        ?>
                                                        @while($currentTime < $schedule->getOriginal('end_time'))
                                                            <?php $bookedFlag = false ?>
                                                            <?php $passedFlag = false;
                                                            $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                            // get slot time format to conver it
                                                            $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                            // convert from time zone to time zone saved in session
                                                            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time, $time_zone->time_zone_name)
                                                                ->setTimezone(session('currentTimeZoneName'));

                                                            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                                                            ?>
                                                            @if($currentDate == \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName') ))->format('Y-m-d') && $correct_time < \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))
                                                                <?php $passedFlag = true ?>
                                                                @endif
                                                                @foreach($tutor->bookedSlots as $bookedSlot)
                                                                @if(substr($currentTime, 0, 8) ==
                                                                $bookedSlot->getOriginal()['start_time'] &&
                                                                date('Y-m-d',strtotime(substr(\Illuminate\Support\Carbon::now(), 0,
                                                                8).$dayOfMonth)) == $bookedSlot->date)
                                                                <?php $bookedFlag = true ?>
                                                                @endif

                                                                @endforeach
                                                                @if($bookedFlag == false)


                                                                @php

                                                                if($time_zone != null ){


                                                                // get slot time format to conver it
                                                                $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                // convert from time zone to time zone saved in session
                                                                $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name )
                                                                ->setTimezone(session('currentTimeZoneName') );

                                                                $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                                }else{
                                                                $correct_time = "";
                                                                }

                                                                // 1- get time off for this tutor
                                                                // 2- convert that time into student time zone
                                                                // 3- append that time to today so you know the date
                                                                // 4- check if the date inside the time off
                                                                foreach ($time_offs as $time_off) {

                                                                if($time_off != null){
                                                                $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' .$time_off->start_time )->format('Y-m-d H:i:s');
                                                                $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' .$time_off->end_time )->format('Y-m-d H:i:s');

                                                                $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s') ;
                                                                if( ($session_time > $start_date_time) && ($session_time < $end_date_time)){ $correct_time="" ; } } } @endphp @if($passedFlag==false) <!--<li class="active bookingData" onmouseover="" style="cursor: pointer;" slotTime="{{substr($currentTime, 0, 5)}}" selectedDate="{{$currentDate}}">
                                                                    {{$correct_time}}
                                                                    </li>-->
                                                                    <li id="ck-button" class="active" onmouseover="" style="cursor: pointer;"><label class="required"><input type="checkbox" id="checkbox_slots" name="slots[]" value="{{$tutor->id.','.$currentDate.','.substr($currentTime, 0, 5)}}"><span> {{$correct_time}} </span></label></li>
                                                                    @endif
                                                                    @else
                                                                    <!--<li class="active">Booked</li>-->
                                                                    <li id="ck-book" class="active"><label><span>{{ __('frontend.booked') }}</span></label></li>
                                                                    @endif
                                                                    <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour")) ?>
                                                                    @endwhile
                                                                    <!--</nav>-->
                                                                    @endif
                                                                    @endforeach
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="submit" id="submitBooking" class="submitBooking" name="myButton" hidden="hidden">{{ __('frontend.search') }}</button>
                                                </div>
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
                        <input name="date" type="text" id="date" value="" hidden>
                        <input name="time" type="text" id="time" value="" hidden>
                        <div class="bot-de bot-card modal_sticky_footer">
                            <button type="submit" class="bottom booknow" id="checkBtn">{{ __('frontend.submit') }}</button>
                            <span class="bottom clo-item">{{ __('frontend.cancel') }} </span>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @if(isset($favouriteTutors[0]))
    <div class="modal fade" id="sendmessage" role="dialog">
        <div class="modal-dialog popreview" style="margin-top: 100px;">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <div class="photo"> <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="" title=""></div>
                <div class="text-center mt-4">
                    <h3 class="title">{{$tutor->user->fname}} {{$tutor->user->lname}}</h3>
                    <p class="mt-2">{{$tutor->headline}}</p>
                </div>
                <form action="#">
                    <div class="row">
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_fname') }}" name="Firstname" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_lname') }}" name="Lastname" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="email" placeholder="{{ __('frontend.enter_your_email') }}" name="Email" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontstaticword.Email') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <textarea class="form-control" name="description" placeholder="{{ __('frontstaticword.writeYourMessage') }}" autocomplete="off" autofocus="" required="" maxlength="300" minlength="2"></textarea>
                            <label class="floating-label">{{ __('frontstaticword.message') }}</label>
                        </div>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.send') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</section>


@endsection
@section('footerAssets')
<script>
    (function($) {
        $(document).ready(function() {
            var slots_alert = "{{ __('frontend.slots_alert') }}";
            $("#checkBtn").click(function() {
                checked = $("input[id=checkbox_slots]:checked").length;
                if (!checked) {
                    alert(slots_alert);
                    return false;
                }
            });
            $("#checkBtn_details").click(function() {
                checked = $("input[id=checkbox_slots_detals]:checked").length;
                if (!checked) {
                    alert(slots_alert);
                    return false;
                }
            });
            $(".hoverbox").on("mouseover", function() {
                $('#slots_form_detals').trigger("reset");
            });
        });
        $(".clo-item").on("click", function() {
            $(".bookingModal").removeClass("active");
            $('#slots_form').trigger("reset");
        });
        $(".bookingBottom").on("click", function() {
            $('#slots_form_detals').trigger("reset");
        });
    })(jQuery);
</script>

<!--<script>
        $('.bookingBottom').on('click', function (){
            tutorName = $(this).attr('tname');
            bookingImage = $(this).attr('timage');
            var record_id = $(this).attr('record_id');
            bookingImage = "/images/user_img/" + bookingImage;
            $("#bookingImage").attr("src",bookingImage);


            $('.bookingData').on('click', function () {
                var time = $(this).text();
                var day = $('.day').text();
                var selectedDate = $(this).attr('selectedDate');
                document.getElementById("date").value = selectedDate;
                document.getElementById("time").value = time;

                currentActionURL = $('.bookingForm').attr('action');
                updatedActionURL = currentActionURL+record_id +"/"+selectedDate+"/"+time;

                $('.bookingForm').attr('action', updatedActionURL);

                $("#submitBooking").click();
            })
        })
        $('.bookingBottom').on('click', function() {
            $(".slickPrev").click();
        })
        $('.myModal').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>-->
@endsection
