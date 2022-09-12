@extends('frontend.layouts.layout')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

</script>

@section('title', \Lang::get('Find Tutor'))

@section('pageContent')
    @include('admin.message')
    <section class="findtutor">
    <div class="container">
        <div class="headtitle">
            <h1 class="title">Browse and book an online Arabic tutor for a personalized Arabic lesson online
                now</h1>
            <span class="num-to">{{$tutors->total()}} tutors</span>
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
                understands students better than a personal tutor and it’s not that expensive to find a tutor
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
                    <div class="col-sm-2 sel-filt" style="max-width:25%;">
                        <select class="chosen-select" id="specialties" name="specialties[]"
                            data-placeholder="Specialties" multiple tabindex="18">
                            @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}" @if(!empty(request()->specialties) && in_array($specialty->id,request()->specialties)) {{'selected'}} @endif>{{ __('frontstaticword.'.$specialty->specialty)}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 sel-filt" style="max-width:25%;">
                        <div class="pr-input">
							@php
								$min = 0;
								$max = 100;
								if(isset(request()->from))	$min = substr(request()->from,0,strpos(request()->from, ' '));
								if(isset(request()->to))	$max = substr(request()->to,0,strpos(request()->to, ' '));
							@endphp
							<input type="text" id="amount-min" name="from" value="{{$min}}">
                            <input type="text" id="amount-max" name="to" value="{{$max}}">
                        </div>
                        <div id="slider-range"></div>
                    </div>
                    <div class="col-sm-2 sel-filt" style="max-width:25%;">
                        <select class="country" data-max="" name="country[]" data-placeholder="{{ __('frontstaticword.nationality') }}"
                            multiple="multiple" id="country_id">
                            <option></option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}" @if(!empty(request()->country) && in_array($country->id,request()->country)) {{'selected'}} @endif>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="col-sm-2 sel-filt" style="max-width:25%;">
                        <select class="country" data-max="" name="residences[]" data-placeholder="{{ __('frontstaticword.CountryOfResidence') }}"
                            multiple="multiple" id="residence_id">
                            <option></option>
                            @foreach($residences as $residence)
                            <option value="{{$residence->id}}" @if(!empty(request()->residences) && in_array($residence->id,request()->residences)) {{'selected'}} @endif>{{$residence->name}}</option>
                            @endforeach
                        </select>
                    </div>
				</div>
				<div class="row">
                    <div class="col-sm-2 sel-filt" style="max-width:33.333333%;">
                        <div class="availability" id="availability">Availability
                            <div class="inner-ava">
                                <div class="times-day">
                                    <h3 class="title">Times of the day</h3>
                                    <div class="row">
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="06:00:00-09:00:00" @if(!empty(request()->times) && in_array('06:00:00-09:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sunrise.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>6-9</small>
                                                    <p>Morning</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="09:00:00-12:00:00" @if(!empty(request()->times) && in_array('09:00:00-12:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sunrise2.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>9-12</small>
                                                    <p>Late morning</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="12:00:00-15:00:00" @if(!empty(request()->times) && in_array('12:00:00-15:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sun.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>12-15</small>
                                                    <p>Afternoon</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="15:00:00-18:00:00" @if(!empty(request()->times) && in_array('15:00:00-18:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sun.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>15-18</small>
                                                    <p>Late Afternoon </p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="18:00:00-21:00:00" @if(!empty(request()->times) && in_array('18:00:00-21:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sunrise3.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>18-21</small>
                                                    <p>Evening</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="21:00:00-24:00:00" @if(!empty(request()->times) && in_array('21:00:00-24:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/half-moon.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>21-24</small>
                                                    <p>Late evening</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="00:00:00-03:00:00" @if(!empty(request()->times) && in_array('00:00:00-03:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/moon.png"
                                                        alt="Arabia" title="Arabia">
                                                    <small>0-3</small>
                                                    <p>Night</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="times[]" value="03:00:00-06:00:00" @if(!empty(request()->times) && in_array('03:00:00-06:00:00',request()->times)) {{'checked'}} @endif>
                                                <div class="label-text"><img src="/frontAssets/images/sleep.png"
                                                        alt="Arabia" title="Arabia">
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
                                                <input type="checkbox" name="days[]" value="Saturday" @if(!empty(request()->days) && in_array('Saturday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Sat</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Sunday" @if(!empty(request()->days) && in_array('Sunday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Sun</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Monday" @if(!empty(request()->days) && in_array('Monday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Mon</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Tuesday" @if(!empty(request()->days) && in_array('Tuesday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Tue</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Wednesday" @if(!empty(request()->days) && in_array('Wednesday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Wed</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Thursday" @if(!empty(request()->days) && in_array('Thursday',request()->days)) {{'checked'}} @endif>
                                                <div class="label-text">
                                                    <p>Thu</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-2 ch-item">
                                            <label class="chebox-time">
                                                <input type="checkbox" name="days[]" value="Friday" @if(!empty(request()->days) && in_array('Friday',request()->days)) {{'checked'}} @endif>
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
                    <div class="col-sm-2 sel-filt" style="max-width:33.333333%;">
                        <select class="langu" data-placeholder="Language" name="Language[]" multiple="multiple"
                            id="languages">
                            @foreach($allLanguages as $language)
                            <option value="{{$language->id}}" @if(!empty(request()->Language) && in_array($language->id,request()->Language)) {{'selected'}} @endif> {{$language->isoName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="col-sm-2 sel-filt check-item">
                                <label class="che-box">
                                    <input type="checkbox" id="nativeSpeaker" name="checkbox"><span class="label-text">Native Speaker</span>
                                </label>
                            </div> -->
                    <div class="col-sm-2 sel-filt" style="max-width:33.333333%;">
                        <input class="form-control" type="text" placeholder="Search By Name" name="searchWord" value="@if(request()->searchWord != '') {{request()->searchWord}} @endif" id="searchBox">

                    </div>
                </div>
                <div class="filter-text">
                    <h3 class="title">Find your Tutor</h3>
                    <div class="fil-search">
                        <div class="select-short">
                            <p>Sort by</p>
                            <select class="chosen-select" data-placeholder="Popularity" name="sort" tabindex="5"
                                id="sort">
                                <option value=""></option>
                                <option value="Popularity" @if(request()->sort == 'Popularity') {{'selected'}} @endif>Popularity</option>
                                <option value="highestPrice" @if(request()->sort == 'highestPrice') {{'selected'}} @endif>Price: highest first</option>
                                <option value="lowestPrice" @if(request()->sort == 'lowestPrice') {{'selected'}} @endif>Price: lowest first</option>
                                <option value="Reviews" @if(request()->sort == 'Reviews') {{'selected'}} @endif>Reviews</option>
                                <option value="Ratings" @if(request()->sort == 'Ratings') {{'selected'}} @endif>Ratings</option>
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
                            <input type="checkbox" id="nativeSpeaker" name="checkbox" @if(request()->checkbox == 'on') {{'checked'}} @endif><span class="label-text">Native
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
                    <div class="col-sm-8 contenuser hoverbox" tutor_id="{{$tutor->id}}">
                        <div class="itemtutor">
                            <div class="flex-box">
                                <div class="tu-photo">
                                    <div class="img">
                                        {{--                                            <span class="featured">Featured</span>--}}
                                        @if(Auth::check() && Auth::user()->role == 'user')
										@if(isset($tutor->favourite[0]))
                                        @foreach($tutor->favourite as $fav)
                                        @if(auth()->check())
                                        @if(auth()->user()->id == $fav->user_id && $tutor->id == $fav->instructor_id)
                                        <!--<a href="#" id="{{$tutor->id}}" class="fas fa-heart red active removeFav"></a>-->
										<a tutor_id="{{$tutor->id}}" class="fas fa-heart red active" id="removeFav"></a>
                                        @endif
                                        @endif

                                        @endforeach
                                        @else
                                        <!--<a href="#" id="{{$tutor->id}}" class="fas fa-heart makeFav"></a>-->
										<a tutor_id="{{$tutor->id}}" class="fas fa-heart" id="makeFav"></a>
                                        @endif
										@endif
                                        {{--                                            <span class="online"></span>--}}
                                        <a href="/tutor/page/{{$tutor->id}}">
                                        <img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" alt="Arabie"
                                            title="Arabia"> </a>
                                        <input value="{{$tutor->id}}" class="input-group tutor_id" hidden>
                                    </div>
                                    <div class="price">
										@php
											$tutor_country_price_per_hour = $tutor->tutor_country_price_per_hour()->where(['country_id'=>$user_ip_country_info['country_id'],'status'=>1])->first();
											if($tutor_country_price_per_hour) { $price_per_hour = number_format($tutor_country_price_per_hour->pricePerHour * $userExchangeRate, 2, '.', ''); $currency_code = $tutor_country_price_per_hour->currency; }
											else $price_per_hour = number_format($tutor->PricePerHour * $userExchangeRate, 2, '.', '');
										@endphp
										{{ $price_per_hour }}
									</div>
                                    <div class="price-to">{{ $currency_code }}/H</div>
                                    
									@if(Auth::check() && Auth::user()->role == 'user' || Auth::guest())
										<div class="fild bot-de bot-card">
											<button class="bottom booknow" record_id="{{$tutor->id}}" tname="{{$tutor->user->fname}} {{$tutor->user->lname}}" timage="{{$tutor->user->user_img}}" tutor_id="{{$tutor->id}}">Book Now</button>
											<a class="bottom sendmessage" href="#" record_id="{{$tutor->id}}"
                                            tname="{{$tutor->user->fname}} {{$tutor->user->lname}}"
                                            headline="{{$tutor->headline}}" timage="{{$tutor->user->user_img}}"
                                            data-toggle="modal">Send Message</a>
										</div>
									@endif
									
                                </div>
                                <div class="tu-content">
                                    <div class="minhead">
                                        <h3 class="title"><a style="color: #af8b62 !important;"
                                                href="/tutor/page/{{$tutor->id}}"> {{$tutor->user->fname}}
                                                {{$tutor->user->lname}}</a></h3>
                                        <div class="flag" title="{{$tutor->country_name}}">
                                            {{country($tutor->iso)->getEmoji()}}</div>
                                        <div class="safy">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16.436"
                                                height="19.301" viewBox="0 0 16.436 19.301">
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
                                        <?php  $reviewTotalValue += $review->value;?>
                                        <?php $averageRating = round($reviewTotalValue / count($tutor->reviews));?>
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
									
									@php
										if(session()->has('changed_language') && session('changed_language') == 'ar') { $age = 'age_ar'; $student_level = 'student_level_ar'; }
										else { $age = 'age'; $student_level = 'student_level'; }
									@endphp
									@if($tutor->prefered_student_age->count())
									<h3 class="title siz-titl">
										<span class="span_title">{{ __('frontstaticword.PreferredStudentAge') }}:</span>
										@php
											foreach($tutor->prefered_student_age as $key_age => $prefered_student_age) { echo $prefered_student_age->prefered_student_age->$age; if($key_age != $tutor->prefered_student_age->count()-1) echo ', '; }
										@endphp
									</h3>
									@endif
									@if($tutor->prefered_student_level->count())
									<h3 class="title siz-titl">
										<span class="span_title">{{ __('frontstaticword.preferredStudentLevel') }}:</span>
										@php
											foreach($tutor->prefered_student_level as $key_level => $prefered_student_level) { echo $prefered_student_level->prefered_student_level->$student_level; if($key_level != $tutor->prefered_student_level->count()-1) echo ', '; }
										@endphp
									</h3>
									@endif
                                    <div class="minhead towhead">
                                        @foreach($tutor->languages as $language)
                                        <div class="speaks">
                                            <p>speaks :</p>
                                            <span>{{$language->language->isoName}}</span><strong>{{$language->level->name}}</strong>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--<div class="row">
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="Arabia"
                                                    title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title"> Active students</h4>
                                                    <span>{{count($tutor->bookedSlots->groupBy('user_id'))}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="Arabia"
                                                    title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title"> Lessons</h4><span>{{count($tutor->bookedSlots)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 itemactiv">
                                            <div class="mactiv"><img src="/frontAssets/images/review.png" alt="Arabia"
                                                    title="Arabia">
                                                <div class="con-item">
                                                    <h4 class="title"> Reviews</h4><span>{{count($tutor->reviews)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!--<div class="headtext">
                                        <p class="textline">{{substr($tutor->detail, 0, 50)}}</p>
                                        <div class="onclick"><span
                                                class="more">+{{ __('frontstaticword.readMore') }}</span><span
                                                class="cancel">X hide</span></div>
                                        <p class="divhidslid"> {{substr($tutor->detail, 50, 500)}}</p>
                                    </div>-->
									<div class="headtext">
                                        <p class="textline">{!! $tutor->detail !!}</p>
                                    </div>
                                </div>
                                <div class="showitem"></div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 contenuser showbox shownow{{$tutor->id}}">
					</div>

                </div>
            </div>
            @php $x++; @endphp

                <div class="box-book-trial bookingModal bookingnowcontent{{$tutor->id}}" id="#booknowcontent{{$tutor->id}}">
				</div>
				
            @endforeach

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
                        <textarea class="form-control" name="message" id="messageTextArea"
                            placeholder="{{ __('frontstaticword.writeYourMessage') }} …" autocomplete="off" autofocus=""
                            required maxlength="300" minlength="2"></textarea>
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
(function($){
$('.hoverbox').hover(function() {
	var tutor_id = $(this).attr('tutor_id');
	$.ajax({
        type : 'GET',
		data : {
			'tutor_id' : tutor_id,
		},
        url : '/find/tutor/content',
        dataType : 'text',
        success : function(data) {
			$(".shownow"+tutor_id).html(data);
        },
        error : function(data) {
            console.error("Error getting booking page");
        }
    });
}, function(){
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
        type : 'GET',
		data : {
			'tutor_id' : tutor_id,
		},
        url : '/find/tutor/slots',
        dataType : 'text',
        success : function(data) {
			$(".bookingnowcontent"+tutor_id).html(data);
			$(".bookingnowcontent"+tutor_id).addClass("active");
        },
        error : function(data) {
            console.error("Error getting booking page");
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

var searchWords = ["gmail", "outlook" , "yahoo "  , "hotmail" , "facebook" , "contact"];

function searchStringInArray (str, strArray) {
    for (var j=0; j<strArray.length; j++) {
        if (strArray[j].match(str)) return j;
    }
    return -1;
}

$( document ).ready(function() {
    $( "#warning" ).hide();
    $('#messageTextArea').keyup(function () {
        text = $('#messageTextArea').val();
        if(detectURLs(text) ){
            $("#message_submit").prop("disabled", true);
        }else{
            $("#message_submit").removeAttr('disabled');
        }

        var array_of_words = text.split(" ");

        for (var j=0; j<array_of_words.length; j++) {
            var word = array_of_words[j].toLowerCase();
            if( (word == "@") || (detectNumber(word)) ){
                $( "#warning" ).show();
                $("#message_submit").prop("disabled", true);
            }
            if((word.length > 4) ){
                if( searchStringInArray( word , searchWords) != -1 ){
                    $( "#warning" ).show();
                    $("#message_submit").prop("disabled", true);
                }else{
                    $( "#warning" ).hide();
                    $("#message_submit").removeAttr('disabled');
                }
            }
            // check for special characters
            var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

            if(format.test(word)){
                $( "#warning" ).show();
                $("#message_submit").prop("disabled", true);
            }
        }
    });
});
})(jQuery);
</script>

@endsection
