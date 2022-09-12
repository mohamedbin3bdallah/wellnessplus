@extends('frontend.layouts.layout')
@section('title', __('frontend.home'))
@section('pageContent')
@include('admin.message')
<!-- <div class="menubab">
    <div class="container">
        <nav class="setting-menu">
            <a href="/">{{ __('frontstaticword.home') }}</a>
            {{-- <a href="/about">About Us</a> --}}
            <a href="/find/tutor">{{ __('frontstaticword.FindATutor') }}</a>

            <a href="/find/tutor"> Find a Therapist</a>

            <a href="/registration">{{ __('frontstaticword.BecomeATutor') }}</a>
        </nav>
        <nav class="social">
            <a class="fab fa-facebook-f icon-facebook" href="https://www.facebook.com/wellness-114238373695322" target="_blank" title="Facebook"></a>
            <a class="fab fa-twitter icon-twitter" href="https://twitter.com/wellnessPlatform" target="_blank" title="Twitter"></a>
            <a class="fab fa-instagram icon-instagram" href="https://instagram.com/wellnessplatform?igshid=7lamdlyg2kf2" target="_blank" title="Instagram"></a>
            {{-- <a class="fab fa-linkedin-in icon-linkedin" href="#" target="_blank" title="linkedin"></a> --}}
            <a class="fab fa-youtube icon-youtube" href="https://www.youtube.com/channel/UCKVoz6IAXIVE0dsMbzxy1sQ" target="_blank" title="YouTube"> </a>
            {{-- <a class="fab fa-google icon-gplus" href="#" target="_blank" title="google"></a> --}}
        </nav>
    </div>
</div> -->

<section class="slider">

    <div class=" item">
        <div class="prod-slider">
            <div class="slider-item">
                <div class="slider-img"><img src="/frontAssets/images/mainslide.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="inner">
                                <p class="new"><span>{{ __('frontend.home_slider_1') }}</span>{{ __('frontend.home_slider_2') }}</p>
                                <h2 class="title">{{ __('frontend.home_slider_3') }}<br />
                                    {{ __('frontend.home_slider_4') }}<br />
                                    {{ __('frontend.home_slider_5') }}</h2>
                                <p class="text-bot">{{ __('frontend.home_slider_6') }}<br />
                                    {{ __('frontend.home_slider_7') }}</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item">
                <div class="slider-img"><img src="/frontAssets/images/mainslide.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="inner">
                                <p class="new"><span>{{ __('frontend.home_slider_1') }}</span>{{ __('frontend.home_slider_2') }}</p>

                                <h2 class="title">{{ __('frontend.home_slider_3') }}<br />
                                    {{ __('frontend.home_slider_4') }}<br />
                                    {{ __('frontend.home_slider_5') }}</h2>
                                <p class="text-bot">{{ __('frontend.home_slider_6') }}<br />
                                    {{ __('frontend.home_slider_7') }}</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


            <div class="container">
                <div class="row ">
                    <div class="col-lg-9">

                        <div class="search__fields">
						<form class="filter-item" action="{{route('findTutor.search')}}" method="get">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="29.181" height="29.181" viewBox="0 0 29.181 29.181">
                                    <path id="search" d="M32.111,29.629,25.5,23.013a12.3,12.3,0,1,0-2.482,2.482l6.616,6.616a1.758,1.758,0,0,0,2.482-2.482ZM6.885,15.66a8.775,8.775,0,1,1,8.775,8.775A8.775,8.775,0,0,1,6.885,15.66Z" transform="translate(-3.375 -3.375)" fill="#D8D8D8" />
                                </svg>

                            </span>

                            <div class="group-fields">
                                <div class="field">

                                    <input type="text" class="form-control btn-doctor" name="searchWord" placeholder="{{ __('frontend.search_by_name') }}">
                                </div>
                                <div class="field">

                                    <div class="btn-group">

                                        <select class="country" name="categories[]" autocomplete="off" data-placeholder="{{ __('frontstaticword.Specialties') }}"  autofocus multiple="multiple">
											@foreach($categories as $category)
												<optgroup label="{{ $category->title }}">
													@foreach($category->subcategory->where('status', 1) as $subcategory)
														<option value="{{ $subcategory->id }}" @if(collect(old('categories'))->contains($subcategory->id)) {{ 'selected' }} @endif>{{ $subcategory->title }}</option>
													@endforeach
												</optgroup>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="field">

                                    <div class="btn-group">
										<select class="country" data-max="" name="country[]" data-placeholder="{{ __('frontstaticword.nationality') }}" multiple="multiple" id="country_id">
											@foreach($countries as $country)
												<option value="{{$country->id}}">{{$country->name}}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                                <div class="field">

                                    <div class="btn-group">
                                        <select class="langu" data-placeholder="{{ __('frontstaticword.Language') }}" name="Language[]" multiple="multiple" id="languages">
											@foreach($allLanguages as $language)
												<option value="{{$language->id}}"> {{$language->isoName}}</option>
											@endforeach
										</select>
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-solid btn-search-booking">

                                {{ __('frontend.search') }}
                            </button>
						</form>
                        </div>

                    </div>
                    <!--<div class="search__block__mobile d-block d-md-none">
                        <div class="bg-white btn-search d-flex align-items-center">
                            <div class="ico me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.575" height="20.2" viewBox="0 0 39.575 37.2">
                                    <g id="search" transform="translate(0.1 0.1)">
                                        <path id="Path_38213" data-name="Path 38213" d="M95.775,280.848a.8.8,0,0,0-1.088-.007.692.692,0,0,0-.008,1.022l.059.056a.8.8,0,0,0,1.088,0,.692.692,0,0,0,0-1.022Zm0,0" transform="translate(-87.232 -260.352)" fill="#521e81" stroke="#521e81" stroke-width="0.2" />
                                        <path id="Path_38214" data-name="Path 38214" d="M75.046,59.069a11.436,11.436,0,0,0-15.444,0,9.782,9.782,0,0,0-2.013,11.912.794.794,0,0,0,1.035.316.7.7,0,0,0,.336-.972,8.4,8.4,0,0,1,1.73-10.235,9.826,9.826,0,0,1,13.269,0,8.455,8.455,0,0,1,0,12.469A9.868,9.868,0,0,1,63.37,74.324a.79.79,0,0,0-1.021.351.7.7,0,0,0,.373.96,11.455,11.455,0,0,0,4.582.949,11.325,11.325,0,0,0,7.743-3,9.841,9.841,0,0,0,0-14.512Zm0,0" transform="translate(-52.097 -52.016)" fill="#521e81" stroke="#521e81" stroke-width="0.2" />
                                        <path id="Path_38215" data-name="Path 38215" d="M39.2,31.735l-10.531-9.9a13.6,13.6,0,0,0,2.286-7.531C30.955,6.418,24.124,0,15.727,0S.5,6.418.5,14.308,7.331,28.617,15.727,28.617a15.863,15.863,0,0,0,8.014-2.147l10.531,9.9a2.416,2.416,0,0,0,3.263,0L39.2,34.8a2.079,2.079,0,0,0,0-3.066ZM2.038,14.308c0-7.093,6.141-12.864,13.689-12.864S29.417,7.215,29.417,14.308,23.276,27.172,15.727,27.172,2.038,21.4,2.038,14.308Zm25.74,8.737,1.7,1.6-2.753,2.587-1.7-1.6A14.929,14.929,0,0,0,27.778,23.045ZM38.112,33.779l-1.665,1.564a.8.8,0,0,1-1.087,0l-7.545-7.089,2.753-2.587,7.545,7.09a.693.693,0,0,1,0,1.022Zm0,0" transform="translate(-0.5 0.001)" fill="#521e81" stroke="#521e81" stroke-width="0.2" />
                                        <path id="Path_38216" data-name="Path 38216" d="M226.666,121.82a.771.771,0,0,0,1.538,0,6.523,6.523,0,0,0-3.921-5.863.792.792,0,0,0-1.027.337.7.7,0,0,0,.359.965A5.073,5.073,0,0,1,226.666,121.82Zm0,0" transform="translate(-206.055 -107.511)" fill="#521e81" stroke="#521e81" stroke-width="0.2" />
                                        <path id="Path_38217" data-name="Path 38217" d="M189.285,109.449a.724.724,0,1,0,0-1.445h-.012a.724.724,0,1,0,0,1.445Zm0,0" transform="translate(-174.045 -100.199)" fill="#521e81" stroke="#521e81" stroke-width="0.2" />
                                    </g>
                                </svg>
                            </div>
                            <div>
                                <span class="d-block w-meduim c-grey">
                                    Dermatologists
                                </span>
                                <span class="d-blcok text-sm">
                                    All Cities, All Areas - Select Insurance
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="searchMobile">
                        <div class="title text-center">
                            <h5 class="mb-0"> Search</h5>
                            <div class="close-search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="group-inputs inputs-search">
                            <input type="text" class="form-control" placeholder="Lorem">
                            <input type="text" class="form-control" placeholder="Lorem">
                            <input type="text" class="form-control" placeholder="Lorem">
                        </div>
                        <div class="list-filter">
                            <ul>
                                <li> Dermatologists</li>
                                <li> Dermatologists</li>
                                <li> Dermatologists</li>
                                <li> Dermatologists</li>
                                <li> Dermatologists</li>
                            </ul>
                        </div>
                    </div> -->
                </div>

            </div>


    </div>
</section>
<section class="licen">
    <p class="title mb-3">
        {{ __('frontend.home_tutor_list_1') }} </p>
    <h2 class="subtitle text-center mb-4 "> {{ __('frontend.home_tutor_list_2') }} </h2>
    <p class="texttop  mb-5">{{ __('frontend.home_tutor_list_3') }}<br /> {{ __('frontend.home_tutor_list_4') }}</p>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="licen-slider">
					@foreach($tutors as $tutor)
                    <div class="slider-item">
                        <div class=" item">
                            <a class="inner-bg" href="/tutor/page/{{ $tutor->id }}">
                                <div class="photo">
									@if($tutor->user->user_img != null || $tutor->user->user_img !='')
										<img src="{{ url('/images/user_img/'.$tutor->user->user_img) }}" >
									@else
										<img src="{{ url('/images/general.png')}}" >
									@endif
                                </div>
                                <div class="layout">
                                    <div><i class="fas fa-star"></i> 5</div>
                                    <h6>{{ $tutor->user->fname.' '.$tutor->user->lname }}</h6>
                                    @if($tutor->user->category->count())
									<p>
                                        {{ __('frontend.home_tutor_list_5') }}
										@foreach($tutor->user->category as $user_category_key => $user_category)
											{{ $user_category->subcategory->title }}
											@if(1+$user_category_key != $tutor->user->category->count())
												{{ ', ' }}
											@endif
										@endforeach
                                    </p>
									@endif
                                </div>


                            </a>
                        </div>


                    </div>
					@endforeach
                </div>
            </div>
        </div>
    </div>

</section>
<section class="specialty">
    <div class="container">
        <p class="title mb-3"> {{ __('frontend.home_tags_1') }}</p>
        <h2 class="subtitle mb-4">{{ __('frontend.home_tags_2') }}</h2>
        <p class="texttop  mb-5"> {{ __('frontend.home_tags_3') }}<br /> {{ __('frontend.home_tags_4') }} </p>
        <div class="items-specialty">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/adult.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'adult') }}">{{ __('frontend.home_tag_list_1') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/child.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'child') }}">{{ __('frontend.home_tag_list_2') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/psypist.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'psychotherapist') }}">{{ __('frontend.home_tag_list_3') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/psygist.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'psychologists') }}">{{ __('frontend.home_tag_list_4') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/coach.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'coach') }}">{{ __('frontend.home_tag_list_5') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/work.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'work') }}">{{ __('frontend.home_tag_list_6') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/couple.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'couple') }}">{{ __('frontend.home_tag_list_7') }}</a></h5>
                            </li>
                            <li>
                                <div>
                                    <img src="/frontAssets/images/personal.svg" />

                                </div>
                                <h5><a href="{{ route('handle.specialty.tag', 'personality') }}">{{ __('frontend.home_tag_list_8') }}</a></h5>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<section class="how-does">
    <div class="container">
        <p class="title mb-3"> {{ __('frontend.home_how_0') }}</p>
        <h2 class="subtitle mb-4 ">{{ __('frontend.home_how_1') }}</h2>
        <p class="texttop  mb-5"> {{ __('frontend.home_how_2') }}</p>
        <div class="se-items">
            <div class="row">
                <div class="col-sm-6 it-text">
                    <div>
                        <h2 class="title-dos"><span>1</span> {{ __('frontend.home_how_3') }}</h2>
                        <p class="text">{{ __('frontend.home_how_4') }}</p>
                    </div>
                </div>
                <div class="col-sm-6 item"><img src="/frontAssets/images/how-1.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                </div>
            </div>
        </div>
        <div class="se-items">
            <div class="row">
                <div class="col-sm-6 item"><img src="/frontAssets/images/how-2.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                </div>
                <div class="col-sm-6 it-text">
                    <div>
                        <h2 class="title-dos"><span>2</span> {{ __('frontend.home_how_5') }}</h2>
                        <p class="text">{{ __('frontend.home_how_6') }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="se-items">
            <div class="row">
                <div class="col-sm-6 it-text">
                    <div>
                        <h2 class="title-dos"><span>3</span> {{ __('frontend.home_how_7') }} </h2>
                        <p class="text">{{ __('frontend.home_how_8') }} </p>
                    </div>
                </div>
                <div class="col-sm-6 item"><img src="/frontAssets/images/how-3.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section class="testmonials">
    <p class="title mb-3">
        {{ __('frontend.home_testimonial_1') }}
    </p>
    <h2 class="subtitle text-center mb-2 "> {{ __('frontend.home_testimonial_2') }} </h2>
    <p class="texttop  mb-5">{{ __('frontend.home_testimonial_3') }}</p>
    <div class="testmonials-slider">
        <div class="slider-item">
            <div class=" item"><a class="inner-bg" href="#">

                    <div class="photo"><img src="/frontAssets/images/clip.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                    </div>
                    <h4 class="name">Laila Omar</h4>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </ul>
                    <p class="text"> By Parent: My daughter's learning
                        sessions went excellent. I was pleased
                        with all of the tips and personalized
                        information given to help her to write,
                        speak and practice Arabic. </p>
                </a></div>


        </div>
        <div class="slider-item">
            <div class="item"><a class="inner-bg" href="#">

                    <div class="photo"><img src="/frontAssets/images/clip2.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                    </div>
                    <h4 class="name">Laila Omar</h4>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </ul>
                    <p class="text"> By Parent: My daughter's learning
                        sessions went excellent. I was pleased
                        with all of the tips and personalized
                        information given to help her to write,
                        speak and practice Arabic. </p>
                </a></div>


        </div>
        <div class="slider-item">
            <div class=" item"><a class="inner-bg" href="#">

                    <div class="photo"><img src="/frontAssets/images/clip3.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                    </div>
                    <h4 class="name">Laila Omar</h4>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </ul>
                    <p class="text"> By Parent: My daughter's learning
                        sessions went excellent. I was pleased
                        with all of the tips and personalized
                        information given to help her to write,
                        speak and practice Arabic. </p>
                </a></div>


        </div>
        <div class="slider-item">
            <div class=" item"><a class="inner-bg" href="#">

                    <div class="photo"><img src="/frontAssets/images/clip3.png" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                    </div>
                    <h4 class="name">Laila Omar</h4>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </ul>
                    <p class="text"> By Parent: My daughter's learning
                        sessions went excellent. I was pleased
                        with all of the tips and personalized
                        information given to help her to write,
                        speak and practice Arabic. </p>
                </a></div>


        </div>
    </div>
</section>
<section class="statics">
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="wrapper-stat">
                    <div class="item-stat">
                        <div class="num">
                            97.54 <span>{{ __('frontend.home_statistics_sign_1') }}</span>
                        </div>
                        <div class="title">
                            <h6> {{ __('frontend.home_statistics_1') }} </h6>
                        </div>
                        <p>{{ __('frontend.home_statistics_1_text') }}</p>

                    </div>
                    <div class="item-stat">
                        <div class="num">
                            4000 <span>{{ __('frontend.home_statistics_sign_2') }}</span>
                        </div>
                        <div class="title">
                            <h6> {{ __('frontend.home_statistics_2') }} </h6>
                        </div>
                        <p>{{ __('frontend.home_statistics_2_text') }}</p>

                    </div>
                    <div class="item-stat">
                        <div class="num">
                            3.200 <span>{{ __('frontend.home_statistics_sign_2') }}</span>
                        </div>
                        <div class="title">
                            <h6> {{ __('frontend.home_statistics_3') }} </h6>
                        </div>
                        <p>{{ __('frontend.home_statistics_3_text') }}</p>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<section class="partners">
    <div class="container">
        <div class="w-100 d-flex flex-wrap justify-content-between align-items-center">
            <div class="item-logo">
                <img src="../frontAssets/images/logo1.svg" />
            </div>
            <div class="item-logo">
                <img src="../frontAssets/images/logo2.svg" />
            </div>
            <div class="item-logo">
                <img src="../frontAssets/images/logo3.svg" />
            </div>
            <div class="item-logo">
                <img src="../frontAssets/images/logo4.svg" />
            </div>
            <div class="item-logo">
                <img src="../frontAssets/images/logo5.svg" />
            </div>
        </div>

    </div>
</section>-->
@endsection

@section('footerAssets')
<script src="/frontAssets/js/grt-youtube-popup.js"></script>
