@extends('frontend.layouts.layout')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

</script>

@section('title', \Lang::get('Find Tutor'))

@section('pageContent')
@include('admin.message')
<section class="findtutor">
    <div class="container">
        <div class="headtitle">
            <h1 class="title">Browse and book an online Arabic thrpiate for a personalized Arabic lesson online
                now</h1>
            <span class="num-to">{{$tutors->total()}} thrpiates</span>
        </div>
        <div class="headtext">
            {{--<p class="textline"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet</p>--}}
            <div class="onclick"><span class="more">+ {{ __('frontstaticword.readMore') }}</span><span class="cancel">X
                    hide</span></div>
            <p class="divhidslid"> Every person trying to learn Arabic has a vision of what success looks like when
                communicating in a professional environment, for academic success or with friends and family.
                Achieve
                amazing results with one of the top Arabic teachers rated 4.8 points out of 5 from all over the
                world
                it’s really easy to find one to match your learning preferences and fit your busy schedule. Nobody
                understands students better than a personal thrpiate and it’s not that expensive to find a thrpiate
                online.
                Why choose the 1-on-1 Arabic class format? At your first class prepare to have a conversation about
                what
                you are using Arabic for and about the goals you are hoping to achieve. The teacher will listen to
                the
                way you speak to note what you are doing well, to find the problem areas and create a customized
                learning plan. Select a teacher who’s dedicated to helping each student individually. Just pick a
                teacher whose teaching style you might like and schedule a trial class for a stimulating
                conversation in
                Arabic now!</p>
        </div>
        <div class="prin-item">
            <h2 class="title">Filter by</h2>
            <form class="filter-item" action="{{route('findTutor.search')}}" method="get">
                {{--@csrf--}}
                <div class="row">
                    <div class="col-sm-2 sel-filt">
                        <select class="chosen-select" id="specialties" name="specialties[]" data-placeholder="Specialties" multiple tabindex="18">
                            @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}">{{ __('frontstaticword.'.$specialty->specialty)}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 sel-filt">
                        <div class="pr-input">
                            <input type="text" id="amount-min" name="from">
                            <input type="text" id="amount-max" name="to">
                        </div>
                        <div id="slider-range"></div>
                    </div>
                    <div class="col-sm-2 sel-filt">
                        <select class="country" data-max="" name="country[]" data-placeholder="Country" multiple="multiple" id="country_id">
                            <option></option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 sel-filt">
                        <div class="availability" id="availability">Availability
                            <div class="inner-ava">
                                <div class="times-day">
                                    <h3 class="title">Times of the day</h3>
                                    <div class="row">
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="06:00:00-09:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sunrise.png" alt="Arabia" title="Arabia">
                                                    <small>6-9</small>
                                                    <p>Morning</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="09:00:00-12:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sunrise2.png" alt="Arabia" title="Arabia">
                                                    <small>9-12</small>
                                                    <p>Late morning</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="12:00:00-15:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sun.png" alt="Arabia" title="Arabia">
                                                    <small>12-15</small>
                                                    <p>Afternoon</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="15:00:00-18:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sun.png" alt="Arabia" title="Arabia">
                                                    <small>15-18</small>
                                                    <p>Late Afternoon </p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="18:00:00-21:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sunrise3.png" alt="Arabia" title="Arabia">
                                                    <small>18-21</small>
                                                    <p>Evening</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="21:00:00-24:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/half-moon.png" alt="Arabia" title="Arabia">
                                                    <small>21-24</small>
                                                    <p>Late evening</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="00:00:00-03:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/moon.png" alt="Arabia" title="Arabia">
                                                    <small>0-3</small>
                                                    <p>Night</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="03:00:00-06:00:00">
                                                <div class="label-text"><img src="/frontAssets/images/sleep.png" alt="Arabia" title="Arabia">
                                                    <small>3-6</small>
                                                    <p>Late night</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="times-day week">
                                    <h3 class="title">Days of the week</h3>
                                    <div class="row">
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Saturday">
                                                <div class="label-text">
                                                    <p>Sat</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Sunday">
                                                <div class="label-text">
                                                    <p>Sun</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Monday">
                                                <div class="label-text">
                                                    <p>Mon</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Tuesday">
                                                <div class="label-text">
                                                    <p>Tue</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Wednesday">
                                                <div class="label-text">
                                                    <p>Wed</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Thursday">
                                                <div class="label-text">
                                                    <p>Thu</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Friday">
                                                <div class="label-text">
                                                    <p>Fri</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 sel-filt">
                        <select class="langu" data-placeholder="Language" name="Language[]" multiple="multiple" id="languages">
                            @foreach($allLanguages as $language)
                            <option value="{{$language->id}}"> {{$language->isoName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="col-sm-2 sel-filt check-item">
                                <label class="che-box">
                                    <input type="checkbox" id="nativeSpeaker" name="checkbox"><span class="label-text">Native Speaker</span>
                                </label>
                            </div> -->
                    <div class="col-sm-2 sel-filt">
                        <input class="form-control" type="text" placeholder="Search By Name" name="searchWord" id="searchBox">

                    </div>
                </div>
                <div class="filter-text">
                    <h3 class="title">Find your thrpiate</h3>
                    <div class="fil-search">
                        <div class="select-short">
                            <p>Sort by</p>
                            <select class="chosen-select" data-placeholder="Popularity" name="sort" tabindex="5" id="sort">
                                <option value=""></option>
                                <option value="Popularity">Popularity</option>
                                <option value="highestPrice">Price: highest first</option>
                                <option value="lowestPrice">Price: lowest first</option>
                                <option value="Reviews">Reviews</option>
                                <option value="Ratings">Ratings</option>
                            </select>
                        </div>

                        <!-- <form class="formsearch" action="#" method="">

                                    <input class="form-control" type="text" placeholder="Search By Name" id="searchBox">
                                </form> -->
                    </div>
                </div>
                <div class="row w-100 mt-4 align-items-center d-flex justify-content-between">
                    <div class="col-6 sel-filt check-item">
                        <label class="che-box">
                            <input type="checkbox" id="nativeSpeaker" name="checkbox"><span class="label-text">Native
                                Speaker</span>
                        </label>
                    </div>
                    <button class="btn bottom"> Search</button>

                </div>
            </form>
        </div>
        <div id="myContent">
            @php $x=0; @endphp

            @foreach($tutors as $tutor)

            <div class="tu-hover @if($x==0) firstItem show @endif">
                <div class="row">
                    <div class="col-sm-8 contenuser hoverbox">
                        <div class="itemtutor">
                            <div class="flex-box">
                                <div class="tu-photo">
                                    <div class="img">
                                        {{-- <span class="featured">Featured</span>--}}
                                        @if(isset($tutor->favourite[0]))
                                        @foreach($tutor->favourite as $fav)
                                        @if(auth()->check())
                                        @if(auth()->user()->id == $fav->user_id && $tutor->id == $fav->instructor_id)
                                        <a href="#" id="{{$tutor->id}}" class="fas fa-heart red active removeFav"></a>
                                        @endif
                                        @endif

                                        @endforeach
                                        @else
                                        <a href="#" id="{{$tutor->id}}" class="fas fa-heart makeFav"></a>
                                        @endif
                                        {{-- <span class="online"></span>--}}
                                        <a href="/tutor/page/{{$tutor->id}}">
                                            <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="Arabie" title="Arabia"> </a>
                                        <input value="{{$tutor->id}}" class="input-group tutor_id" hidden>
                                    </div>
                                    <div class="price">{{ number_format($tutor->PricePerHour * $userExchangeRate, 2, '.', '')  }}</div>
                                    <div class="price-to">{{$currency_code}}/H</div>
                                    <div class="fild bot-de bot-card">
                                        <a class="bottom book-trial bookingBottom" href="#booktrial{{$tutor->id}}" record_id="{{$tutor->id}}" tname="{{$tutor->user->fname}} {{$tutor->user->lname}}" timage="{{$tutor->user->user_img}}" data-toggle="modal">Book Now</a>
                                        <a class="bottom sendmessage" href="#" record_id="{{$tutor->id}}" tname="{{$tutor->user->fname}} {{$tutor->user->lname}}" headline="{{$tutor->headline}}" timage="{{$tutor->user->user_img}}" data-toggle="modal">Send Message</a>
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
                                            <p>speaks :</p>
                                            <span>{{$language->language->isoName}}</span><strong>{{$language->level->name}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="Arabia" title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title">Active students</h4>
                                                    <span>{{count($tutor->bookedSlots->groupBy('user_id'))}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="Arabia" title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title">Lessons</h4><span>{{count($tutor->bookedSlots)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/review.png" alt="Arabia" title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title">Reviews</h4><span>{{count($tutor->reviews)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="headtext">
                                        <p class="textline">{{substr($tutor->detail, 0, 50)}}</p>
                                        <div class="onclick"><span
                                                class="more">+{{ __('frontstaticword.readMore') }}</span><span
                                                class="cancel">X hide</span></div>
                                        <p class="divhidslid"> {{substr($tutor->detail, 50, 500)}}</p>
                                    </div>-->
                                    <div class="headtext">
                                        <p class="textline">{{$tutor->detail}}</p>
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

                            <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                local
                                timezone </p>
                            <div class="calandar-wek">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="item-1-tab" data-toggle="tab" href="#item-1" role="tab" aria-controls="item-1" aria-selected="true"> </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @php
                                    // get tutor time zone
                                    $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);
                                    // get tutor time off
                                    $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id )->where('start_date' , '>=' , \Carbon\Carbon::now()->format('Y-m-d') )->get();

                                    @endphp
                                    @foreach($tutor->schedule->groupBy('day') as $day => $schedule)

                                    <div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab">
                                        <div class="times-day">
                                            <h3 class="title">{{$day}}</h3>
                                            <div class="row">
                                                @foreach($schedule as $sch)

                                                <div class="col-sm-2 ch-item">
                                                    <label class="chebox-time">
                                                        <input type="checkbox" name="checkbox">
                                                        <div class="label-text">
                                                            <p>
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
                                                                if( ($session_time > $start_date_time) && ($session_time < $end_date_time)){ // dd($start_date_time , $end_date_time , $session_time); $correct_time="" ; } } } @endphp {{ $correct_time }} </p>

                                                        </div>
                                                    </label>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="text-center"><a class="bottom" href="/tutor/page/{{$tutor->id}}">View
                                            Full Schedule</a></div>

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
                    <div class="photo" style="margin-top: -30px !important;"><img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" class="bookingImage" alt="" title=""></div>
                    <div class="text-center mt-4">
                        <h3 class="title">Instant Booking</h3>
                        <p class="mt-2"> Check tutor's vacant hours and choose what suits you </p>
                    </div>
                    <form action="/course/appointment/" method="post" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;">
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
                            @while($week < 4) <div>
                                <div class="between">
                                    <p class="day-ma">{{substr($origDate, 0, 10) }} TO {{substr($origDate->addDay(6),0, 10)}} </p>
                                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                        local timezone
                                    </p>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice
                                        between the
                                        schedule and your first lesson</p>
                                </div>
                                <div class="num-book">
                                    <div class="row">

                                        <?php $dayOfWeek = \Carbon\Carbon::today() ?>
                                        @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                            <div class="col innerbook">
                                                <div class="innernum active">
                                                    <p class="sat active">{{substr($dayOfWeek->format('l'), 0, 3)}}</p>
                                                    <div class="numb dayOfMonth"> {{$dayOfMonth}}</div>

                                                    @foreach($tutor->schedule as $schedule)
                                                    @if($schedule->day == $dayOfWeek->format('l'))
                                                    <nav class="listnum">
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

                                                            $correct_time1 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                                                            ?>
                                                            @if($currentDate == \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName') ))->format('Y-m-d') && $correct_time1 < \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))
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
                                                                if( ($session_time > $start_date_time) && ($session_time < $end_date_time)){ // dd($start_date_time , $end_date_time , $session_time); $correct_time="" ; } } } @endphp @if($passedFlag==false) <li class="active bookingData" onmouseover="" style="cursor: pointer;" slotTime="{{substr($currentTime, 0, 5)}}" selectedDate="{{$currentDate}}">
                                                                    {{$correct_time}}
                                                                    </li>
                                                                    @endif
                                                                    @else
                                                                    <li class="active">Booked</li>
                                                                    @endif
                                                                    <?php $currentTime = date("H:i:s", strtotime("$currentTime +1 hour")) ?>
                                                                    @endwhile
                                                    </nav>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" id="submitBooking" class="submitBooking" name="myButton" hidden="hidden">Search</button>
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
                <div class="bot-de bot-card pt-0">
                    <span class="bottom clo-item">Cancel </span>

                </div>
                </form>
            </div>
        </div>
        @endforeach

        <?php echo $tutors->links('frontend.paginate'); ?>

    </div>
    </div>
</section>

<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog popreview" style="margin-top: 100px;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                </svg>
            </button>
            <div class="photo"><img src="" alt="" title="" id="timage"></div>
            <div class="text-center mt-4">
                <h3 class="title" id="tutorName"></h3>
                <p class="mt-2" id="headline"></p>
            </div>
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->fname) && Auth::user()->fname !='') hidden
                        @endif>
                        <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.fname') }}" name="fname" value="@if(isset(Auth::user()->id)){{ Auth::user()->fname }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                    </div>

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->lname) && Auth::user()->lname !='') hidden
                        @endif>
                        <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.lname') }}" name="lname" value="@if(isset(Auth::user()->id)){{ Auth::user()->lname }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                    </div>
                    <div class="col-sm-12 fild" @if(isset(Auth::user()->email) && Auth::user()->email !='') hidden
                        @endif>
                        <input class="form-control" type="email" placeholder="{{ __('frontstaticword.enter') }} {{ __('frontstaticword.your') }} {{ __('frontstaticword.email') }}" name="email" value="@if(isset(Auth::user()->id)){{ Auth::user()->email }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.email') }}</label>
                    </div>
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="message" id="messageTextArea" placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus="" required maxlength="300" minlength="2"></textarea>
                        <div class="alert alert-danger" role="alert" id="warning">
                            Please make sure you don't enter any contact details or numbers or special characters please refer to <a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a>
                        </div>
                        <label class="floating-label">{{ __('frontstaticword.message') }}</label>
                    </div>

                    <input type="text" name="recipientId" id="recipientId" readonly hidden>

                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom" id="message_submit" type="submit">{{ __('frontstaticword.send') }}</button>
                    <a class="bottom" href="#" data-dismiss="modal">Cancel </a>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection

<div class="loading">
    <div class="sk-cube-grid">
        <div class="sk-cube sk-cube1"></div>
        <div class="sk-cube sk-cube2"></div>
        <div class="sk-cube sk-cube3"></div>
        <div class="sk-cube sk-cube4"></div>
        <div class="sk-cube sk-cube5"></div>
        <div class="sk-cube sk-cube6"></div>
        <div class="sk-cube sk-cube7"></div>
        <div class="sk-cube sk-cube8"></div>
        <div class="sk-cube sk-cube9"></div>
    </div>
</div>

@section('footerAssets')

<script>
    $('.sendmessage').on('click', function() {

        tutorName = $(this).attr('tname');
        headline = $(this).attr('headline');
        timage = $(this).attr('timage');
        record_id = $(this).attr('record_id');
        //alert(record_id);
        timage = "/images/user_img/" + timage;
        msg = ' ';
        $("#tutorName").html(tutorName);
        $("#headline").html(headline);
        $("#timage").attr("src", timage);
        $("#recipientId").val(record_id);
        $("#messageTextArea").val(msg);
        $('#sendmessage').modal('show');

    })

    $('.bookingBottom').on('click', function() {

        tutorName = $(this).attr('tname');
        bookingImage = $(this).attr('timage');
        record_id = $(this).attr('record_id');
        bookingImage = "/images/user_img/" + bookingImage;
        $(".bookingImage").attr("src", bookingImage);

        $('.bookingData').on('click', function() {
            var time = $(this).attr('slotTime');
            var day = $('.day').text();
            var selectedDate = $(this).attr('selectedDate');
            document.getElementById("date").value = selectedDate;
            document.getElementById("time").value = time;

            currentActionURL = $('.bookingForm').attr('action');
            updatedActionURL = currentActionURL + record_id + "/" + selectedDate + "/" + time;

            $('.bookingForm').attr('action', updatedActionURL);

            $("#submitBooking").click();
            $(".submitBooking").prop("disabled", true);

        })

    })
    $('.bookingBottom').on('click', function() {
        $(".slickPrev").click();
    })

    $('.myModal').on('hidden.bs.modal', function() {
        location.reload();
    })

    // filter message for links , urls , numbers

    function detectURLs(message) {
        var urlRegex = /(((https?:\/\/)|(www\.))[^\s]+)/g;
        return message.match(urlRegex)
    }

    function detectNumber(number) {
        var matches = number.match(/\d+/g);
        if (matches != null) {
            return true;
        }
    }

    var searchWords = ["gmail", "outlook", "yahoo ", "hotmail", "facebook", "contact"];

    function searchStringInArray(str, strArray) {
        for (var j = 0; j < strArray.length; j++) {
            if (strArray[j].match(str)) return j;
        }
        return -1;
    }

    $(document).ready(function() {
        $("#warning").hide();
        $('#messageTextArea').keyup(function() {
            text = $('#messageTextArea').val();
            if (detectURLs(text)) {
                $("#message_submit").prop("disabled", true);
            } else {
                $("#message_submit").removeAttr('disabled');
            }

            var array_of_words = text.split(" ");

            for (var j = 0; j < array_of_words.length; j++) {
                var word = array_of_words[j].toLowerCase();
                if ((word == "@") || (detectNumber(word))) {
                    $("#warning").show();
                    $("#message_submit").prop("disabled", true);
                }
                if ((word.length > 4)) {
                    if (searchStringInArray(word, searchWords) != -1) {
                        $("#warning").show();
                        $("#message_submit").prop("disabled", true);
                    } else {
                        $("#warning").hide();
                        $("#message_submit").removeAttr('disabled');
                    }
                }
                // check for special characters
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

                if (format.test(word)) {
                    $("#warning").show();
                    $("#message_submit").prop("disabled", true);
                }
            }
        });
    });
</script>

@endsection
