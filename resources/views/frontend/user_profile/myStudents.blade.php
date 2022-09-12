@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.MyStudents'))

@section('pageContent')

@include('frontend.layouts.pages.tutor', ['page' => 'MyStudents'])

<section class="my-teachers">
    <div class="container">
        <h2 class="title">clients</h2>
        <div class="row">
            <div class="col-sm-8 teach-item">
                <form action="/myStudents/{{auth()->id()}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 fild">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="current-tab" data-toggle="tab" href="#current" role="tab" aria-controls="current" aria-selected="true">{{ __('frontend.active') }}</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" id="favourites-tab" data-toggle="tab" href="#favourites" role="tab" aria-controls="favourites" aria-selected="false">{{ __('frontend.archived') }}</a></li>--}}
                            </ul>
                        </div>
                        <div class="col-sm-6 fild">
                            <div class="formsearch">
                                <input class="form-control" type="text" name="name" id="searchBox" placeholder="{{ __('frontend.search_by_name') }}">
                                <button class="bottom" id="filterTutors" type="submit" hidden="hidden">{{ __('frontend.filter') }}</button>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="current" role="tabpanel" aria-labelledby="current-tab">
                        @foreach($activeStudents as $activeStudent)
                        <div class="item-les">
                            <div class="sec-les">
                                <div class="img"><img src="{{ url('/images/user_img/'.$activeStudent->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                            </div>
                            <div class="sec-les">
                                <div class="minhead">
                                    <h3 class="title">{{$activeStudent->fname}} {{$activeStudent->lname}}.</h3>
                                    {{-- <div class="flag" title="{{$activeStudent->country_name}}"> {{country($activeStudent->iso)->getEmoji()}}
                                </div>--}}
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
                            </div>
                            <p class="prepaid">{{ __('frontend.prepaid') }}
                                {{-- <span class="fas fa-question tooltiptext"><small>Hover over me Hover over me  Hover over me</small>--}}
                                </span>
                            </p>
                            <div class="hour">
                                <p>1 {{ __('frontend.hour') }}</p><span>{{ __('frontend.trial') }}</span>
                            </div>
                            <!--p.textsacand No prepaid lessons-->
                        </div>
                        <!--<div class="sec-les">
                                        <p class="prepaid">{{ __('frontend.price_per_hour') }}</p>
										<span class="text-price">{{$activeStudent->PricePerHour}}</span>
                                    </div>-->
                        <div class="sec-les">
                            <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">{{ __('frontend.actions') }}<span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="5.751" viewBox="0 0 11.808 6.751">
                                            <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M12.094,15.963l4.465-4.468a.84.84,0,0,1,1.192,0,.851.851,0,0,1,0,1.2l-5.059,5.062a.842.842,0,0,1-1.164.025L6.434,12.693a.844.844,0,1,1,1.192-1.2Z" transform="translate(-6.188 -11.246)" fill="#fff"></path>
                                        </svg></span></a>
                                <div class="dropdown-menu">
                                    {{-- <a class="dropdown-item" href="#"><i class="far fa-calendar-alt"></i> {{ __('frontend.archive') }}</a>--}}
                                    <a class="dropdown-item sendmessage" href="#" record_id="{{$activeStudent->id}}" timage="{{$activeStudent->user_img}}" data-toggle="modal"><i class="fas fa-comment-alt"></i> {{ __('frontend.send_message') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">--}}
                {{-- @foreach($favouriteTutors ?? '' as $favouriteTutor)--}}
                {{-- <div class="item-les">--}}
                {{-- <div class="sec-les">--}}
                {{-- <a href="/tutor/page/{{$favouriteTutor->id}}"><div class="img"><img src="{{ url('/images/user_img/'.$favouriteTutor->user->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div></a>--}}
                {{-- </div>--}}
                {{-- <div class="sec-les">--}}
                {{-- <div class="minhead">--}}
                {{-- <a href="/tutor/page/{{$favouriteTutor->id}}">--}}
                {{-- <h3 class="title">{{$favouriteTutor->user->fname}} {{$favouriteTutor->user->lname[0]}}.</h3>--}}
                {{-- </a>--}}
                {{-- <div class="flag" title="{{$favouriteTutor->country_name}}"> {{country($favouriteTutor->iso)->getEmoji()}}
            </div>--}}
            {{-- <div class="safy">--}}
            {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16.436" height="19.301" viewBox="0 0 16.436 19.301">--}}
            {{-- <defs>--}}
            {{-- <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">--}}
            {{-- <stop offset="0" stop-color="#ba9a74"></stop>--}}
            {{-- <stop offset="1" stop-color="#877456"></stop>--}}
            {{-- </linearGradient>--}}
            {{-- </defs>--}}
            {{-- <g id="surface1" transform="translate(0 0.001)">--}}
            {{-- <path id="Path_28769" data-name="Path 28769" d="M124.119,158.457a3.677,3.677,0,1,0,3.677,3.677A3.682,3.682,0,0,0,124.119,158.457Zm2.183,2.985-2.635,2.635a.566.566,0,0,1-.8,0l-1.007-1.007a.566.566,0,1,1,.8-.8l.606.606,2.234-2.234a.566.566,0,0,1,.8.8Zm0,0" transform="translate(-115.901 -152.485)" fill="url(#linear-gradient)"></path>--}}
            {{-- <path id="Path_28770" data-name="Path 28770" d="M16.417,5.236V5.221c-.008-.185-.014-.382-.017-.6a2.046,2.046,0,0,0-1.926-2A7.938,7.938,0,0,1,9.07.34L9.058.328a1.235,1.235,0,0,0-1.679,0L7.366.34a7.939,7.939,0,0,1-5.4,2.277,2.045,2.045,0,0,0-1.926,2c0,.217-.009.413-.017.6v.035a20.918,20.918,0,0,0,.845,7.635A9.72,9.72,0,0,0,3.2,16.523a12.2,12.2,0,0,0,4.563,2.7,1.413,1.413,0,0,0,.187.051,1.381,1.381,0,0,0,.543,0,1.418,1.418,0,0,0,.188-.051,12.206,12.206,0,0,0,4.558-2.7,9.733,9.733,0,0,0,2.332-3.633A20.949,20.949,0,0,0,16.417,5.236Zm-8.2,9.224a4.81,4.81,0,1,1,4.81-4.81A4.815,4.815,0,0,1,8.218,14.46Zm0,0" transform="translate(0)" fill="url(#linear-gradient)"></path>--}}
            {{-- </g>--}}
            {{-- </svg>--}}
            {{-- </div>--}}
            {{-- <ul class="rating">--}}
            {{-- <li class="fas fa-star active"></li>--}}
            {{-- <li class="fas fa-star active"></li>--}}
            {{-- <li class="fas fa-star active"></li>--}}
            {{-- <li class="fas fa-star active"></li>--}}
            {{-- </ul>--}}
            {{-- </div>--}}
            {{-- <p class="prepaid">Prepaid<span class="fas fa-question tooltiptext"><small>Hover over me Hover over me  Hover over me</small></span></p>--}}
            {{-- <div class="hour">--}}
            {{-- <p>1 hour</p><span>Trial</span>--}}
            {{-- </div>--}}
            {{-- <!--p.textsacand No prepaid lessons-->--}}
            {{-- </div>--}}
            {{-- <div class="sec-les">--}}
            {{-- <p class="prepaid">Price per hour</p><span class="text-price">{{$favouriteTutor->PricePerHour}}</span>--}}
            {{-- </div>--}}
            {{-- <div class="sec-les">--}}
            {{-- <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Actions<span>--}}
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="9" height="5.751" viewBox="0 0 11.808 6.751">--}}
            {{-- <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M12.094,15.963l4.465-4.468a.84.84,0,0,1,1.192,0,.851.851,0,0,1,0,1.2l-5.059,5.062a.842.842,0,0,1-1.164.025L6.434,12.693a.844.844,0,1,1,1.192-1.2Z" transform="translate(-6.188 -11.246)" fill="#fff"></path>--}}
            {{-- </svg></span></a>--}}
            {{-- <div class="dropdown-menu"><a class="dropdown-item" href="#"><i class="far fa-calendar-alt"></i> Schedule</a><a class="dropdown-item" href="#confirm-lesson" data-toggle="modal"><i class="fas fa-clock"></i> Buy Hours</a><a class="dropdown-item" href="#report-issue" data-toggle="modal"><i class="fas fa-comment-alt"></i> Send Message</a></div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- @endforeach--}}
            {{-- </div>--}}
        </div>
    </div>
    <div class="col-sm-4 teach-item">
        <div class="item-datals">
            <div class="mintitle">
                <h4>{{ __('frontend.students_list') }}</h4>
            </div>
            <div class="images">
                @foreach($randomStudents as $randomStudent)
                <img src="{{ url('/images/user_img/'.$randomStudent->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                @endforeach
            </div>
            {{-- <div class="find-tutors"><a href="/findTutor">Find more thrpiates</a></div>--}}
        </div>
    </div>
    </div>
    </div>
</section>
<div class="modal fade" id="transfer-credit" role="dialog">
    <div class="modal-dialog popreview">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                </svg>
            </button>
            <div class="text-center">
                <h3 class="title">{{ __('frontend.transfer_credits') }}</h3>
                <p class="mt-2">{{ __('frontend.transfer_text_1') }}</p>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                        <select class="form-control" name="zone" autocomplete="off" required>
                            <option> </option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                        </select>
                        <label class="floating-label">{{ __('frontend.transfer_credit').' '.__('frontend.from') }} </label>
                    </div>
                    <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                        <select class="form-control" name="zone" autocomplete="off" required>
                            <option> </option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                            <option>{{ __('frontend.choose').' '.__('frontend.tutor') }}</option>
                        </select>
                        <label class="floating-label">{{ __('frontend.add').' '.__('frontend.hours').' '.__('frontend.with') }}</label>
                    </div>
                    <!--div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter name" name="Tutorname"  autocomplete="off" autofocus required )
                        label.floating-label Tutor name
                        -->
                    <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                        <select class="form-control" name="Reson" autocomplete="off" required>
                            <option> </option>
                            <option>{{ __('frontend.choose') }}</option>
                            <option>{{ __('frontend.choose') }}</option>
                            <option>{{ __('frontend.choose') }}</option>
                        </select>
                        <label class="floating-label">{{ __('frontend.reason') }}</label>
                    </div>
                </div>
                <p class="textsacand mt-4"><i class="fas fa-info-circle"></i> {{ __('frontend.transfer_text_2') }} </p>
                <div class="fild bot-de bot-card">
                    <button class="bottom" type="submit">{{ __('frontend.confirm') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
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
                    <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                </svg>
            </button>
            <div class="photo"><img src="" alt="" title="" id="timage"></div>
            <div class="text-center mt-4">
                <h3 class="title" id="tutorName"></h3>
                <p class="mt-2" id="headline"></p>
            </div>
            <form action="{{ route('messages.student') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->fname) && Auth::user()->fname !='') hidden
                        @endif>
                        <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_fname') }}" name="fname" value="@if(isset(Auth::user()->id)){{ Auth::user()->fname }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                    </div>

                    <div class="col-sm-6 fild" @if(isset(Auth::user()->lname) && Auth::user()->lname !='') hidden
                        @endif>
                        <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_lname') }}" name="lname" value="@if(isset(Auth::user()->id)){{ Auth::user()->lname }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                    </div>
                    <div class="col-sm-12 fild" @if(isset(Auth::user()->email) && Auth::user()->email !='') hidden
                        @endif>
                        <input class="form-control" type="email" placeholder="{{ __('frontend.enter_your_email') }}" name="email" value="@if(isset(Auth::user()->id)){{ Auth::user()->email }}@endif" autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.Email') }}</label>
                    </div>
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="message" id="messageTextArea" placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus="" required maxlength="300" minlength="2"></textarea>
                        <div class="alert alert-danger" role="alert" id="warning">
                            {{ __('frontend.send_message_term_tip') }} <a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a>
                        </div>
                        <label class="floating-label">{{ __('frontstaticword.message') }}</label>
                    </div>

                    <input type="text" name="recipientId" id="recipientId" readonly hidden>

                </div>
                <div class="fild bot-de bot-card">
                    <button class="bottom" id="message_submit" type="submit">{{ __('frontstaticword.send') }}</button>
                    <a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('footerAssets')

<script>
    (function($) {
        $('#searchBox').on('change', function() {
            // alert('ssssssss')
            $("#filterTutors").click();

        })

        $('.sendmessage').on('click', function() {

            tutorName = $(this).attr('tname');
            headline = $(this).attr('headline');
            timage = $(this).attr('timage');
            record_id = $(this).attr('record_id');
            // alert(record_id);
            timage = "/images/user_img/" + timage;
            msg = ' ';
            $("#tutorName").html(tutorName);
            $("#headline").html(headline);
            $("#timage").attr("src", timage);
            $("#recipientId").val(record_id);
            $("#messageTextArea").val(msg);
            $('#sendmessage').modal('show');

        })

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
    })(jQuery);

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
</script>
@endsection
