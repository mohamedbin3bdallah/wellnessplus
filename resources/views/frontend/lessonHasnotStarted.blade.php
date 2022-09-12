@extends('frontend.layouts.layout')
@section('title', __('frontend.lesson_has_not_started'))

@section('pageContent')
<section class="findtutor">
    @include('admin.message')
    <div class="container" style="height: 100% !important;">

        @if($sessionPassed == 1)
        <h2 style="margin-left: 120px ;margin-bottom: 70px">
            {{ __('frontend.lesson_has_not_started_text_1') }}
        </h2>
        @else
        <h2 style="margin-left: 120px ;margin-bottom: 70px">
            {{ __('frontend.lesson_has_not_started_text_2') }}
        </h2>
        <br>
        <?php

        $time_zone = \App\Time_zone::find($appointment->time_zone_id);
        // get slot time format to conver it

        $slot_time = date(" H:i:s", strtotime("$appointment->start_time"));
        // convert from time zone to time zone saved in session
        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time,  $time_zone->time_zone_name)
            ->setTimezone(session('currentTimeZoneName'));
        $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i:s');
        ?>
        <h3 style=" margin-left: 300px ;margin-bottom: 70px;color: #af8b62">
            {{ __('frontend.start_at') }} {{$correct_time}}
        </h3>
        <br>
        <h4 style="margin-left: 120px ;margin-bottom: 70px">
            {{ __('frontend.lesson_has_not_started_text_3') }}
            @if(Auth::User()->role == "instructor")

            <a style="color: #af8b62" href="/tutor/lessons/{{auth()->id()}}">
                {{ __('frontstaticword.MyLessons') }}
            </a>
            @else
            <a style="color: #af8b62" href="{{route('myTeachers.show',Auth::User()->id)}}">
                {{ __('frontstaticword.MyTutors') }}
            </a>
            @endif
        </h4>
        @endif
    </div>
</section>



@endsection
@section('footerAssets')

@endsection
