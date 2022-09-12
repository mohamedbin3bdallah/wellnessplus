@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.UserProfile'))

@section('pageContent')

@include('frontend.layouts.pages.tutor', ['page' => 'UserProfile'])


<div style="margin: auto;width: 80%;padding: 10px; text-align: center">
    @include('admin.message')

</div>
{{--{{dd(session('pageTab'))}}--}}
<section class="step-sign">


    <div class="container">
        <ul class="nav nav-tabs tabs-tutor" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="item-1-tab" data-toggle="tab" href="#item-1" role="tab" aria-controls="item-1" aria-selected="true">{{ __('frontstaticword.About') }}</a></li>
            <li class="nav-item"><a class="nav-link" id="item-2-tab" data-toggle="tab" href="#item-2" role="tab" aria-controls="item-2" aria-selected="false">{{ __('frontstaticword.ProfileDescription') }}</a></li>
            <li class="nav-item"><a class="nav-link" id="item-3-tab" data-toggle="tab" href="#item-3" role="tab" aria-controls="item-3" aria-selected="false">{{ __('frontstaticword.Video') }}</a></li>
            <!--<li class="nav-item"><a class="nav-link" id="item-4-tab" data-toggle="tab" href="#item-4" role="tab" aria-controls="item-4" aria-selected="false">{{ __('frontstaticword.ProfileVerification') }}</a>
            </li>-->
            <li class="nav-item"><a class="nav-link" id="item-5-tab" data-toggle="tab" href="#item-5" role="tab" aria-controls="item-5" aria-selected="false">{{ __('frontstaticword.Resume') }}</a></li>
            <li class="nav-item"><a class="nav-link" id="item-6-tab" data-toggle="tab" href="#item-6" role="tab" aria-controls="item-6" aria-selected="false">{{ __('frontstaticword.Password') }}</a></li>
            <!--<li class="nav-item"><a class="nav-link" id="item-7-tab" data-toggle="tab" href="#item-7" role="tab" aria-controls="item-7" aria-selected="false">{{ __('frontstaticword.Notifications') }}</a></li>-->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab">
                <div class="row">
                    <div class="col-sm-8 itemform">
                        <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="title sh__m">
                                {{ __('frontend.personal_info') }}
                            </h5>
                            <div class="row">
                                <div class="col-sm-6 fild">
                                    <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_fname') }}" @if(isset($tutor->user->fname)) value="{{$tutor->user->fname}}" @endif
                                    name="fname" minlength="2" maxlength="50" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontstaticword.fname').' *' }}</label>
                                </div>
                                <div class="col-sm-6 fild">
                                    <input class="form-control" type="text" placeholder="{{ __('frontend.enter_your_lname') }}" @if(isset($tutor->user->fname)) value="{{$tutor->user->lname}}" @endif
                                    name="lname" minlength="2" maxlength="50" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontstaticword.lname').' *' }}</label>
                                </div>
                                <div class="col-sm-12 fild">
                                    <input class="form-control" type="email" readonly name="email" placeholder="{{ __('frontend.enter_your_email') }}" autocomplete="off" @if(isset($tutor->user->email))
                                    value="{{$tutor->user->email}}" @else value="{{auth()->user()->email}}" @endif >
                                    <label class="floating-label">{{ __('frontstaticword.email').' *' }}</label>
                                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>

                                </div>
                                <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required" name="country_id" autocomplete="off" autofocus required>
                                        <option> </option>
                                        @foreach($countries as $country)
                                        @if(Auth::User()->country_id == $country->id)
                                        <option selected value="{{$country->id}}">{{$country->name}}</option>
                                        @endif
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.CountryOfOrigin').' *' }}</label>
                                </div>
                                <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required" name="country_residence" autocomplete="off" autofocus required>
                                        <option> </option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if(Auth::User()->country_residence_id == $country->id) {{'selected'}} @endif>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.CountryOfResidence').' *' }}</label>
                                    @if($errors->has('country_residence'))
                                    <span class="error">
                                        <strong>{{ $errors->first('country_residence') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @foreach($languagesSpoken as $language_key => $languageSpoken)
                                <div class="col-sm-12 optionBox fild">
                                    <div class="row">
                                        <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                            <select class="form-control required" name="Languages[{{ $language_key }}][language]" autocomplete="off" autofocus required>
                                                <option></option>
                                                @foreach($allLanguages as $language)
                                                <option @if($language->id == $languageSpoken->language_id) selected @endif value="{{$language->id}}">{{$language->isoName}}</option>
                                                @endforeach
                                            </select>
                                            <label class="floating-label">{{ __('frontstaticword.Language').' *' }}</label>
                                        </div>
                                    </div>
                                    @if($language_key == 0)<span class="bottom style-add add"><i class="fas fa-plus"></i></span>
                                    @else<div class="bottom icon-erm remove"><span class="fas fa-times"></span></div>@endif
                                </div>
                                @endforeach
                                <div class="optionBox w-100">
                                    <div class="col-sm-12 add-fild"></div>
                                </div>
                                <div class="col-sm-12 fild"><span class="ealamuh">@if($currency and trim($currency->currency) != '' and $currency->currency != NULL) {{ $currency->currency }} @else {{ __('frontend.current_currency') }} @endif</span>
                                    <input class="form-control" type="number" min="1" max="9000000000000000000" placeholder="{{ __('frontstaticword.hourRate') }}" @if(isset($tutor->PricePerHour)) value="{{$tutor->PricePerHour}}" @endif
                                    name="PricePerHour" autocomplete="off" autofocus>
                                    <label class="floating-label">{{ __('frontstaticword.hourRate').' *' }}</label>
									@if($errors->has('PricePerHour'))
                                    <span class="error">
                                        <strong>{{ $errors->first('PricePerHour') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-12 fild">
                                    <input class="form-control mobile" type="text" placeholder="{{ __('frontend.enter_your_mobile') }}" @if(isset($tutor->user->mobile)) value="{{$tutor->user->mobile}}" @endif
                                    name="mobile" autocomplete="off" autofocus required>
									<label class="floating-label">{{ __('frontstaticword.mobile').' *' }}</label>
                                    <span class="text-danger">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                </div>
                                <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required" name="time_zone_id" autocomplete="off" autofocus required>
                                        <option> </option>
                                        @foreach($timeZones As $zone)
                                        <option @if(Auth::User()->time_zone_id == $zone->id)) selected @endif
                                            value="{{$zone->id}}">{{$zone->time_zone_name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.TimeZone').' *' }}</label>
                                </div>
                                <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i>
                                    <select class="form-control required select2" name="categories[]" required multiple="multiple">
                                        @foreach($categories As $category)
                                        <optgroup label="{{ $category->title }}">
                                            @foreach($category->subcategory->where('status', 1) as $subcategory)
                                            <option value="{{ $subcategory->id }}" @if($tutor->user and in_array($subcategory->id, $tutor->user->category->pluck('subcategory_id')->toArray())) {{ 'selected' }} @endif>{{ $subcategory->title }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <label class="floating-label">{{ __('frontstaticword.Specialties').' *' }}</label>
                                    @if($errors->has('categories'))
                                    <div class="error">
                                        {{ $errors->first('categories') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h2 class="title sh__m">{{ __('frontend.financial_info') }}</h2>
                            <div class="bank-account">
                                <div class="head-title d-flex">
                                    <span>{{ __('frontend.bank_account') }}</span>
                                </div>
                                <div class="row">


                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="number" name="account_number" @if(isset($tutorPaymentInfo->account_number))
                                        value="{{$tutorPaymentInfo->account_number}}" @endif placeholder="{{ __('frontstaticword.enter') }}"
                                        autocomplete="off"
                                        autofocus>
                                        <label class="floating-label">{{ __('frontend.account_number') }}</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" name="iban" @if(isset($tutorPaymentInfo->iban)) value="{{$tutorPaymentInfo->iban}}"
                                        @endif placeholder="{{ __('frontstaticword.enter') }}" autocomplete="off"
                                        autofocus>
                                        <label class="floating-label">{{ __('frontend.iban') }}</label>
                                    </div>
                                    <div class="col-sm-12 fild">
                                        <input class="form-control" type="text" @if(isset($tutorPaymentInfo->account_name))
                                        value="{{$tutorPaymentInfo->account_name}}" @endif name="account_name"
                                        placeholder="{{ __('frontstaticword.enter') }}" autocomplete="off"
                                        autofocus>
                                        <label class="floating-label">{{ __('frontend.account_name') }}</label>
                                    </div>
                                </div>
                                {{-- <div class="head-title d-flex">--}}
                                {{-- <span>Bank account</span><a class="bottom btn-edit " href="#edit-bank"--}}
                                {{-- data-toggle="modal"><i class="fas fa-pen"></i></a>--}}
                                {{-- </div>--}}
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="item-bank">
                                            @if(isset($tutorPaymentInfo->account_name))
                                            <div class="account-name d-flex">
                                                <span> {{$tutorPaymentInfo->account_name}} </span><a href="#" class="bottom btn-remove deletePaymentInfo" id="{{$tutorPaymentInfo->id}}"><i class="fas fa-trash"></i></a>
                                            </div>
                                            @endif
                                            <div class="bank-num">
                                                {{-- <span> **** **** **** **12 </span>--}}
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!----->
                            <input type="text" name="page" value="about" readonly hidden>
                            <div class="bot-all">
                                <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                                    {{ __('frontstaticword.settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="item-2" role="tabpanel" aria-labelledby="item-2-tab">
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-10 prin-item">
                            <h2 class="title">{{ __('frontstaticword.profileImage') }}</h2>
                            <div class="row">
                                <div class="col-sm-3 item-tab">
                                    <div class="imgcent"><img class="img_prev" src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" alt="" title="">
                                        <label class="file-bro">{{ __('frontstaticword.uploadPhoto') }}
                                            <input type="file" name="user_img" onchange="readURL(this);" style="display: none;">
                                        </label>
                                    </div>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontstaticword.imageFormatCondition') }} </p>
                                    <h3 class="title siza mt-4">{{ __('frontend.profile_upload_photo_text_1') }}</h3>
                                    <ul class="list-item mt-3">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_2') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_3') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_4') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_5') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_6') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_7') }}
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726">
                                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                                    <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                    <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                                </g>
                                            </svg>{{ __('frontend.profile_upload_photo_text_8') }}

                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-8 offset-sm-1 item-tab2">
                                    <div class="row">
                                        <div class="col-sm-12 fild">
                                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.headLine') }}" @if(isset($tutor->headline)) value="{{$tutor->headline}}" @endif
                                            name="headline" autocomplete="off" autofocus required>
                                            <label class="floating-label">{{ __('frontstaticword.headLine').' *' }}</label>
                                            <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.profile_headLine_text') }}</p>
                                        </div>
                                        <div class="col-sm-12 fild">
                                            <textarea class="form-control" name="detail" autocomplete="off" autofocus required>@if(isset($tutor->detail)) {{ strip_tags($tutor->detail) }} @endif </textarea>
                                            <label class="floating-label">{{ __('frontend.about_the_tutor').' *' }}</label>
                                            <p class="textsacand"><i class="fas fa-info-circle"></i> <span id="remain">250 </span> {{ __('frontend.characters_minimum') }} 0 {{ __('frontend.characters_currently') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="page" value="profile description" readonly hidden>

                        <div class="col-sm-12 bot-all st-flex">
                            <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                                {{ __('frontstaticword.settings') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="item-3" role="tabpanel" aria-labelledby="item-3-tab">
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="title">{{ __('frontstaticword.Video') }}</h4>
                    <input type="radio" @if($tutor->youtube_url != null) checked @endif id="youtubeCheckBox" name="tab"
                    value="igotnone" onclick="show1();" required />
                    {{ __('frontend.youtube') }}
                    <input type="radio" @if($tutor->video != null) checked @endif id="videoCheckBox" name="tab"
                    value="igottwo" onclick="show2();"required />
                    {{ __('frontend.upload') }}
                    <div class="row">
                        <div class="col-sm-7 itemform">
                            <div class="item-us" id="div1" @if($tutor->youtube_url == null) style="display: none" @endif
                                >
                                <div class="iframe">
                                    <iframe src="{{Auth::user()->youtube_url}}" allowTransparency="true" allow="encrypted-media"></iframe>
                                </div>
                                <h4 class="title siza mt-5">{{ __('frontend.upload_new_video') }}</h4><span class="great">{{ __('frontend.paste_a_link_to_your_video') }}</span>
                                <p class="textsacand"><i class="fas fa-info-circle"></i> {{ __('frontend.learn_how_to_upload_videos_to') }}
                                    <a href="https://www.youtube.com/create_channel?next=https%3A%2F%2Fstudio.youtube.com%2Fchannel%2FUC%2Fvideos%3Fd%3Dud" target="_blank">{{ __('frontend.youtube') }} </a> {{ __('frontend.or') }} <a href="https://vimeo.com/upload" target="_blank">{{ __('frontend.vimeo') }} </a>
                                </p>
                                <div class="fild">
                                    <input class="form-control" type="url" placeholder="www.youtube.com/watch?v=l5aZJBLAu1E" value="{{\Illuminate\Support\Facades\Auth::user()->youtube_url}}" name="url" autocomplete="off" autofocus>
                                    <label class="floating-label">{{ __('frontend.paste_link') }}</label>
                                </div>

                            </div>
                            {{-- <video d id="webcam" autoplay width="640" height="480" controls></video>--}}
                            <canvas id="canvas" class="d-none"></canvas>
                            {{--<audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>--}}
                            {{-- <div class="item-us"><span class="great"> record your video</span>--}}
                            {{-- <p class="textsacand"><i class="fas fa-info-circle"></i>   Show students your teaching style and personality</p>--}}
                            {{-- <nav class="bot-action"><a id="startButton" class="bottom">Start Recording</a>--}}
                            {{-- <a class="bottom" onclick="openCam()">Test Camera</a>--}}
                            {{-- <a  id="stopButton" class="bottom">Stop</a>--}}
                            {{-- <a  id="downloadButton" class="bottom">Download</a>--}}
                            {{-- </nav>--}}
                            {{-- </div>--}}
                            <div id="div2" @if($tutor->video == null) style="display: none" @endif class="hide"><span class="great">{{ __('frontend.or_upload_your_video') }}</span>
                                <div class="custom-file">
                                    <input class="custom-file-input" type="file" id="uploadVideo" accept="video/mp4,video/x-m4v,video/*" name="uploadVideo">
                                    <label class="custom-file-label" for="customFile">{{ __('frontend.no_file') }} </label>
                                </div>
                                <video class="player-course-chapter-list" loop muted src="{{ asset('files/instructor/'.$tutor->video) }}" controls>
                                </video>
                            </div>

                        </div>
                        <div class="col-sm-4 itemform offset-sm-1">
                            <h5 class="title siza">{{ __('frontend.tips_for_an_amazing_video') }}</h5>
                            <ul class="list-item">
                                <li class="great"><i class="fas fa-circle"></i>{{ __('frontend.technical') }}</li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_1') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_2') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_3') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_4') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_5') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_6') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_7') }}
                                </li>
                            </ul>
                            <ul class="list-item">
                                <li class="great"><i class="fas fa-circle"></i> {{ __('frontend.content') }}</li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_8') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_9') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_10') }}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 21.013 20.726"></svg>
                                    <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle" transform="translate(-2.248 -2.229)">
                                        <path id="Path_31914" data-name="Path 31914" d="M22.2,11.714V12.6a9.6,9.6,0,1,1-5.693-8.775" transform="translate(0 0)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        <path id="Path_31915" data-name="Path 31915" d="M25.98,6l-9.6,9.61L13.5,12.73" transform="translate(-3.78 -1.083)" fill="none" stroke="#ba9a74" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    </g>{{ __('frontend.profile_upload_video_text_11') }}
                                </li>
                            </ul>
                        </div>
                        <input type="text" name="page" value="video" readonly hidden>

                        <div class="col-sm-12 bot-all st-flex">
                            <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                                {{ __('frontstaticword.settings') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="tab-pane fade" id="item-4" role="tabpanel" aria-labelledby="item-4-tab">
                <h4 class="title">{{ __('frontstaticword.ProfileVerification') }}</h4>
                <div class="col-sm-8 itemform">
                    <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <a style=" color: #af8b62" href="{{ asset('files/instructor/'.$tutor['file']) }}" download="{{$tutor['file']}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download" style=" color: #af8b62"></i></a>
                            {{-- <div class="textmap fletext"><i class="fas fa-check"> </i><span>profile ID is verified</span></div>--}}
                            <h4 class="title siza mt-5">{{ __('frontend.upload_new_document') }}</h4>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="customFile" name="file" required>
                                <label class="custom-file-label" for="customFile">{{ __('frontend.no_file') }} </label>
                            </div>
                            <div class="textmap"><i class="fas fa-unlock-alt"> </i>
                                <p>{{ __('frontend.safe') }} </p><span>{{ __('frontend.ProfileVerification_text') }}</span>
                            </div>
                            <input type="text" name="page" value="document" readonly hidden>

                            <div class="col-sm-12 bot-all st-flex">
                                <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                                    {{ __('frontstaticword.document') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>-->
            <div class="tab-pane fade" id="item-5" role="tabpanel" aria-labelledby="item-5-tab">
                <h4 class="title">{{ __('frontstaticword.Resume') }}</h4>
                <!--form(action="")
                div.row
                 div.col-sm-8.itemform
                  div.education
                   div.head-title
                    h5.title Education
                    span(class="bottom style-add add7") <i class="fas fa-plus"></i>
                   div.row
                    div.col-sm-12.add-fild7
                     div.row
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Enter"  autocomplete="off" autofocus required)
                        label.floating-label University/ college
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Degree"  autocomplete="off" autofocus required)
                        label.floating-label Degree
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Speciality"  autocomplete="off" autofocus required)
                        label.floating-label Enter
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="From" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label From
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="To" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label To
                    div.optionBox7.w-100
                     div.col-sm-12.add-fild7
                   div.custom-file
                     input(type="file" class="custom-file-input" id="customFile" name="file"  required)
                     label(class="custom-file-label" for="customFile") no file
                   p.textmap.linbox <i class="fas fa-info-circle"></i>   JPG or PNG format  Maximum 5 MB

                  div.education
                   div.head-title
                    h5.title Work experience
                    span(class="bottom style-add add8") <i class="fas fa-plus"></i>
                   div.row
                    div.col-sm-12.add-fild8
                     div.row
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Company"  autocomplete="off" autofocus required)
                        label.floating-label Company
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Title"  autocomplete="off" autofocus required)
                        label.floating-label Title
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="From" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label From
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="To" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label To
                    div.optionBox8.w-100
                     div.col-sm-12.add-fild8
                   div.custom-file
                     input(type="file" class="custom-file-input" id="customFile" name="file"  required)
                     label(class="custom-file-label" for="customFile") no file
                   p.textmap.linbox <i class="fas fa-info-circle"></i>   JPG or PNG format  Maximum 5 MB

                  div.education
                   div.head-title
                    h5.title Certificate
                    span(class="bottom style-add add9") <i class="fas fa-plus"></i>
                   div.row
                    div.col-sm-12.add-fild9
                     div.row
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Certificate"  autocomplete="off" autofocus required)
                        label.floating-label Certificate
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Description"  autocomplete="off" autofocus required)
                        label.floating-label Description
                      div.col-sm-12.fild
                        input(type="text" class="form-control" placeholder="Enter" name="Issued By"  autocomplete="off" autofocus required)
                        label.floating-label Issued By
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="From" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label From
                      div.col-sm-6.fild
                       i(class="fas fa-chevron-down iconsel")
                       select(class="form-control required" name="To" autocomplete="off" autofocus required)
                        option
                        option choose
                        option choose
                        option choose
                       label.floating-label To
                    div.optionBox9.w-100
                     div.col-sm-12.add-fild9
                   div.custom-file
                     input(type="file" class="custom-file-input" id="customFile" name="file"  required)
                     label(class="custom-file-label" for="customFile") no file
                   p.textmap.linbox <i class="fas fa-info-circle"></i>   JPG or PNG format  Maximum 5 MB
                 div.col-sm-12.bot-all.st-flex
                   button(class="bottom" type="submit") Save Settings
                -->
                <div class="edit-all">
                    <div class="item-edit">
                        <div class="head-title">
                            <h5 class="title">{{ __('frontend.education') }} </h5><a class="bottom style-add" href="#add-item-education" data-toggle="modal"><i class="fas fa-plus"></i></a>
                        </div>
                        @if($tutorEducations->count() > 0)
                        @foreach($tutorEducations as $education)
                        @if(isset($education->from))
                        <div class="row-tow">
                            <div class="date">{{$education->from}}-{{$education->to}}</div>
                            <div class="primary">
                                <div class="head-title">
                                    <h5 class="title">{{$education->university}} </h5><a class="bottom style-add" href="#edit-education" data-toggle="modal"><i class="fas fa-pen edit-edu" data_id="{{$education->id}}"></i></a>
                                    <a class="bottom style-add" href="/tutor/education/delete/{{$education->id}}"><i class="fas fa-trash" data_id="{{$education->id}}"></i></a>
                                </div><small>{{$education->specialty}} , {{$education->degree}}</small>
                                @if($education->file)<a style=" color: #af8b62" href="{{ asset('files/instructor/attachs/'.$education->file) }}" download="{{$education->file}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download" style=" color: #af8b62"></i></a>@endif
                                <div class="textmap fletext"></div>
                            </div>
                            <div class="textmap revie"><i class="fas fa-unlock-alt"> </i>
                                <p>{{ __('frontend.education_text_1') }} </p><span>{{ __('frontend.education_text_2') }}</span>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="item-edit">
                        <div class="head-title">
                            <h5 class="title">{{ __('frontend.work_experience') }} </h5><a class="bottom style-add" href="#add-item-experience" data-toggle="modal"><i class="fas fa-plus"></i></a>
                        </div>
                        @if($tutorExperiences->count() > 0 )
                        @foreach($tutorExperiences as $experience)
                        @if(isset($experience->from))
                        <div class="row-tow">
                            <div class="date">{{$experience->from}}-{{$experience->to}}</div>
                            <div class="primary">
                                <div class="head-title">
                                    <h5 class="title">{{$experience->company}}</h5><a class="bottom style-add" href="#edit-work" data-toggle="modal"><i class="fas fa-pen"></i></a>
                                    <a class="bottom style-add" href="/tutor/experience/delete/{{$experience->id}}"><i class="fas fa-trash" data_id="{{$experience->id}}"></i></a>
                                </div><small>{{$experience->title}}</small>
                                @if($experience->file)<a style=" color: #af8b62" href="{{ asset('files/instructor/attachs/'.$experience->file) }}" download="{{$experience->file}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download" style=" color: #af8b62"></i></a>@endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="item-edit">
                        <div class="head-title">
                            <h5 class="title">{{ __('frontend.certifications') }}</h5><a class="bottom style-add" href="#add-item-certificate" data-toggle="modal"><i class="fas fa-plus"></i></a>
                        </div>
                        @if($tutorCertificates->count() > 0 )
                        @foreach($tutorCertificates as $certificate)
                        @if(isset($certificate->from))
                        <div class="row-tow">
                            <div class="date">{{$certificate->from}}-{{$certificate->to}}</div>
                            <div class="primary">
                                <div class="head-title">
                                    <h5 class="title">{{$certificate->certificate}}</h5><a class="bottom style-add" href="#edit-certificate" data-toggle="modal"><i class="fas fa-pen"></i></a>
                                    <a class="bottom style-add" href="/tutor/certificate/delete/{{$certificate->id}}"><i class="fas fa-trash" data_id="{{$certificate->id}}"></i></a>
                                </div><small>{{$certificate->description}}</small>
                                @if($certificate->file)<a style=" color: #af8b62" href="{{ asset('files/instructor/attachs/'.$certificate->file) }}" download="{{$certificate->file}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download" style=" color: #af8b62"></i></a>@endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="item-6" role="tabpanel" aria-labelledby="item-6-tab">
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="title">{{ __('frontstaticword.Password') }}</h2>
                    <div class="row">
                        <div class="col-sm-8 item-tab2">
                            <div class="row">
                                <div class="col-sm-12 fild">
                                    <input class="form-control" type="password" placeholder="{{ __('frontend.enter_your_password') }}" name="oldPassword" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontend.current').' '.__('frontstaticword.Password') }}</label><a class="forget" href="{{ '/password/reset' }}">{{ __('frontstaticword.ForgotPassword') }} ?</a>
                                </div>
                                <div class="col-sm-12 fild">
                                    <input class="form-control" type="password" minlength="8" maxlength="100" placeholder="{{ __('frontend.enter_a_password') }}" name="password" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontend.new').' '.__('frontstaticword.Password') }}</label>
                                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>

                                </div>
                                <div class="col-sm-12 fild">
                                    <input class="form-control" type="password" minlength="8" maxlength="100" placeholder="{{ __('frontend.enter_confirm_password') }}" name="vPassword" autocomplete="off" autofocus required>
                                    <label class="floating-label">{{ __('frontend.verify').' '.__('frontstaticword.Password') }}</label>
                                    <span class="text-danger">{{ $errors->has('vPassword') ? $errors->first('vPassword') : '' }}</span>

                                </div>
                                <input type="text" value="password" hidden name="page" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="bot-all">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                            {{ __('frontstaticword.settings') }}</button>
                    </div>
                </form>
            </div>
            <!--<div class="tab-pane fade" id="item-7" role="tabpanel" aria-labelledby="item-7-tab">
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 prin-item">
                            <h2 class="title">{{ __('frontend.notification_center') }}</h2>
                            <div class="check-notif">
                                <h3 class="title siza">{{ __('frontend.email_notifications') }}</h3>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    1, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[0]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[0]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[0]->name.'_text') }}</small>
                                </label>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    2, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[1]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[1]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[1]->name.'_text') }}</small>
                                </label>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    3, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[2]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[2]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[2]->name.'_text') }}</small>
                                </label>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    4, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[3]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[3]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[3]->name.'_text') }}</small>
                                </label>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    5, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[4]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[4]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[4]->name.'_text') }}</small>
                                </label>
                            </div>
                            <div class="check-notif">
                                <h3 class="title siza">SMS notifications</h3>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    6, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[5]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[5]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[5]->name.'_text') }}</small>
                                </label>
                            </div>
                            <div class="check-notif">
                                <h3 class="title siza">Arabi insights</h3>
                                <label class="che-box">
                                    <input type="checkbox" @foreach($tutorNotificationsSettings as $tutorNotificationsSetting)@if(in_array($tutorNotificationsSetting->type_id ==
                                    7, array($tutorNotificationsSetting))) checked @endif @endforeach
                                    name="notification[]" value="{{$notificationTypes[6]->id}}"><span class="label-text">{{ __('frontstaticword.'.$notificationTypes[6]->name)}}</span><small>{{ __('frontend.'.$notificationTypes[6]->name.'_text') }}</small>
                                </label>
                            </div>
                            <input type="text" name="page" value="notification" hidden readonly>
                            <div class="bot-all">
                                <button class="bottom" type="submit">{{ __('frontstaticword.save') }}
                                    {{ __('frontstaticword.settings') }}</button><a class="bottom last-bot" href="/tutor/Unsubscribe">{{ __('frontend.unsubscribe_them_all') }} </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>-->
        </div>
    </div>
</section>
<div class="modal fade" id="edit-bank" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.edit').' '.__('frontend.bank_account') }}</h3>
                <form action="{{ route('tutor.experience.update') }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="number" name="account_number" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($tutorPaymentInfo->account_number))
                            value="{{$tutorPaymentInfo->account_number}}" @endif
                            autocomplete="off" autofocus>
                            <label class="floating-label">{{ __('frontend.account_number') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" name="iban" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($tutorPaymentInfo->iban)) value="{{$tutorPaymentInfo->iban}}" @endif
                            autocomplete="off" autofocus>
                            <label class="floating-label">{{ __('frontend.iban') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" name="account_name" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($tutorPaymentInfo->account_name)) value="{{$tutorPaymentInfo->account_name}}"
                            @endif
                            autocomplete="off" autofocus>
                            <label class="floating-label">{{ __('frontend.account_name') }}</label>
                        </div>


                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="edit-education" role="dialog">
    @if($tutorEducations->count() > 0)
    @foreach($tutorEducations as $education)
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.edit').' '.__('frontend.education') }}</h3>
                <form action="{{ route('tutor.education.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" @if(isset($education->university))
                            value="{{$education->university}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="university"
                            autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.university/college') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" @if(isset($education->degree))
                            value="{{$education->degree}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="degree" autocomplete="off"
                            autofocus required>
                            <label class="floating-label">{{ __('frontend.degree') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" @if(isset($education->specialty))
                            value="{{$education->specialty}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="specialty"
                            autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.specialty') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($education->from))
                            value="{{$education->from}}" @endif placeholder="Enter" name="from" autocomplete="off"
                            autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($education->to))
                            value="{{$education->to}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off" autofocus
                            required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                        <input type="text" name="educationId" @if(isset($education->id)) value="{{$education->id}}"
                        @endif readonly hidden>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<div class="modal fade" id="edit-work" role="dialog">
    @if($tutorExperiences->count() > 0)
    @foreach($tutorExperiences as $experience)
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.edit').' '.__('frontend.work_experience') }}</h3>
                <form action="{{ route('tutor.experience.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($experience->company))
                            value="{{$experience->company}}" @endif name="company" autocomplete="off" autofocus
                            required>
                            <label class="floating-label">{{ __('frontend.company') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($experience->title))
                            value="{{$experience->title}}" @endif name="title" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.title') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($experience->from))
                            value="{{$experience->from}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="from" autocomplete="off"
                            autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($experience->to))
                            value="{{$experience->to}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off"
                            autofocus required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                        <input type="text" name="experienceId" @if(isset($experience->id)) value="{{$experience->id}}"
                        @endif readonly hidden>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<div class="modal fade" id="edit-certificate" role="dialog">
    @if($tutorCertificates->count() > 0)
    @foreach($tutorCertificates as $certificate)
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.edit').' '.__('frontend.certificate') }}</h3>
                <form action="{{ route('tutor.certificate.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($certificate->certificate)) value="{{$certificate->certificate}}" @endif
                            name="certificate" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.certificate') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" @if(isset($certificate->description)) value="{{$certificate->description}}" @endif
                            name="description" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.description') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="issuedBy" @if(isset($certificate->Issuedby)) value="{{$certificate->Issuedby}}" @endif
                            autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.issued_by') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($certificate->from))
                            value="{{$certificate->from}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="from" autocomplete="off"
                            autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" @if(isset($certificate->to))
                            value="{{$certificate->to}}" @endif placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off"
                            autofocus required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                        <input type="text" name="certificateId" @if(isset($certificate->id))
                        value="{{$certificate->id}}" @endif readonly hidden>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>

<div class="modal fade" id="add-item-education" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.add').' '.__('frontend.education') }}</h3>
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data" id="form_modal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="college" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.university/college') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="Degree" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.degree') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="speciality" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.specialty') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="from" autocomplete="off" autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                    </div>
                    <input type="text" name="page" value="addEducation" readonly hidden>

                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-item-experience" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.add').' '.__('frontend.work_experience') }}</h3>
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data" id="form_modal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="company" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.company') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="title" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.title') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="from" autocomplete="off" autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                    </div>
                    <input type="text" name="page" value="addExperience" readonly hidden>

                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-item-certificate" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <h3 class="title">{{ __('frontend.add').' '.__('frontend.certificate') }}</h3>
                <form action="{{ route('tutor.profile.update') }}" method="post" enctype="multipart/form-data" id="form_modal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="certificate" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.certificate') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="description" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.description') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="text" placeholder="{{ __('frontstaticword.enter') }}" name="issuedBy" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.issued_by') }}</label>
                        </div>
                        <div class="col-sm-12 fild">
                            <input class="form-control" type="file" name="attach_file" />
                            <label class="floating-label">{{ __('frontend.file') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="from" autocomplete="off" autofocus required>

                            <label class="floating-label">{{ __('frontend.from') }}</label>
                        </div>
                        <div class="col-sm-6 fild">
                            <input class="form-control" type="date" placeholder="{{ __('frontstaticword.enter') }}" name="to" autocomplete="off" autofocus required>
                            <label class="floating-label">{{ __('frontend.to') }} </label>
                        </div>
                    </div>
                    <input type="text" name="page" value="addCertificate" readonly hidden>

                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.save') }}</button><a class="bottom" href="#" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footerAssets')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    (function($) {
        $(".select2").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    })(jQuery);
</script>

<script>
    var lang = <?= json_encode($allLanguages); ?>;
    var spoke_lang_count = "{{ $languagesSpoken->count() }}";
    var lang_index_start = 1;
    if (spoke_lang_count > 0) lang_index_start = spoke_lang_count;

    (function($) {
        // function openCam() {
        //
        //     const webcamElement = document.getElementById('webcam');
        //     const canvasElement = document.getElementById('canvas');
        //     const snapSoundElement = document.getElementById('snapSound');
        //     const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
        //
        //     webcam.start()
        //         .then(result =>{
        //             console.log("webcam started");
        //         })
        //         .catch(err => {
        //             console.log(err);
        //         });
        //     let picture = webcam.snap();
        //     document.querySelector('#download-photo').href = picture;
        //
        // }
        var session = '<?php echo session('pageTab') ?>';

        if (session == 1) {
            $('#item-1-tab').click();
        }
        if (session == 2) {

            $('#item-2-tab').click();
        }
        if (session == 3) {

            $('#item-3-tab').click();
        }
        if (session == 4) {

            $('#item-4-tab').click();
        }
        if (session == 5) {

            $('#item-5-tab').click();
        }
        if (session == 6) {

            $('#item-6-tab').click();
        }
        if (session == 7) {

            $('#item-7-tab').click();
        }

        $('.deletePaymentInfo').on('click', function() {
            var id = $(this).attr('id');
            if (confirm('Are you Sure To Delete This Payment Info !?')) {
                $.ajax({

                    url: '/api/deletePaymentInfo',
                    async: false,
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        id: id
                    },

                    success: function(data) {
                        // console.log('It Works');
                        location.reload();
                    }

                })
            }
        });

        $(function() {

            $("#form_modal").validate({
                rules: {
                    from: {
                        required: true,

                    },

                },
                messages: {
                    from: {
                        required: "{{ __('frontend.please_enter_some_data') }}",

                    },
                    to: {
                        required: "{{ __('frontend.please_enter_some_data') }}",

                    },
                }
            });
        });


        function show1() {
            document.getElementById('div1').style.display = 'block';
            document.getElementById('div2').style.display = 'none';

        }

        function show2() {
            document.getElementById('div1').style.display = 'none';
            document.getElementById('div2').style.display = 'block';

        }


        var youTubeURL = "{{ $tutor->user->youtube_url }}";
        var videoURL = "{{ $tutor->video }}";


        if (youTubeURL == '') {
            $("#videoCheckBox").prop('checked', true);
            show2();
        } else {
            $("#youtubeCheckBox").prop('checked', true);

            show1();
        }
    })(jQuery);
</script>

@endsection
