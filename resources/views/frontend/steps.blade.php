@extends('frontend.layouts.layout')
@section('title', __('frontend.register_steps'))

@section('pageContent')
{{--    {{dd($user)}}--}}
<section class="step-sign">
    @include('admin.message')
    <div class="container">
        <form id="contact" action="#" method="post" enctype="multipart/form-data">
            @csrf
			<input type="hidden" id="tab_index" name="tab_index"/>
            <div>
                <h3><i class="fas fa-check"></i> 1 | {{ __('frontstaticword.About') }} </h3>
                <section>
                    <div class="row">

                        <div class="col-sm-8 itemform">
                            <div class="row">
                                <div class="col-sm-6 fild">
                                    <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_fname') }}"
                                        value="{{$user->fname}}" name="fname" id="fname" autocomplete="off"
                                        minlength="2" maxlength="50" autofocus required>
                                    <label class="floating-label">{{ __('frontstaticword.fname').' *' }}</label>
                                </div>
                                <div class="col-sm-6 fild">
                                    <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_lname') }}"
                                        value="{{$user->lname}}" name="lname" id="lname" autocomplete="off"
                                        minlength="2" maxlength="50" autofocus required>
                                    <label class="floating-label">{{ __('frontstaticword.lname').' *' }}</label>
                                </div>
                              {{--   <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required" name="country_id" id="country"
                                        autocomplete="off" autofocus required>
                                        <option> </option>
                                        @foreach($countries as $country)
                                        @if($user->country_id == $country->id)
                                        <option selected value="{{$country->id}}">{{$country->name}}</option>
                                        @endif
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.CountryOfOrigin').' *' }}</label>
                                </div> --}}
								<div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required " name="country_residence" id="countryResidence"
                                        autocomplete="off" autofocus required onchange="setCountry(this.value)" >
                                      
                                        <option> </option>
                                        @foreach($countries as $country)
											<option value="{{$country->id}}" @if($user->country_residence_id == $country->id) {{'selected'}} @endif>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="country_id"  value="{{$user->country_residence_id}}" id="country_id" >
                                    <label class="floating-label">{{ __('frontstaticword.CountryOfResidence').' *' }}</label>
									@if($errors->has('country_residence'))
                                    <span class="error">
										<strong>{{ $errors->first('country_residence') }}</strong>
                                        
									</span>
									@endif
                                </div>
                                <div class="col-sm-12 fild">
                                    @php
                                        $QYN = ['Yes', 'No'];
                                    @endphp
                                    <label class="">{{ __('frontstaticword.do_you_work_in_a_hospital') }}</label>
                                    <div class="row">
                                    @foreach($QYN as $hear)
                                        <div class="col-sm-4">
                                            <input type="radio" class="hear" id="{{ $hear }}" class="" name="work_hospital"  onchange="$('.hospital').fadeToggle()" value="{{ $hear }}" @isset($user->work_hospital) @if($user->work_hospital== $hear) {{ 'checked' }} @endif @else @if($hear=='No') {{'checked'}} @endif @endisset>
                                            <label for="{{ $hear }}">{{ $hear }}</label>
                                        </div>
                                    @endforeach
                                    <div class="col-sm-4 hospital" style="display: none">

                                        <input type="text" class="form-control" id="hospital" placeholder="{{ __('frontstaticword.hospital_name') }}" name="hospital" value="{{$user->hospital}}" >
                                        <label class="floating-label">{{ __('frontstaticword.hospital_name') }}</label>

                                    </div>
                                    </div>
                                    
                                    @if($errors->has('work_hospital'))
                                        <div class="error">
                                            {{ $errors->first('work_hospital') }}
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="col-sm-12 fild">
                                    @php
                                        $QYN = ['Yes', 'No'];
                                    @endphp
                                    <label class="">{{ __('frontstaticword.do_you_work_in_a_center') }}</label>
                                    <div class="row">
                                    @foreach($QYN as $hear)
                                        <div class="col-sm-4">
                                            <input type="radio" class="hear" id="work_center_{{ $hear }}"  name="work_center" onchange="$('.center').fadeToggle()" value="{{ $hear }}" @isset($user->work_center) @if($user->work_center== $hear) {{ 'checked' }} @endif @else @if($hear=='No') {{'checked'}} @endif @endisset>
                                            <label for="work_center_{{ $hear }}">{{ $hear }}</label>
                                        </div>
                                    @endforeach
                                        <div class="col-sm-4 center" style="display: none">
                                            <input type="text" class="form-control" id="center"  name="center" value="{{$user->center}}" placeholder="{{ __('frontstaticword.center_name') }}" >
                                            <label class="floating-label">{{ __('frontstaticword.center_name') }}</label>
                                        </div>
                                    </div>
                                    
                                    @if($errors->has('work_center'))
                                        <div class="error">
                                            {{ $errors->first('work_center') }}
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="col-sm-12 fild">
                                    @php
                                        $QYN = ['Yes', 'No'];
                                    @endphp
                                    <label class="">{{ __('frontstaticword.do_you_work_in_a_sanatorium') }}</label>
                                    <div class="row">
                                    @foreach($QYN as $hear)
                                        <div class="col-sm-4">
                                            <input type="radio" class="hear" id="work_sanatorium_{{ $hear }}" class="" name="work_sanatorium"  onchange="$('.sanatorium').fadeToggle()" value="{{ $hear }}" @isset($user->work_sanatorium) @if($user->work_sanatorium== $hear) {{ 'checked' }} @endif @else @if($hear=='No') {{'checked'}} @endif @endisset>
                                            <label for="work_sanatorium_{{ $hear }}">{{ $hear }}</label>
                                        </div>
                                    @endforeach
                                        <div class="col-sm-4 sanatorium" style="display: none">
                                            <input type="text" class="form-control" id="sanatorium"  name="sanatorium" value="{{$user->sanatorium}}" placeholder="{{ __('frontstaticword.sanatorium_name') }}" >
                                            <label class="floating-label">{{ __('frontstaticword.sanatorium_name') }}</label>

                                        </div>
                                    </div>
                                    
                                    @if($errors->has('work_sanatorium'))
                                        <div class="error">
                                            {{ $errors->first('work_sanatorium') }}
                                        </div>
                                    @endif
                                    
                                </div>
                                @if($languagesSpoken->count() > 0)
                                @foreach($languagesSpoken as $language_key => $languageSpoken)
                                <div class="col-md-12 fild">
									<div class="row">
                                        <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
											<select class="form-control required" name="Languages[{{ $language_key }}][language]" id="language" autocomplete="off" autofocus required>
												<option> </option>
												@foreach($allLanguages as $language)
													<option @if($language->id == $languageSpoken->language_id) selected @endif value="{{$language->id}}">{{$language->isoName}}</option>
												@endforeach
											</select>
											<label class="floating-label">{{ __('frontstaticword.Language').' *' }}</label>
										</div>
									</div>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_language_text') }} </p><span class="bottom style-add add"><i
                                            class="fas fa-plus"></i></span>
                                </div>
                                @endforeach
                                @else
                                <!--Shimaa-->
                                <div class="col-md-12 fild">
									<div class="row">
                                        <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
											<select class="form-control" name="Languages[0][language]" id="language" autocomplete="off" autofocus>
												<option selected readonly value="2">Arabic</option>
												@foreach($allLanguages as $language)
													<option value="{{$language->id}}">{{$language->isoName}}</option>
												@endforeach
											</select>
											<label class="floating-label">{{ __('frontstaticword.Language').' *' }}</label>
										</div>
									</div>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_language_text') }} </p><span class="bottom style-add add"><i
                                            class="fas fa-plus"></i></span>
                                </div>
                                @endif
                                <div class="optionBox w-100">
                                    <div class="col-sm-12 add-fild"></div>
                                </div>
								
                                <div class="col-sm-12 fild"><span class="ealamuh">@if($currency and trim($currency->currency) != '' and $currency->currency != NULL) {{ $currency->currency }} @else {{ __('frontend.current_currency') }} @endif</span>
                                    <input class="form-control" type="number" step="1" min="1" max="9000000000000000000"
                                        @if(isset($tutor->PricePerHour)) value="{{$tutor->PricePerHour}}" @endif
                                    placeholder="{{ __('frontstaticword.hourRate') }}" name="HourRate" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontstaticword.hourRate').' *' }}</label>
                                </div>
                                <div class="col-sm-12 fild">
                                    <!--<input class="form-control mobile-number" type="text"
                                        placeholder="Phone number" name="mobile" id="mobile"
                                        value="{{$user->mobile}}" autocomplete="off" autofocus required>-->
									<input class="form-control" type="text"
                                        placeholder="{{ __('frontend.enter_your_mobile') }}" name="mobile" id="mobile"
                                        value="{{$user->mobile}}" autocomplete="off" autofocus required>
									<label class="floating-label">{{ __('frontstaticword.mobile').' *' }} </label>
                                </div>
                                <div class="col-md-12 fild">
									<div class="row">
                                        <div class="col-sm-12 fild">
											<input type="text" class="form-control" name="social_links[]" id="social_links">
											<label class="floating-label">{{ __('frontstaticword.social_links').' *' }}</label>
										</div>
									</div>
                                 <span class="bottom style-add addSocial"><i
                                            class="fas fa-plus"></i></span>
                                </div>
                                <div class="optionBox w-100">
                                    <div class="col-sm-12 addSocial-fild"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <h3><i class="fas fa-check"></i> 2 | {{ __('frontend.photo') }}</h3>
                <section>
                    <h4 class="title">{{ __('frontend.profile_photo') }}</h4>
                    <div class="row">
                        <div class="col-sm-6 itemform"> <span class="great">{{ __('frontend.steps_photo_text_1') }}</span>
                            <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_photo_text_2') }} </p>
                            <input type="file" accept=".jpg,.png,.jpeg" name="user_img" id="photo" required
                                value="{{$user->user_img}}" onchange="readURL(this);" multiple>
                        </div>
                        <div class="col-sm-6 itemform">
                            <h5 class="title siza">{{ __('frontend.profile_upload_photo_text_1') }}</h5>
                            <ul class="list-photo">
                                <li><img src="/frontAssets/images/profile-1.png" alt="" title=""></li>
                                <li><img src="/frontAssets/images/profile-2.png" alt="" title=""> </li>
                                <li><img src="/frontAssets/images/profile-3.png" alt="" title=""> </li>
                            </ul>
                            <ul class="list-item">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_2') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_3') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_4') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_5') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_6') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_7') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_photo_text_8') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <h3><i class="fas fa-check"></i> 3 | {{ __('frontstaticword.Description') }}</h3>
                <section>
                    <h4 class="title">{{ __('frontend.profile_description') }}</h4>
                    <p class="textsacand mt"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_photo_text_2') }} </p>
                    <h5 class="title siza">{{ __('frontend.description_for_students') }}</h5>
                    <div class="row">
                        <div class="col-sm-3 itemform img-user"> <img class="img_prev"
                                src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" alt="" title=""></div>
                        <div class="col-sm-8 itemform textuser">
                            <div class="fild">
                                <input class="form-control" type="text" minlength="2" maxlength="100"
                                    placeholder="{{ __('frontstaticword.headLine') }}" name="headline" id="headline"
                                    @if(isset($tutor->headline)) value="{{$tutor->headline}}" @endif autocomplete="off"
                                autofocus required>
                                <label class="floating-label">{{ __('frontstaticword.headLine').' *' }}</label>
                                <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.profile_headLine_text') }}</p>
                            </div>
                            <div class="fild">
                                <textarea class="form-control" minlength="250" maxlength="1000" name="detail"
                                    id="description" laceholder="Description" autocomplete="off" autofocus
                                    required>@if(isset($tutor->detail))  {{ strip_tags($tutor->detail)}} @endif </textarea>
                                <label class="floating-label">{{ __('frontend.about_the_tutor').' *' }}</label>
                                <p class="textsacand"><i class="fas fa-info-circle"></i> <span id="remain">250 </span>
                                    {{ __('frontend.characters_minimum') }}</p>
                            </div>
                        </div>
                    </div>
                </section>
                <h3><i class="fas fa-check"></i> 4 | {{ __('frontstaticword.Video') }}</h3>
                <section>
                    <h4 class="title">{{ __('frontstaticword.Video') }}</h4>
                    <div class="row">
                        <div class="col-sm-7 itemform">
                            <input type="radio" checked name="tab" value="igotnone" onclick="show1();" required />
                            {{ __('frontend.youtube') }}
                            <input type="radio" name="tab" value="igottwo" onclick="show2();" required />
                            {{ __('frontend.upload') }}
                            <div id="div1">
                                <div class="item-us"><span class="great">{{ __('frontend.paste_a_link_to_your_video') }}</span>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.learn_how_to_upload_videos_to') }} <a
                                            href="https://www.youtube.com/create_channel?next=https%3A%2F%2Fstudio.youtube.com%2Fchannel%2FUC%2Fvideos%3Fd%3Dud"
                                            target="_blank">{{ __('frontend.youtube') }} </a> {{ __('frontend.or') }} <a href="https://vimeo.com/upload"
                                            target="_blank">{{ __('frontend.vimeo') }} </a> </p>
                                    <div class="fild">
                                        <input class="form-control" type="url"
                                            placeholder="www.youtube.com/watch?v=l5aZJBLAu1E" name="youtube_url"
                                            autocomplete="off" value="{{$user->youtube_url}}" autofocus>
                                        <label class="floating-label">{{ __('frontend.paste_link') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div id="div2" style="display: none" class="hide"><span class="great">{{ __('frontend.or_upload_your_video') }}</span>
                                <div class="custom-file">
                                    <input class="custom-file-input" type="file" id="uploadVideo"
                                        accept="video/mp4,video/x-m4v,video/*" filesize_max="102400"
                                        name="uploadVideo">
                                    <label class="custom-file-label" for="customFile" id="uploadVideoLabel">{{ __('frontend.no_file') }}
                                    </label>
                                </div>
                                {{--                                    <input type="file" accept="video/mp4,video/x-m4v,video/*" name="file" id="file">--}}
                                {{--                                    <input type="submit" value="Upload" name="submit">--}}
                                {{--                                    <p class="textsacand"><i class="fas fa-info-circle"></i>   Show students your teaching style and personality</p>--}}
                                {{--                                    <div class="iframe">--}}
                                {{--                                        <iframe src="https://youtu.be/VctaUNJpT6U"></iframe>--}}
                                {{--                                    </div>--}}
                                {{--                                    <nav class="bot-action"><a class="bottom" href="#">Start Recording</a><a class="bottom" href="#">Test Camera</a></nav>--}}
                                {{--                                    <p class="textsacand"><i class="fas fa-info-circle"></i> You'll be able to watch and re-record before you submit</p>--}}
                            </div>
                        </div>
                        <div class="col-sm-4 itemform offset-sm-1">
                            <h5 class="title siza">{{ __('frontend.tips_for_an_amazing_video') }}</h5>
                            <ul class="list-item">
                                <li class="great"><i class="fas fa-circle"></i>{{ __('frontend.technical') }}</li>

                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_1') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_2') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_3') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_4') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_5') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_6') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_7') }}
                                </li>
                            </ul>
                            <ul class="list-item">
                                <li class="great"><i class="fas fa-circle"></i> {{ __('frontend.content') }}</li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_8') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_9') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_10') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 21.013 20.726">
                                        <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                            transform="translate(-2.248 -2.229)">
                                            <path id="Path_31914" data-name="Path 31914"
                                                d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775"
                                                transform="translate(0 0)" fill="none" stroke="#ba9a74"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </path>
                                            <path id="Path_31915" data-name="Path 31915"
                                                d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)"
                                                fill="none" stroke="#ba9a74" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </g>
                                    </svg>{{ __('frontend.profile_upload_video_text_11') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <h3><i class="fas fa-check"></i> 5 | {{ __('frontend.availability') }} </h3>
                <section>
                    <h4 class="title">{{ __('frontstaticword.timeZone') }}</h4>

                    <div class="alert alert-danger" id="availability_warning" role="alert">
                        {{ __('frontend.steps_availability_text_1') }}
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-8 itemform">
                            <div class="item-us">
                                <div class="fild r-icon"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required" name="time_zone_id" autocomplete="off"
                                        autofocus required>
                                        <option> </option>
                                        @foreach($timeZones As $zone)
                                        <option value="{{$zone->id}}" @if(\Illuminate\Support\Carbon::now()->
                                            timezoneName == $zone->time_zone_name) selected @endif
                                            >{{$zone->time_zone_name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.timeZone') }}</label>
                                </div>
                                <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_availability_text_2') }}</p>
                            </div>
                            <div class="item-us mb">
                                <h5 class="title siza">{{ __('frontend.availability_time') }}</h5>
                                <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.steps_availability_text_3') }}</p>
                            </div>

                        </div>

                        <section class="calendar-teach">
                            <div class="row">
                                <div class="col-sm-9 rightbox">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show w-item active" id="item-1" role="tabpanel"
                                            aria-labelledby="item-1-tab">
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Sun" value="Sunday"><span
                                                            class="label-text">{{ __('frontend.Sunday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Sunday[]" value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Mon" value="Monday"><span
                                                            class="label-text">{{ __('frontend.Monday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Monday[]" value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Tue" value="Tuesday"><span
                                                            class="label-text">{{ __('frontend.Tuesday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Tuesday[]"
                                                                    value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Wed" value="Wednesday"><span
                                                            class="label-text">{{ __('frontend.Wednesday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Wednesday[]"
                                                                    value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Thu" value="Thursday"><span
                                                            class="label-text">{{ __('frontend.Thursday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Thursday[]"
                                                                    value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Fri" value="Friday"><span
                                                            class="label-text">{{ __('frontend.Friday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Friday[]" value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="select-day">
                                                <div class="check-tag">
                                                    <label class="che-box">
                                                        <input type="checkbox" name="Sat" value="Saturday"><span
                                                            class="label-text">{{ __('frontend.Saturday') }}</span>
                                                    </label>
                                                </div>
                                                <div class="times-day">
                                                    <div class="all-checktime">
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="00:00:00">
                                                                <div class="label-text">
                                                                    <p>00:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="01:00:00">
                                                                <div class="label-text">
                                                                    <p>01:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="02:00:00">
                                                                <div class="label-text">
                                                                    <p>02:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="03:00:00">
                                                                <div class="label-text">
                                                                    <p>03:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="04:00:00">
                                                                <div class="label-text">
                                                                    <p>04:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="05:00:00">
                                                                <div class="label-text">
                                                                    <p>05:00</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="06:00:00">
                                                                <div class="label-text">
                                                                    <p>06:00</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="07:00:00">
                                                                <div class="label-text">
                                                                    <p>07:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="08:00:00">
                                                                <div class="label-text">
                                                                    <p>08:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="09:00:00">
                                                                <div class="label-text">
                                                                    <p>09:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="10:00:00">
                                                                <div class="label-text">
                                                                    <p>10:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="11:00:00">
                                                                <div class="label-text">
                                                                    <p>11:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="12:00:00">
                                                                <div class="label-text">
                                                                    <p>12:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="13:00:00">
                                                                <div class="label-text">
                                                                    <p>13:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="14:00:00">
                                                                <div class="label-text">
                                                                    <p>14:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="all-checktime">

                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="15:00:00">
                                                                <div class="label-text">
                                                                    <p>15:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="16:00:00">
                                                                <div class="label-text">
                                                                    <p>16:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="17:00:00">
                                                                <div class="label-text">
                                                                    <p>17:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="18:00:00">
                                                                <div class="label-text">
                                                                    <p>18:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="19:00:00">
                                                                <div class="label-text">
                                                                    <p>19:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="20:00:00">
                                                                <div class="label-text">
                                                                    <p>20:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="21:00:00">
                                                                <div class="label-text">
                                                                    <p>21:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="22:00:00">
                                                                <div class="label-text">
                                                                    <p>22:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="ch-item">
                                                            <label class="chebox-time">
                                                                <input type="checkbox" name="Saturday[]"
                                                                    value="23:00:00">
                                                                <div class="label-text">
                                                                    <p>23:00 </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </section>
                <!--<h3><i class="fas fa-check"></i> 6 | {{ __('frontend.verification') }}</h3>
                <section>
                    <h4 class="title">{{ __('frontend.ProfileVerification') }}</h4><span class="great">{{ __('frontend.steps_verification_text_1') }}</span>
                    <div class="col-sm-9 itemform">
                        <div class="row">
                            <div class="textmap"><i class="fas fa-check"> </i>
                                <p>{{ __('frontend.steps_verification_text_2') }} </p><span>{{ __('frontend.steps_verification_text_3') }} </span>
                            </div>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="customFile" name="file" required>
                                <label class="custom-file-label" for="customFile">{{ __('frontend.no_file') }} </label>
                            </div>
                            <div class="textmap"><i class="fas fa-unlock-alt"> </i>
                                <p>{{ __('frontend.safe') }} </p><span>{{ __('frontend.ProfileVerification_text') }}</span>
                            </div>
                        </div>
                    </div>
                </section>-->
            </div>

        </form>
    </div>
</section>

<div class="modal fade" id="check" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z"
                        fill="#000"></path>
                </svg>
            </button>
            <div class="done-check"><i class="fas fa-check-circle"></i>
                <h3 class="title">{{ __('frontend.steps_submit_success_1') }}</h3>
                <p>{{ __('frontend.steps_submit_success_2') }} </p><a
                    class="bottom " href="#">{{ __('frontend.steps_submit_success_3') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerAssets')
<script>
    function setCountry(value)
    {
        $('#country_id').val(value)

    }
   

function show1() {
    document.getElementById('div1').style.display = 'block';
    document.getElementById('div2').style.display = 'none';

}

function show2() {
    document.getElementById('div1').style.display = 'none';
    document.getElementById('div2').style.display = 'block';

}
</script>
<script>
var lang = <?= json_encode($allLanguages); ?>;
var spoke_lang_count = "{{ $languagesSpoken->count() }}";
var lang_index_start = 1;
if(spoke_lang_count > 0) lang_index_start = spoke_lang_count;

// console.log(lang)
</script>
<script src="/frontAssets/js/staps.js"></script>



@endsection
@push('special-scripts')
<script>
    $('.addSocial').click(function(){
        var Html="  <div class='col-md-12 fild'>";
			Html+="						<div class='row'>";
                Html+="                            <div class='col-sm-12 fild'>";
                    Html+="							<input type='text' class=\"form-control\" name=\"social_links[]\" id=\"social_links\">";
                    Html+="							<label class=\"floating-label\">{{ __('frontstaticword.social_links')}}</label>";
                    Html+="								</div>";
                    Html+="								</div>";
                    Html+="                  <span class=\"bottom  icon-erm remove removeSocial\"><i class=\"fas fa-times\"></i></span>";
                    Html+="            </div>";
        $('.addSocial-fild').append(Html)
})
</script>
@endpush