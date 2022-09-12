@extends('frontend.layouts.layout')
@section('title', __('frontend.reschedule'))

@section('pageContent')
<section class="my-teachers">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 teach-item">
                <div class="item-les remaining">
                    <div class="sec-les">
                        <div class="img"><img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                        <p>{{ __('frontend.your_remaining_balance') }} <br />{{ __('frontend.with') }} {{$tutor->user->fname}} {{$tutor->user->lname[0]}}.</p>
                        <h4 class="title">1 {{ __('frontend.hour') }}</h4><a class="bottom" href="#buy-hours" data-toggle="modal">{{ __('frontend.buy_hours') }}</a>
                    </div>
                    <form action="#">
                        <div class="fild"><i class="fas fa-chevron-down iconsel"></i>
                            <select class="form-control" name="hour" autocomplete="off" required>
                                <option> </option>
                                <option value="1">1 {{ __('frontend.hour') }}</option>
                                <option value="2">2 {{ __('frontend.hour') }}</option>
                                <option value="3">3 {{ __('frontend.hour') }}</option>
                                <option value="4">4 {{ __('frontend.hour') }}</option>

                            </select>
                            <label class="floating-label">{{ __('frontend.lesson_duration') }} </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-7 teach-item">
                <div class="row">
                    <div class="col-sm-6 fild">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="true">{{ __('frontend.one_by_one') }}</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" id="one-by-one-tab" data-toggle="tab" href="#one-by-one" role="tab" aria-controls="one-by-one" aria-selected="false">{{ __('frontend.weekly') }}</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                        <div class="item-les user-dat">
                            <div class="responsive">
                                <?php $week = 0 ?>
                                <?php $dayOfMonth = substr(\Carbon\Carbon::today(), 8, 2) ?>
                                <?php
                                $origDate = \Illuminate\Support\Carbon::now();
                                $i = \Illuminate\Support\Carbon::now();
                                ?>

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
                                        <p class="day-ma">{{ $week_first_day.' '.__('frontend.'.$week_first_month).' '.$week_first_year}}  {{ __('frontend.to') }}  {{$week_last_day.' '.__('frontend.'.$week_last_month).' '.$week_last_year }} </p>
                                        <p class="timezone"><i class="fas fa-globe-americas"></i>&nbsp; {{ __('frontend.tutor_content_text') }}</p>
                                    </div>
                                    <div class="num-book">
                                        <div class="row">
                                            <form action="/course/appointment/{{$tutor->id}}" method="post" enctype="multipart/form-data" class="bookingForm" onsubmit="myButton.disabled = true;">
                                                @csrf
                                                <?php $dayOfWeek = \Carbon\Carbon::today() ?>
                                                @while($dayOfWeek < \Carbon\Carbon::today()->addDay(7))
                                                    <div class="col innerbook">
                                                        <div class="innernum active">
                                                            <p class="sat active">{{ __('frontend.'.$dayOfWeek->format('l')) }}</p>
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
                                                                    $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                                    // get slot time format to conver it
                                                                    $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                    // convert from time zone to time zone saved in session
                                                                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time, $time_zone->time_zone_name)
                                                                        ->setTimezone(session('currentTimeZoneName'));

                                                                    $correct_time1 = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                                    ?>
                                                                    @foreach($bookedSlots as $bookedSlot)

                                                                    @if(substr($currentTime, 0, 8) == $bookedSlot->start_time && $currentDate == $bookedSlot->date)
                                                                    <?php $bookedFlag = true ?>
                                                                    @endif
                                                                    @if($currentDate == \Illuminate\Support\Carbon::today()->timezone((session('currentTimeZoneName') ))->format('Y-m-d') && $correct_time1 < \Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('H:i:s'))
                                                                        {{-- {{dd(\Illuminate\Support\Carbon::now()->timezone((session('currentTimeZoneName') ))->format('h:i:s'))}}--}}
                                                                        <?php $passedFlag = true ?>
                                                                        {{-- {{dd($passedFlag)}}--}}
                                                                        @endif
                                                                        @endforeach

                                                                        @if($bookedFlag == false)



                                                                        <?php
                                                                        // get tutor time zone
                                                                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                                                                        // get slot time format to conver it
                                                                        $slot_time = date(" H:i:s", strtotime("$currentTime"));

                                                                        // convert from time zone to time zone saved in session
                                                                        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time, $time_zone->time_zone_name)
                                                                            ->setTimezone(session('currentTimeZoneName'));

                                                                        $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                                                        $slotTime = \Carbon\Carbon::parse($currentTime)->format('H:i');

                                                                        // 1- get time off for this tutor
                                                                        // 2- convert that time into student time zone
                                                                        // 3- append that time to today so you know the date
                                                                        // 4- check if the date inside the time off
                                                                        $time_offs = \App\TutorTimeOff::where('tutor_id', $tutor->id)->where('start_date', '>=',  \Carbon\Carbon::now()->format('Y-m-d'))->get();
                                                                        foreach ($time_offs as $time_off) {

                                                                            if ($time_off != null) {
                                                                                $start_date_time = \Carbon\Carbon::parse($time_off->start_date . ' ' . $time_off->start_time)->format('Y-m-d H:i:s');
                                                                                $end_date_time = \Carbon\Carbon::parse($time_off->end_date . ' ' . $time_off->end_time)->format('Y-m-d H:i:s');

                                                                                $session_time = \Carbon\Carbon::parse($currentDate . ' ' . $correct_time)->format('Y-m-d H:i:s');
                                                                                if (($session_time > $start_date_time) && ($session_time < $end_date_time)) {
                                                                                    // dd($start_date_time , $end_date_time , $session_time);
                                                                                    $correct_time = "";
                                                                                }
                                                                            }
                                                                        }

                                                                        ?>
                                                                        @if($passedFlag == false)

                                                                        <li class="active bookingData" onmouseover="" style="cursor: pointer;" selectedDate="{{substr($i,0, 8)}}{{$dayOfMonth}}" selectedTime="{{$slotTime}}">{{$correct_time}}</li>
                                                                        @endif

                                                                        @else
                                                                        <li class="active">{{ __('frontend.booked') }}</li>
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
                                                    <input name="old_lesson_id" type="text" value="{{$lesson->id}}" hidden>

                                                    <div><button type="submit" id="submitBooking" name="myButton" hidden="hidden">{{ __('frontend.search') }}</button></div>
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
                    <!--<div class="bot-de bot-card"> <a class="bottom" href="#confirm-time" data-toggle="modal">Confirm New Time</a><a class="bottom" href="#">Cancel </a></div>-->
                </div>
                <div class="tab-pane fade" id="one-by-one" role="tabpanel" aria-labelledby="one-by-one-tab">
                    <div class="item-les user-dat">222</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="modal fade" id="buy-hours" role="dialog">
    <div class="modal-dialog buy-item">
        <div class="modal-content">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <div class="text-center">
                    <h3 class="title">{{ __('frontend.myteachers_text_1') }} <br />{{ __('frontend.myteachers_text_2') }}</h3>
                </div>
                <div class="buyhours">
                    @foreach($packages as $package)
                    <form action="/student/package/cart/{{$tutor->id}}/{{$package->id}}" method="get">
                        @csrf
                        <input type="hidden" name="tutor_id" value="{{$tutor->id}}" />
                        <input type="hidden" name="package_id" value="{{$package->id}}" />

                        <div class="item-buyhours"><img src="/images/icons/{{$package->icon}}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                            <h5 class="title">{{$package->name}}</h5>
                            <div class="hours-text">
                                <p>{{$package->numOfHours}}</p><span>{{ __('frontend.hours') }}</span>
                            </div>
                            <p class="number">{{ ($tutor->PricePerHour - (($tutor->PricePerHour * $package->discountPercentage) / 100))}} @if($currency and trim($currency->currency) != '' and $currency->currency != NULL) {{ $currency->currency }} @else {{ __('frontend.current_currency') }} @endif {{ __('frontend.per_hour') }}</p>
                            <p class="green">{{ __('frontend.you_save') }} {{ ($tutor->PricePerHour * $package->numOfHours) -(($tutor->PricePerHour - (($tutor->PricePerHour * $package->discountPercentage) / 100)) * $package->numOfHours)}} @if($currency and trim($currency->currency) != '' and $currency->currency != NULL) {{ $currency->currency }} @else {{ __('frontend.current_currency') }} @endif</p>

                            <button type="submit" class="bottom">{{ __('frontend.choose') }} </button>
                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="fild bot-de bot-card">
                    <p class="text-ho"><img src="/frontAssets/images/text-ho.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"> {{ __('frontend.myteachers_text_3') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerAssets')
<script>
    (function($) {
        $('.bookingData').on('click', function() {

            //var time = $(this).text();
            var time = $(this).attr('selectedTime');
            var day = $('.day').text();
            var selectedDate = $(this).attr('selectedDate');
            //alert(time)
            document.getElementById("date").value = selectedDate;
            document.getElementById("time").value = time;

            currentActionURL = $('.bookingForm').attr('action');
            updatedActionURL = currentActionURL + "/" + selectedDate + "/" + time;

            $('.bookingForm').attr('action', updatedActionURL);

            //alert($('.bookingForm').attr('action'));

            $("#submitBooking").click();

        })
    })(jQuery);
</script>
@endsection
