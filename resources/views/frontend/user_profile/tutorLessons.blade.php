@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.MyLessons'))

@section('pageContent')

@include('frontend.layouts.pages.tutor', ['page' => 'MyLessons'])

<section class="lessons">
    <div class="container">
        <h2 class="title">{{ __('frontstaticword.MyLessons') }}</h2>
        <div class="row">
            <div class="col-sm-8 less-item">
                <form action="/tutor/lessons/{{auth()->id()}}" method="post">
                    @csrf
                    <div class="row" id="filterLessons">
                        <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i>
                            <select class="form-control" name="status_id" autocomplete="off" required>
                                <option value="all">{{ __('frontend.all') }}</option>
                                @foreach($appointments_status as $appointment_status)
                                <option value="{{$appointment_status->id}}" @if($appointment_status->id ==
                                    $request->status_id) selected @endif>{{$appointment_status->status}}</option>
                                @endforeach
                            </select>
                            <label class="floating-label">{{ __('frontend.status') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <div class="formsearch">
                                <input class="form-control" id="searchBox" name="name" type="text" placeholder="{{ __('frontend.search_by_name') }}">
                            </div>
                        </div>
                    </div>
                    <button class="bottom" id="filter" type="submit" hidden="hidden">{{ __('frontend.filter') }}</button>

                </form>
                @foreach($lessons as $lesson)
                {{-- fix lessons and images  --}}
                <div class="item-les">
                    <div class="sec-les">
                        <div class="img"><img src="{{ $lesson->user_img ? url('/images/user_img/'.$lesson->user_img) : url('/images/general.png') }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                        <h4 class="name">{{$lesson->fname}} {{$lesson->lname}}.</h4>
                    </div>
                    <div class="sec-les">
                        <h4 class="title">
                            @if($lesson->status == "Confirmed")
                            Done
                            @else
                            {{$lesson->status}}
                            @endif
                        </h4>
                        <ul class="rating">
                            @if(isset($lesson->review->value))
                            @if($lesson->review->value == 1)
                            <li class="fas fa-star active"></li>
                            @elseif($lesson->review->value == 2)
                            <li class="fas fa-star active"></li>
                            <li class="fas fa-star active"></li>
                            @elseif($lesson->review->value == 3)
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            @elseif($lesson->review->value == 4)
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            @endif
                            @endif
                        </ul><span class="text-date">{{ $lesson->date .' '. $lesson->start_time  }}
                        </span>
                        {{-- @if($lesson->status == "Cancelled")--}}
                        {{-- <p class="textsacand"><i class="fas fa-info-circle"></i>  The lesson was cancelled because of </p>--}}
                        {{-- @endif--}}
                    </div>
                    <div class="sec-les">
                        <h4 class="title">{{ __('frontend.details') }}</h4><span class="text-date">1 {{ __('frontend.hour') }}</span>
                        <!--<span class="text-price">{{$tutor->PricePerHour}} USD</span>-->
                    </div>
                    <div class="sec-les">
                        @if($lesson->status != "Confirmed")

                        <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">{{ __('frontend.actions') }}<span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="5.751" viewBox="0 0 11.808 6.751">
                                        <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M12.094,15.963l4.465-4.468a.84.84,0,0,1,1.192,0,.851.851,0,0,1,0,1.2l-5.059,5.062a.842.842,0,0,1-1.164.025L6.434,12.693a.844.844,0,1,1,1.192-1.2Z" transform="translate(-6.188 -11.246)" fill="#fff"></path>
                                    </svg></span></a>
                            <div class="dropdown-menu">
                                {{--<a class="dropdown-item" href=""><i class="far fa-calendar-alt"></i> {{ __('frontend.reschedule') }}</a>--}}
                                @if($lesson->status != "Confirmed" && $lesson->status != "Cancelled")
                                <a class="dropdown-item cancelLesson" href="#cancel-lesson" data-toggle="modal"><i class="far fa-times-circle"></i>{{ __('frontend.cancel') }}</a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-sm-4 less-item">
                <div class="item-datals">
                    @if(isset($nextLesson))
                    @foreach($nextLesson as $next)
                    <div class="lesson-user">
                        <p class="text-les">{{ __('frontend.next_lesson') }} : <span>
                                {{ $next->date . ' ' . $next->start_time }}
                                {{ __('frontend.with') }}</span></p>
                        <div class="img"><img src="{{ $lesson->user_img ? url('/images/user_img/'.$lesson->user_img) : url('/images/general.png') }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                            <p>{{$next->fname}} {{$next->lname}}. </p>
                        </div>


                    </div>
                    @if(isset($next->meetingId))
                    <div class="text-center"><a class="btn btn-info enter_class" style="color:#fff;background-image:-webkit-linear-gradient(top, #b1936f, #8a7658);border:0px;border-radius:60px;" target="_blank" href="/bigblue/api/create/meeting/{{$next->meetingId}}">{{ __('frontend.enter_classroom') }}</a></div>
                    <!--<div class="text-center"><a class="view-Profile" target="_blank"
                                href="/bigblue/api/create/meeting/{{$next->meetingId}}">Enter Classroom</a></div>-->
                    @endif
                    @endforeach
                    @endif
                </div>
                <div class="item-datals">
                    <h4 class="title">{{ __('frontend.lessons_overview') }}</h4>
                    <ul class="last-overview">
                        <li><span>{{$Scheduled_lessons_counter}}</span> {{ __('frontend.scheduled') }}</li>
                        <li><span>0</span> {{ __('frontend.need_scheduling') }}</li>
                        <li><span>0</span> {{ __('frontend.past') }} </li>
                    </ul>
                </div>
                <div class="item-datals" id="calender">
                    <h4 class="title">{{ __('frontend.calendar') }}</h4>
                    <div class="myCalendar"></div>
                    <!-- <div class="prsonal"><i class="fas fa-dot-circle"></i>
                        <div class="inner-prso lessonByDate">

                        </div>
                    </div> -->
                    <div class="prsonal"><i class="fas fa-dot-circle"></i>
                        <div class="inner-prso lessonByDate">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="cancel-lesson" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <div class="textpopup">
                    <h3 class="title">{{ __('frontend.cancel_the_lesson') }}</h3>
                    <p class="text">{{ __('frontend.cancel_the_lesson_text') }}</p>
                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom" type="submit">{{ __('frontend.cancel') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.reschedule') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="report-issue" role="dialog">
    <div class="modal-dialog popreview">
        <div class="modal-content">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.report_issue_to_teacher') }}</h3><small>{{ __('frontend.report_issue_to_teacher_text') }}</small>
                <form action="#">
                    <p class="occurred">{{ __('frontend.select_issue') }}</p>
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_1') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_2') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_3') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_4') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_5') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="checkbox"><span class="label-text">{{ __('frontend.student_lesson_issue_6') }} </span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <textarea class="form-control" name="description" placeholder="{{ __('frontend.write_comment_here') }}" autocomplete="off" autofocus="" required=""></textarea>
                            <label class="floating-label">{{ __('frontend.issue_comment') }} </label>
                        </div>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontend.send') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-lesson" role="dialog">
    <div class="modal-dialog popreview" style="margin-top: 100px;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                </svg>
            </button>
            <div class="photo"> <img src="" id="timage" alt="" title=""></div>
            <div class="text-center mt-4" id="record_id">
                <h3 class="title">{{ __('frontend.lesson_review') }}</h3>
                <p class="mt-2"> {{ __('frontend.lesson_review_text') }}</p>
            </div>
            <form action="#">
                <div class="rev-item lessonprve">
                    <ul class="stars">
                        <li class="star" title="" data-value="1"><i class="far fa-star"></i></li>
                        <li class="star" title="" data-value="2"><i class="far fa-star"></i></li>
                        <li class="star" title="" data-value="3"><i class="far fa-star"></i></li>
                        <li class="star" title="" data-value="4"><i class="far fa-star"></i></li>
                        <li class="star" title="" data-value="5"><i class="far fa-star"></i></li>
                    </ul>
                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom confirm" type="submit" value="">{{ __('frontend.send') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('footerAssets')


<script>
    (function($) {
        $('#filterLessons, #searchBox').on('change', function() {
            $("#filter").click();
        })

        $('.confirmLesson').on('click', function() {

            tutorName = $(this).attr('tname');
            timage = $(this).attr('timage');
            record_id = $(this).attr('record_id');
            timage = "/images/user_img/" + timage;
            $("#tutorName").html(tutorName);
            $("#timage").attr("src", timage);

            $('.confirm').on('click', function() {
                // alert(record_id)
                $.ajax({
                    url: "/api/confirmLesson",
                    type: "POST",
                    data: {
                        record_id: record_id
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
        })


        $('.cancelLesson').on('click', function() {
            record_id = $(this).attr('record_id');

            $('.cancelButton').on('click', function() {
                $('.cancelButton').prop('disabled', true);
                $('#reschduleBtn').fadeOut(300);;

                $.ajax({
                    url: "/api/cancelLesson",
                    type: "POST",
                    data: {
                        record_id: record_id
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == '1') {
                            location.reload();
                        } else {
                            alert(data.Error);

                        }
                        $('.cancelButton').prop('disabled', false);
                        $('#reschduleBtn').fadeIn(300);;

                    },
                    error: function() {
                        alert('System Error');
                        $('.cancelButton').prop('disabled', false);
                        $('#reschduleBtn').fadeIn(300);;
                    }
                })
            })
        })
    })(jQuery);
</script>
@endsection
