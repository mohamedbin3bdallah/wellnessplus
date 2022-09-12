@extends('frontend.layouts.layout')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
</script>
@section('title', __('frontstaticword.FindATutor'))
@section('pageContent')
@include('admin.message')
<section class="findtutor list-view">
    <div class="container-fluid">
        <div class="headtitle">
            <h1 class="title">{{ __('frontend.find_a_tutor_text') }}</h1>
            <span class="num-to">{{$tutors->total()}} {{ __('frontend.tutors') }}</span>
        </div>
        <div class="headtext">
            {{--<p class="textline"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet</p>--}}
            <div class="onclick"><span class="more">+ {{ __('frontend.readMore') }}</span><span class="cancel">X {{ __('frontend.hide') }}</span></div>
            <p class="divhidslid"> {{ __('frontend.find_a_tutor_description') }}</p>
        </div>
        <div class="prin-item">
            <form class="filter-item" action="{{route('findTutor.search')}}" method="get">
                {{--@csrf--}}
                <div class="filter-fields ">
                    <div class="row">
                        <div class="col-sm-2 sel-filt" style="max-width:25%;">
                            <select class="chosen-select" id="specialties" name="specialties[]"
                                data-placeholder="{{ __('frontstaticword.Specialties') }}" multiple tabindex="18">
                                @foreach($specialties as $specialty)
                                <option value="{{$specialty->id}}" @if(!empty(request()->specialties) &&
                                    in_array($specialty->id,request()->specialties)) {{'selected'}}
                                    @endif>{{ __('frontstaticword.'.$specialty->specialty)}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 sel-filt " style="max-width:25%;">
                            <div class="pr-input">
                                @php
                                $min = 0;
                                $max = 100;
                                if(isset(request()->from)) $min = substr(request()->from,0,strpos(request()->from, '
                                '));
                                if(isset(request()->to)) $max = substr(request()->to,0,strpos(request()->to, ' '));
                                @endphp
                                <input type="text" id="amount-min" name="from" value="{{$min}}">
                                <input type="text" id="amount-max" name="to" value="{{$max}}">
                            </div>
                            <div id="slider-range"></div>
                        </div>
                        <!-- <div class="col-sm-2 sel-filt" style="max-width:25%;">
                            <select class="country" data-max="" name="country[]"
                                data-placeholder="{{ __('frontstaticword.nationality') }}" multiple="multiple"
                                id="country_id">
                                <option></option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if(!empty(request()->country) &&
                                    in_array($country->id,request()->country)) {{'selected'}} @endif>{{$country->name}}
                                </option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="col-sm-2 sel-filt sel-country" style="max-width:25%;">
                            <select class="country" data-max="" name="residences[]"
                                data-placeholder="{{ __('frontstaticword.CountryOfResidence') }}" multiple="multiple"
                                id="residence_id">
                                <option></option>
                                @foreach($residences as $residence)
                                <option value="{{$residence->id}}" @if(!empty(request()->residences) &&
                                    in_array($residence->id,request()->residences)) {{'selected'}}
                                    @endif>{{$residence->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 sel-filt" style="max-width:33.333333%;">
                            <div class="availability" id="availability">{{ __('frontend.availability') }}
                                <div class="inner-ava">
                                    <div class="times-day">
                                        <h3 class="title">{{ __('frontend.time_of_the_day') }}</h3>
                                        <div class="row">
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="06:00:00-09:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('06:00:00-09:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sunrise.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>6-9</small>
                                                        <p>{{ __('frontend.morning') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="09:00:00-12:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('09:00:00-12:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sunrise2.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>9-12</small>
                                                        <p>{{ __('frontend.late_morning') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="12:00:00-15:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('12:00:00-15:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sun.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>12-15</small>
                                                        <p>{{ __('frontend.afternoon') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="15:00:00-18:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('15:00:00-18:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sun.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>15-18</small>
                                                        <p>{{ __('frontend.late_afternoon') }} </p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="18:00:00-21:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('18:00:00-21:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sunrise3.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>18-21</small>
                                                        <p>{{ __('frontend.evening') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="21:00:00-24:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('21:00:00-24:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/half-moon.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>21-24</small>
                                                        <p>{{ __('frontend.late_evening') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="00:00:00-03:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('00:00:00-03:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/moon.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>0-3</small>
                                                        <p>{{ __('frontend.night') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-3 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="times[]" value="03:00:00-06:00:00"
                                                        @if(!empty(request()->times) &&
                                                    in_array('03:00:00-06:00:00',request()->times)) {{'checked'}}
                                                    @endif>
                                                    <div class="label-text"><img src="/frontAssets/images/sleep.png"
                                                            alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                                                        <small>3-6</small>
                                                        <p>{{ __('frontend.late_night') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="times-day week">
                                        <h3 class="title">{{ __('frontend.days_of_the_week') }}</h3>
                                        <div class="row">
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Saturday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Saturday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Saturday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Sunday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Sunday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Sunday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Monday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Monday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Monday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Tuesday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Tuesday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Tuesday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Wednesday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Wednesday',request()->days)) {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Wednesday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Thursday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Thursday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Thursday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 ch-item">
                                                <label class="chebox-time">
                                                    <input type="checkbox" name="days[]" value="Friday"
                                                        @if(!empty(request()->days) &&
                                                    in_array('Friday',request()->days))
                                                    {{'checked'}} @endif>
                                                    <div class="label-text">
                                                        <p>{{ __('frontend.Friday') }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 sel-filt " style="max-width:33.333333%;">
                            <select class="langu" data-placeholder="{{ __('frontstaticword.Language') }}" name="Language[]" multiple="multiple"
                                id="languages">
                                @foreach($allLanguages as $language)
                                <option value="{{$language->id}}" @if(!empty(request()->Language) &&
                                    in_array($language->id,request()->Language)) {{'selected'}} @endif>
                                    {{$language->isoName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="col-sm-2 sel-filt check-item">
                                <label class="che-box">
                                    <input type="checkbox" id="nativeSpeaker" name="checkbox"><span class="label-text">Native Speaker</span>
                                </label>
                            </div> -->
                        <div class="col-sm-2 sel-filt sel-name" style="max-width:33.333333%;">
                            <input class="form-control" type="text" placeholder="{{ __('frontend.search_by_name') }}" name="searchWord"
                                value="@if(request()->searchWord != '') {{request()->searchWord}} @endif"
                                id="searchBox">

                        </div>
                        <div class="col-sm-2 sel-filt sel-btn" style="max-width:33.333333%;">
                            <button class="btn bottom w-100"> {{ __('frontend.search') }}</button>


                        </div>

                    </div>
                </div>

                <div class="filter-text d-flex mt-4">
                    <h3 class="title txt-blue w-auto">{{ __('frontend.find_your_tutor') }}</h3>
                    <div class="fil-search">
                        <div class="check-item">
                            <label class="che-box">
                                <input type="checkbox" id="nativeSpeaker" name="checkbox" @if(request()->checkbox ==
                                'on')
                                {{'checked'}} @endif><span class="label-text">{{ __('frontend.native_speaker') }}</span>
                            </label>
                        </div>
                        <div class="select-short">
                            <p class="txt-blue">{{ __('frontend.sort_by') }}</p>
                            <select class="chosen-select" data-placeholder="{{ __('frontend.popularity') }}" name="sort" tabindex="5"
                                id="sort">
                                <option value=""></option>
                                <option value="Popularity" @if(request()->sort == 'Popularity') {{'selected'}}
                                    @endif>{{ __('frontend.popularity') }}</option>
                                <option value="highestPrice" @if(request()->sort == 'highestPrice') {{'selected'}}
                                    @endif>{{ __('frontend.price_highest_first') }}</option>
                                <option value="lowestPrice" @if(request()->sort == 'lowestPrice') {{'selected'}}
                                    @endif>{{ __('frontend.price_lowest_first') }}</option>
                                <option value="Reviews" @if(request()->sort == 'Reviews') {{'selected'}} @endif>{{ __('frontend.reviews') }}
                                </option>
                                <option value="Ratings" @if(request()->sort == 'Ratings') {{'selected'}} @endif>{{ __('frontend.ratings') }}
                                </option>
                            </select>
                        </div>

                        <!-- <form class="formsearch" action="#" method="">

                                    <input class="form-control" type="text" placeholder="Search By Name" id="searchBox">
                                </form> -->
                    </div>
                </div>
                <div class="row w-100 mt-4 align-items-center d-flex justify-content-between licen">
                    <div class="col-12">
                        <div class="licen-slider">
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l1.png">
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l2.png" />
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l3.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l4.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l5.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                            <div class="slider-item">
                                <div class=" item">
                                    <a class="inner-bg" href="#">
                                        <div class="photo"><img src="/frontAssets/images/l3.png" alt="{{ __('frontend.website_name') }}"
                                                title="{{ __('frontend.website_name') }}">
                                        </div>
                                        <div class="layout">
                                            <div><i class="fas fa-star"></i> 5</div>
                                            <h6>Dr. Dina Hassan</h6>
                                            <p>
                                                Specialized in Depression
                                            </p>
                                        </div>


                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="row w-100">
                    <div class="col-12">
                        <h3 class="title w-auto mb-3">All Therapist</h3>
                        <div class="get-intro d-flex align-items-center">
                            <div class="img-inner">
                                <img src="/frontAssets/images/mobileuser.png" />
                            </div>
                            <div>
                                <span class="mr-4"> Get matched to a suitable therapist </span>

                                <button class="btn btn-green"> Wellness Selection </button>
                            </div>



                        </div>


                    </div>
                </div>
            </form>
        </div>
        <div id="myContent ">

            <!--------New Version --->
            <div class="row contenuser">
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="itemtutor">
                        <div class="d-flex flex-column align-items-center">
                            <div class="tu-photo">
                                <div class="img">
                                    <a href="javascript:;">
                                        <img src="/frontAssets/images/l1.png">
                                    </a>
                                </div>
                            </div>
                            <div class="tu-content">
                                <div class="minhead justify-content-center">
                                    <h3 class="title txt-blue"> Deena
                                        Abdullah</h3>
                                </div>
                                <h6 class="text-center">Psychotherapist</h6>
                                <p class="spec">Specialized in Depression </p>
                                <p>Nearest appointment: Tomorrow, Apr. 16 at 8:30 PM</p>
                            </div>
                            <div class="btn-proces">
                                <a href="#" class="book">Book Now</a>
                                <a href="#" class="view">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $tutors->links('frontend.paginate', ['paginate_pass'=>$paginate_pass]); ?>

        </div>
    </div>


</section>


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
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontend.enter_your_fname') }}"
                            name="fname" value="@if(isset(Auth::user()->id)){{ Auth::user()->fname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.fname') }}</label>
                    </div>
                    <div class="col-sm-6 fild" @if(isset(Auth::user()->lname) && Auth::user()->lname !='') hidden
                        @endif>
                        <input class="form-control" type="text"
                            placeholder="{{ __('frontend.enter_your_lname') }}"
                            name="lname" value="@if(isset(Auth::user()->id)){{ Auth::user()->lname }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.lname') }}</label>
                    </div>
                    <div class="col-sm-12 fild" @if(isset(Auth::user()->email) && Auth::user()->email !='') hidden
                        @endif>
                        <input class="form-control" type="email"
                            placeholder="{{ __('frontend.enter_your_email') }}"
                            name="email" value="@if(isset(Auth::user()->id)){{ Auth::user()->email }}@endif"
                            autocomplete="off" autofocus required>
                        <label class="floating-label">{{ __('frontstaticword.Email') }}</label>
                    </div>
                    <div class="col-sm-12 fild">
                        <textarea class="form-control" name="message" id="messageTextArea"
                            placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus=""
                            required maxlength="300" minlength="2"></textarea>
                        <div class="alert alert-danger" role="alert" id="warning">
                            {{ __('frontend.send_message_term_tip') }}
							<a href="{{url('terms_condition')}}"
                                title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a>
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
(function($) {
    $('.hoverbox').hover(function() {
        var tutor_id = $(this).attr('tutor_id');
        $.ajax({
            type: 'GET',
            data: {
                'tutor_id': tutor_id,
            },
            url: '/find/tutor/content',
            dataType: 'text',
            success: function(data) {
                $(".shownow" + tutor_id).html(data);
            },
            error: function(data) {
                console.error("{{ __('frontend.error_getting_booking_page') }}");
            }
        });
    }, function() {
        var tutor_id = $(this).attr('tutor_id');
        //$(".shownow"+tutor_id).html('');
    });
    $('.booknow').on('click', function() {
        $(".slickPrev").click();
        var tutor_id = $(this).attr('tutor_id');
        bookingImage = $(this).attr('timage');
        bookingImage = "/images/user_img/" + bookingImage;
        $(".bookingImage").attr("src", bookingImage);
        $.ajax({
            type: 'GET',
            data: {
                'tutor_id': tutor_id,
            },
            url: '/find/tutor/slots',
            dataType: 'text',
            success: function(data) {
                $(".bookingnowcontent" + tutor_id).html(data);
                $(".bookingnowcontent" + tutor_id).addClass("active");
            },
            error: function(data) {
                console.error("{{ __('frontend.error_getting_booking_page') }}");
            }
        });
        return false;
    });
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
})(jQuery);
</script>
@endsection
