@extends('frontend.layouts.layout')
@section('title', __('frontstaticword.MyLessons'))

@section('pageContent')
@include('admin.message')



<section class="lessons new-layout">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">
                    <div class="user-info d-flex align-items-center">
                        <div class="user-img">
                                <img src="/frontAssets/images/l2.png" />
                        </div>

                        <div class="info">
                            <h4>Ahmed Shami</h4>
                            <h6>Patient </h6>
                        </div>
                    </div>
                    <nav class="profile-menu">
                        <ul>
                            <li class="lessons">
                                <a class="active " href="{{route('myLessons.show',Auth::User()->id)}}">
                                    <i>
                                        <svg id="invoice" xmlns="http://www.w3.org/2000/svg" width="14.556" height="19.073" viewBox="0 0 14.556 19.073">
                                        <path id="Shape" d="M5.191,19.073H4.819l-.176-.11c-.131-.081-.267-.165-.393-.259a3.862,3.862,0,0,1-.311-.27c-.05-.046-.1-.092-.149-.137l-1.074-.958-.085.074-.077.067q-.177.155-.351.312c-.249.223-.507.454-.77.669a.861.861,0,0,1-.549.2.883.883,0,0,1-.739-.4A1.138,1.138,0,0,1,0,17.6Q0,9.537,0,1.476c0-.072,0-.157.007-.243A.87.87,0,0,1,.7.439.915.915,0,0,1,.894.418a.952.952,0,0,1,.641.275l.787.7.388.342.056-.046c.029-.023.055-.045.08-.067l.4-.358c.3-.271.611-.551.924-.816A3.983,3.983,0,0,1,4.615.132c.069-.044.137-.087.2-.132h.335c.064.041.128.08.193.119.148.09.3.183.44.288a4.535,4.535,0,0,1,.366.318c.055.051.108.1.163.15l.422.376.031.028.51.454.428-.385c.322-.29.626-.564.944-.835A5.548,5.548,0,0,1,9.139.155C9.214.1,9.29.053,9.363,0h.373c.065.044.131.086.2.128a5.148,5.148,0,0,1,.454.316c.2.161.392.337.578.507l.231.209c.213.189.425.378.642.573l.066-.056.085-.073q.189-.166.376-.334c.236-.211.48-.429.727-.637a.874.874,0,0,1,1.295.153,1.067,1.067,0,0,1,.17.671q0,8.07,0,16.14c0,.072,0,.157-.007.241a.87.87,0,0,1-.692.794.916.916,0,0,1-.194.022.948.948,0,0,1-.641-.275c-.347-.309-.695-.617-1.046-.927l-.127-.112-.036.029c-.032.025-.06.048-.087.072q-.213.189-.424.381c-.3.267-.6.544-.912.806a3.88,3.88,0,0,1-.446.312c-.07.045-.138.087-.2.132H9.4c-.064-.041-.128-.08-.193-.119-.148-.09-.3-.183-.44-.288a4.535,4.535,0,0,1-.366-.318c-.055-.051-.108-.1-.163-.15l-.422-.376-.031-.028-.51-.454-.4.355c-.333.3-.647.584-.977.864a5.549,5.549,0,0,1-.489.359c-.075.051-.15.1-.224.155ZM2.717,16.439a1.094,1.094,0,0,1,.712.338l.456.408,1.108.99.074-.063.083-.071,1.431-1.278a1.063,1.063,0,0,1,.7-.322,1.041,1.041,0,0,1,.688.316L9.4,18.036c.033.029.066.057.1.084l.064.053.128-.111.414-.37q.543-.485,1.084-.971a.935.935,0,0,1,.621-.276.756.756,0,0,1,.2.027,1.366,1.366,0,0,1,.5.268c.277.228.541.465.82.715l.334.3V1.316l-.343.307c-.282.253-.548.492-.826.72a1.34,1.34,0,0,1-.5.261.741.741,0,0,1-.183.023.939.939,0,0,1-.63-.288c-.367-.331-.743-.667-1.107-.991l-.019-.017L9.56.9,9.485.961l-.1.089-.722.645L7.94,2.34a1,1,0,0,1-.663.289.985.985,0,0,1-.654-.283q-.356-.315-.71-.634l-.006-.006-.367-.329L5.1.987,5,.9l-.778.7L3.4,2.321a1.036,1.036,0,0,1-.686.31,1.027,1.027,0,0,1-.674-.3q-.28-.246-.558-.494l-.334-.3C1.074,1.474,1,1.407.9,1.326V17.752l.573-.507.007,0h0l.533-.472A1.085,1.085,0,0,1,2.717,16.439Z" transform="translate(0 0)" fill="#fff"/>
                                        <path id="Shape-2" data-name="Shape" d="M4.674,0Q6.751,0,8.827,0c.358,0,.563.218.508.528a.389.389,0,0,1-.306.334,1.248,1.248,0,0,1-.294.03q-4.06,0-8.12,0A1.261,1.261,0,0,1,.32.863.42.42,0,0,1,0,.455.428.428,0,0,1,.3.033,1.014,1.014,0,0,1,.577,0q2.049,0,4.1,0Z" transform="translate(2.603 11.77)" fill="#fff"/>
                                        <path id="Shape-3" data-name="Shape" d="M4.691,0H8.807c.32,0,.5.141.533.4a.421.421,0,0,1-.3.459.915.915,0,0,1-.256.033Q4.672.9.556.895A.514.514,0,0,1,.07.684.433.433,0,0,1,.3.034.961.961,0,0,1,.575,0Q2.633,0,4.691,0Z" transform="translate(2.605 9.089)" fill="#fff"/>
                                        <path id="Shape-4" data-name="Shape" d="M2.661.895c-.72,0-1.439,0-2.159,0A.445.445,0,0,1,.016.333.462.462,0,0,1,.515,0C1.011,0,1.507,0,2,0c.93,0,1.861,0,2.791,0,.38,0,.6.251.512.572A.455.455,0,0,1,4.82.894c-.72,0-1.439,0-2.159,0Z" transform="translate(2.606 6.408)" fill="#fff"/>
                                        </svg>

                                    </i>
                                    {{ __('frontstaticword.MyLessons') }}
                                </a>
                            </li>
                            <li class="therapists">
                        <a href="{{route('myTeachers.show',Auth::User()->id)}}">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.563" height="19.979" viewBox="0 0 13.563 19.979">
                                <g id="man" transform="translate(0.1 0.1)">
                                    <path id="Shape" d="M8.034,19.779H7.8a.551.551,0,0,1-.234-.455c-.1-.825-.2-1.662-.307-2.473L7.2,16.394c-.015-.119-.031-.238-.049-.374l0-.014c-.01-.078-.022-.162-.034-.254-.141.234-.284.348-.433.348s-.289-.1-.451-.313l-.1.833v.009c-.117.94-.228,1.828-.337,2.731a.523.523,0,0,1-.231.417H5.33a.437.437,0,0,1-.2-.477c.1-.749.189-1.488.285-2.27l.007-.057q.047-.381.095-.771l-.167.19c-.151.171-.293.333-.43.5a.383.383,0,0,1-.292.165.357.357,0,0,1-.094-.013.351.351,0,0,1-.25-.31c-.05-.242-.1-.487-.157-.723l-.036-.162c-.05-.224-.1-.448-.15-.671l-.1-.444-.2.01-.381.019A2.713,2.713,0,0,0,.7,17.18c-.045.539-.039,1.091-.034,1.625,0,.179,0,.357,0,.535a.417.417,0,0,1-.243.438H.23a.461.461,0,0,1-.23-.45c.006-.267.006-.538.005-.8,0-.472,0-.96.037-1.438a3.348,3.348,0,0,1,2.87-2.952c.163-.02.334-.032.539-.037A1.384,1.384,0,0,0,4.78,12.78a.253.253,0,0,0-.1-.191,4.425,4.425,0,0,1-2.4-3.715c0-.01,0-.015-.011-.015a.043.043,0,0,0-.023.011c-.065-.045-.132-.089-.2-.131a3.294,3.294,0,0,1-.451-.331,1.164,1.164,0,0,1-.354-.89c0-1.28-.006-2.644,0-4.015a1.435,1.435,0,0,1,1.073-1.4.383.383,0,0,0,.209-.163A3.573,3.573,0,0,1,5.279.032.243.243,0,0,0,5.337.012L5.369,0H8.922l.153.032c.116.024.236.049.353.078A3.585,3.585,0,0,1,12.16,3.534c.011.959.008,1.933.006,2.875q0,.523,0,1.045c0,.241-.128.39-.33.39s-.327-.143-.327-.391q0-.673,0-1.346c0-.819,0-1.666,0-2.5A2.922,2.922,0,0,0,9.3.76a3.129,3.129,0,0,0-.763-.1C7.952.656,7.441.652,6.971.652c-.424,0-.816,0-1.2.009A2.886,2.886,0,0,0,3.025,2.439a.439.439,0,0,1-.39.286.77.77,0,0,0-.736.815c0,1.089,0,2.2,0,3.267v.654a.678.678,0,0,0,.375.651V7.139q0-.79,0-1.579A.319.319,0,0,1,2.631,5.2h.036l.1,0A1.233,1.233,0,0,0,4.056,4.076c.014-.082.024-.157.03-.228.021-.209.141-.339.313-.339a.467.467,0,0,1,.242.077l.292.183c.285.179.579.365.878.526A10.3,10.3,0,0,0,9.222,5.408c.2.03.31.122.334.292a.291.291,0,0,1-.194.34.447.447,0,0,1-.156.024.838.838,0,0,1-.126-.01A11.292,11.292,0,0,1,4.8,4.481c-.024-.015-.048-.028-.077-.044l-.056-.031a2.134,2.134,0,0,1-.629,1.022,1.946,1.946,0,0,1-1.094.438l0,.029c0,.043-.007.08-.007.116q0,.429,0,.859c0,.614,0,1.244,0,1.864A3.749,3.749,0,0,0,6.349,12.4c.106.009.213.013.318.013a3.734,3.734,0,0,0,3.685-3.016,4.54,4.54,0,0,0,.075-.786c.005-.566,0-1.142,0-1.7q0-.425,0-.85V6.026a.7.7,0,0,1,.011-.16.329.329,0,0,1,.319-.261h.018a.33.33,0,0,1,.306.3.773.773,0,0,1,0,.1v.02q0,.4,0,.809c0,.595,0,1.21,0,1.818a4.395,4.395,0,0,1-4.426,4.418q-.09,0-.181,0a5.839,5.839,0,0,1-.683-.081c-.109-.017-.222-.035-.333-.05l-.052.16c-.058.176-.117.357-.174.542a.137.137,0,0,0,.04.1c.341.382.682.761,1.03,1.149l.366.407.2-.223.007-.008.361-.411a.344.344,0,0,1,.259-.133.375.375,0,0,1,.175.048.321.321,0,0,1,.137.4c-.02.063-.033.15,0,.185.174.212.355.419.547.638l0,.005.2.233c.029-.13.056-.257.083-.383.067-.312.13-.605.205-.9a.334.334,0,0,0-.142-.416,2.424,2.424,0,0,1-.467-.507.338.338,0,0,1-.069-.259.326.326,0,0,1,.143-.216.322.322,0,0,1,.179-.056.357.357,0,0,1,.29.17A1.411,1.411,0,0,0,10,14.1a3.389,3.389,0,0,1,3.352,3.314c.01.394.008.795.007,1.182,0,.261,0,.527,0,.788a.435.435,0,0,1-.229.392H12.9a.519.519,0,0,1-.2-.483c.01-.482.007-.973,0-1.447v-.29A2.8,2.8,0,0,0,9.75,14.737c-.076,0-.154,0-.231.007l-.119.535q-.161.727-.321,1.456c-.046.209-.136.307-.283.307A.536.536,0,0,1,8.46,16.9c-.149-.149-.288-.312-.435-.484-.058-.068-.117-.138-.18-.21l.077.621c.105.857.2,1.664.311,2.479a.441.441,0,0,1-.2.477Zm-3.2-5.551c-.37.124-.383.354-.289.661.075.244.125.494.179.759.025.121.049.244.077.37l.421-.485.388-.447-.683-.755-.012-.014Z" transform="translate(0 0)" fill="#585858" stroke="#585858" stroke-miterlimit="10" stroke-width="0.2"/>
                                </g>
                                </svg>

                            </i>{{ __('frontstaticword.MyTutors') }}
                        </a>
                            </li>
                            <li class="profile">
                                <a class="Profile" href="{{route('profile.show',Auth::User()->id)}}">
                                                            <i>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="17.925" height="20.968" viewBox="0 0 17.925 20.968">
                                <g id="accountsettng" transform="translate(0.099 0.1)">
                                    <path id="Shape" d="M17.424,9.858H11.7a.61.61,0,0,1-.281-.6c.011-.295.009-.587.007-.9V8.347c0-.124,0-.25,0-.379H.5c-.348-.006-.491-.15-.492-.5V7.279c0-.753-.007-1.532,0-2.3,0-.112,0-.225,0-.338A9.309,9.309,0,0,1,.068,3.36,4.015,4.015,0,0,1,3.9,0h.016a.617.617,0,0,1,.47.2A4.727,4.727,0,0,0,6.506,1.5a3.933,3.933,0,0,0,1.023.14,4.114,4.114,0,0,0,2.5-.918A6.4,6.4,0,0,0,10.621.2a.608.608,0,0,1,.451-.2h.035a3.977,3.977,0,0,1,3.159,1.713.324.324,0,0,0,.3.157h.043a2.157,2.157,0,0,1,2.119,2.111c.008.344.006.685,0,1.045,0,.174,0,.349,0,.526H17.1l.18,0a.4.4,0,0,1,.443.419c0,.843,0,1.7,0,2.522v.043q0,.451,0,.9a.474.474,0,0,1-.3.418Zm-5.15-3.466h0v2.62h4.608V6.392H12.273ZM3.681.852a.767.767,0,0,0-.122.011A3.211,3.211,0,0,0,.835,4.034q0,1.087,0,2.175v.725c0,.045,0,.09.006.136,0,.022,0,.042,0,.064H11.427q0-.175,0-.344c0-.266,0-.515,0-.769a.419.419,0,0,1,.464-.466h.539l0-.431c0-.306.006-.594-.005-.888a2.178,2.178,0,0,1,1.085-2.078.067.067,0,0,0,.016-.023l.014-.024A3.127,3.127,0,0,0,11.261.853H11.25a.37.37,0,0,0-.2.091c-.093.073-.184.15-.272.225-.135.115-.274.233-.42.336a4.863,4.863,0,0,1-2.829.964A4.722,4.722,0,0,1,6.726,2.4,5.2,5.2,0,0,1,4.032,1,.487.487,0,0,0,3.681.852ZM14.572,2.7a1.382,1.382,0,0,0-.257.024,1.325,1.325,0,0,0-1.056,1.31c-.008.362-.006.73,0,1.086l0,.291a.435.435,0,0,0,.012.088c0,.017.007.032.009.048h2.615v-.49c0-.319,0-.632,0-.944V4.092a1.859,1.859,0,0,0-.02-.3,1.414,1.414,0,0,0-.094-.308A1.318,1.318,0,0,0,14.572,2.7Z" transform="translate(0 10.91)" fill="#585858" stroke="#585858" stroke-miterlimit="10" stroke-width="0.2"/>
                                    <path id="Shape-2" data-name="Shape" d="M4.789,11.2a3.243,3.243,0,0,1-1.932-.68A6.337,6.337,0,0,1,.877,7.994,8.72,8.72,0,0,1,0,3.935,4.023,4.023,0,0,1,.827,1.462a3.8,3.8,0,0,1,2.3-1.3c.242-.051.492-.086.733-.12L4.181,0H5.439c.11.017.22.032.33.048.239.033.486.068.726.118a3.732,3.732,0,0,1,2.443,1.49,3.88,3.88,0,0,1,.665,2.1A8.473,8.473,0,0,1,7.561,9.795a3.883,3.883,0,0,1-2.087,1.323A3.082,3.082,0,0,1,4.789,11.2Zm-.87-7.508A4.94,4.94,0,0,1,.941,5.6c.042.139.081.277.12.414.091.317.176.617.285.914a6.458,6.458,0,0,0,1.72,2.685,2.693,2.693,0,0,0,1.463.729,2.3,2.3,0,0,0,.3.019,2.544,2.544,0,0,0,1.7-.725A6.413,6.413,0,0,0,8.281,6.905c.1-.278.182-.559.268-.856.039-.137.079-.275.122-.416-.214.016-.416.023-.6.023A4.857,4.857,0,0,1,3.919,3.688ZM3.93,2.459h.012c.238.007.34.177.423.35A3.28,3.28,0,0,0,5.485,4.094a4.294,4.294,0,0,0,2.521.726,7.365,7.365,0,0,0,.758-.041c0-.126,0-.25,0-.373,0-.267.01-.519-.008-.774A2.666,2.666,0,0,0,6.649,1.054,7.148,7.148,0,0,0,4.817.814a7.4,7.4,0,0,0-1.854.241C1.4,1.459.637,2.805.875,4.75l.044-.006A.577.577,0,0,0,.995,4.73,3.975,3.975,0,0,0,3.5,2.79C3.6,2.615,3.707,2.459,3.93,2.459Z" transform="translate(2.697 0)" fill="#585858" stroke="#585858" stroke-miterlimit="10" stroke-width="0.2"/>
                                </g>
                                </svg>

                                                            </i>{{ __('frontstaticword.UserProfile') }}</a>
                                                            </li>
                                                            <li class="Logout">
                                    <a href="#">
                                                            <i>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18.796" height="18.795" viewBox="0 0 18.796 18.795">
                                <g id="logout"  transform="translate(0 -0.008)">
                                    <path id="Path_39119" data-name="Path 39119" d="M285.359,209.183h-7.44a.587.587,0,1,1,0-1.175h7.44a.587.587,0,0,1,0,1.175Zm0,0" transform="translate(-267.152 -200.365)" fill="#585858"/>
                                    <path id="Path_39120" data-name="Path 39120" d="M400.591,135.019a.588.588,0,0,1-.415-1l2.522-2.522-2.522-2.522a.588.588,0,0,1,.831-.831l2.937,2.937a.587.587,0,0,1,0,.831l-2.937,2.937A.583.583,0,0,1,400.591,135.019Zm0,0" transform="translate(-385.32 -123.265)" fill="#585858"/>
                                    <path id="Path_39121" data-name="Path 39121" d="M6.265,18.8a1.614,1.614,0,0,1-.486-.073L1.066,17.16A1.581,1.581,0,0,1,0,15.671V1.574A1.568,1.568,0,0,1,1.566.008a1.615,1.615,0,0,1,.486.073l4.713,1.57A1.58,1.58,0,0,1,7.831,3.14v14.1A1.568,1.568,0,0,1,6.265,18.8Zm-4.7-17.62a.393.393,0,0,0-.392.392v14.1a.407.407,0,0,0,.272.377l4.691,1.563a.425.425,0,0,0,.128.017.393.393,0,0,0,.391-.392V3.14a.407.407,0,0,0-.272-.377L1.694,1.2a.425.425,0,0,0-.128-.017Zm0,0" transform="translate(0 0)" fill="#585858"/>
                                    <path id="Path_39122" data-name="Path 39122" d="M37.632,6.273a.588.588,0,0,1-.587-.587V2.162a.98.98,0,0,0-.979-.979h-8.81a.587.587,0,0,1,0-1.175h8.81a2.155,2.155,0,0,1,2.153,2.154V5.686A.588.588,0,0,1,37.632,6.273Zm0,0" transform="translate(-25.689)" fill="#585858"/>
                                    <path id="Path_39123" data-name="Path 39123" d="M185.052,283.605h-3.133a.587.587,0,0,1,0-1.175h3.133a.98.98,0,0,0,.979-.979v-3.524a.587.587,0,1,1,1.175,0v3.524A2.155,2.155,0,0,1,185.052,283.605Zm0,0" transform="translate(-174.676 -267.151)" fill="#585858"/>
                                </g>
                                </svg>

                            </i>
                            {{ __('frontstaticword.Logout') }}</a>
                            </li>
                        </ul>




                    </nav>
            </div>
            <div class="col-sm-6 less-item">
                <div class="wrapper-list">
                <div class="d-flex justify-content-between align-items-center">
  <h5 class="font-weight-bold txt-blue">{{ __('frontstaticword.MyLessons') }}</h5>
                <form action="/mylessons/{{auth()->id()}}" method="post">
                    @csrf
                    <div class="row" id="filterLessons">
                        <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i>
                            <select class="form-control" name="status_id" autocomplete="off" required>
                                <option value="all"> {{ __('frontend.all') }} </option>
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
                </div>

                @foreach($lessons as $lesson)
                <div class="item-les align-items-center">
                    <div class="sec-les ">
                        <div class="d-flex align-items-center">

                        <input value="{{$lesson->instructor_id}}" class="input-group tutor_id" id="tutor_id" hidden>
                        <input value="{{$lesson->id}}" class="input-group tutor_id" id="course_id" hidden>

                        <div class="img">
                            <img src="{{ url('/images/user_img/'.$lesson->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                        </div>
                        <div class="ml-3">
                           <div class="d-flex align-items-center name-status-less">
                               <h4 class="name">{{$lesson->fname}} {{$lesson->lname}}.</h4>
                                     @if($lesson->status == "Pending Payment")
                                <a class="dropdown-item " href="/course/appointment/{{$lesson->instructor_id}}/{{$lesson->date}}/{{$lesson->start_time}}"><i class="far fa-credit-card"></i>{{ __('frontend.pay_now') }}</a>
                                @endif
                                @if($lesson->status != "Confirmed" && $lesson->status != "Awaiting resolution" &&
                                $lesson->status != "Pending Payment")
                                <!-- <a class="dropdown-item txt-blue" href="/lesson/reschedule/{{$lesson->id}}"><i class="far fa-calendar-alt"></i> Reschedule</a> -->
                                <a class="dropdown-item txt-blue" href="#rescdule" data-toggle="modal"><i class="far fa-calendar-alt"></i> {{ __('frontend.reschedule') }}</a>

                                @endif
                                @if($lesson->status != "Confirmed" && $lesson->status != "Pending Payment")
                                <a class="dropdown-item confirmLesson" record_id="{{$lesson->id}}" tname="{{$lesson->fname}} {{$lesson->lname}}" timage="{{$lesson->user_img}}" href="#confirm-lesson" data-toggle="modal"><i class="fas fa-star"></i> {{ __('frontend.review') }}</a>
                                @endif
                                @if($lesson->status == "Waiting for confirmation" && $lesson->status != "Pending
                                Payment")
                                <a class="dropdown-item" href="#report-issue" data-toggle="modal"><i class="fas fa-exclamation-circle"></i> {{ __('frontend.report_issue') }}</a>
                                @endif
                                @if($lesson->status != "Confirmed")
                                <a class="dropdown-item cancelLesson" href="#cancel-lesson" record_id="{{$lesson->id}}" tutor_id="{{$lesson->instructor_id}}" data-toggle="modal"><i class="far fa-times-circle"></i> {{ __('frontend.cancel') }}</a>
                                @endif
                                  <!--  @if($lesson->status != "Cancelled")
                        @if($lesson->status != "Confirmed")
                        <div class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Actions<span>
                                   <!-- <svg xmlns="http://www.w3.org/2000/svg" width="9" height="5.751" viewBox="0 0 11.808 6.751">
                                        <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M12.094,15.963l4.465-4.468a.84.84,0,0,1,1.192,0,.851.851,0,0,1,0,1.2l-5.059,5.062a.842.842,0,0,1-1.164.025L6.434,12.693a.844.844,0,1,1,1.192-1.2Z" transform="translate(-6.188 -11.246)" fill="#fff"></path>
                                    </svg>--><!--</span></a>
                            <div class="dropdown-menu">
                                @if($lesson->status == "Pending Payment")
                                <a class="dropdown-item" href="/course/appointment/{{$lesson->instructor_id}}/{{$lesson->date}}/{{$lesson->start_time}}"><i class="far fa-credit-card"></i>Pay Now</a>
                                @endif
                                @if($lesson->status != "Confirmed" && $lesson->status != "Awaiting resolution" &&
                                $lesson->status != "Pending Payment")
                                <a class="dropdown-item" href="/lesson/reschedule/{{$lesson->id}}"><i class="far fa-calendar-alt"></i> Reschedule</a>
                                @endif
                                @if($lesson->status != "Confirmed" && $lesson->status != "Pending Payment")
                                <a class="dropdown-item confirmLesson" record_id="{{$lesson->id}}" tname="{{$lesson->fname}} {{$lesson->lname}}" timage="{{$lesson->user_img}}" href="#confirm-lesson" data-toggle="modal"><i class="fas fa-star"></i> Review</a>
                                @endif
                                @if($lesson->status == "Waiting for confirmation" && $lesson->status != "Pending
                                Payment")
                                <a class="dropdown-item" href="#report-issue" data-toggle="modal"><i class="fas fa-exclamation-circle"></i> Report Issue</a>
                                @endif
                                @if($lesson->status != "Confirmed")
                                <a class="dropdown-item cancelLesson" href="#cancel-lesson" record_id="{{$lesson->id}}" tutor_id="{{$lesson->instructor_id}}" data-toggle="modal"><i class="far fa-times-circle"></i> Cancel</a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endif-->
                           </div>
                            <div class="d-flex align-items-center">
                                <a class="view-profile" href="/tutor/page/{{$lesson->instructor_id}}">{{ __('frontend.view_profile') }}</a>
                                 <span class="text-date">1 {{ __('frontend.hour') }}</span>

                            </div>
                        </div>
                        </div>

                    </div>
                    <div class="sec-les">
                        <h4 class="title status">
                            @if($lesson->status == "Confirmed")
                           <span class="done"> {{ __('frontend.done') }} </span>
                            @elseif($lesson->status == "Scheduled")
                           <span class="sech"> {{ __('frontend.scheduled') }} </span>
                            @else
                          <span class="canceled">{{$lesson->status}}</span>
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
                            @elseif($lesson->review->value == 5)
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            <li class="fas fa-star active"> </li>
                            @endif
                            @endif
                        </ul>
                        @php
                        // find tutor
                        $tutor = \App\Instructor::find($lesson->instructor_id);

                        // get tutor time zone
                        $time_zone = \App\Time_zone::find($tutor->user->time_zone_id);


                        // get slot time format to conver it
                        $slot_time = date("Y-m-d H:i:s", strtotime("$lesson->date . $lesson->start_time "));

                        // convert from time zone to time zone saved in session
                        $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , $slot_time , $time_zone->time_zone_name )
                        ->setTimezone( session('currentTimeZoneName') );

                        $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('Y-m-d H:i');

                        @endphp
                        <span class="text-date">{{ $correct_time }}
                        </span>
                        {{-- @if($lesson->status == "Cancelled")--}}
                        {{-- <p class="textsacand"><i class="fas fa-info-circle"></i>  The session was cancelled because of </p>--}}
                        {{-- @endif--}}
                    </div>
                    <!-- <div class="sec-les">
                        <h4 class="title">Details</h4>
                        <span class="text-price">{{$lesson->PricePerHour}} $</span>
                    </div> -->


                </div>
                @endforeach
                </div>

            </div>
            <div class="col-sm-3 less-item">
                <div class="item-datals">
                    @if(isset($nextLesson))
                    @foreach($nextLesson as $next)
                    @if(isset($next->time_zone_id))
                    <div class="lesson-user">
                        <p class="text-les">{{ __('frontend.next_lesson') }} : <span>

                                @php
                                // get tutor time zone
                                $time_zone = \App\Time_zone::find($next->time_zone_id);
                                // get slot time format to conver it
                                if($time_zone != null ){
                                $slot_time = date(" H:i:s", strtotime("$next->start_time"));
                                // convert from time zone to time zone saved in session
                                $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time , $time_zone->time_zone_name)
                                ->setTimezone(session('currentTimeZoneName'));
                                $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');
                                }else{
                                $correct_time = '';
                                }

                                @endphp

                                {{ $next->date . ' ' . $correct_time }}
                                {{ __('frontend.with') }}</span></p>
                        <div class="img"><img src="{{ url('/images/user_img/'.$next->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}">
                            <p>{{$next->fname}} {{$next->lname}}. </p>
                        </div>

                    </div>
                    @endif
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content deleting">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>
                <div class="textpopup" style="min-height:auto">
                    <h5 class="font-weight-bold txt-blue text-center">{{ __('frontend.cancel_the_lesson') }}</h5>
                    <p class="text text-center c-grey">{{ __('frontend.cancel_the_lesson_text') }}</p>
                </div>
                <div class="fild bot-de bot-card  border-0 m-0">
                    @if(isset($lesson))
                    @if($lesson->status == "Pending Payment")
                    <button class="bottom cancelButton  btn-green w-50" record_id="{{base64_encode($lesson->id)}}" type="submit">{{ __('frontend.cancel') }}</button>
                    @else
                    <button class="bottom cancelButton btn-green w-50" record_id="{{base64_encode($lesson->id)}}" type="submit">{{ __('frontend.cancel') }}</button>
                    <!--<a class="bottom" id="reschduleBtn"
                        href="/lesson/reschedule/{{ base64_encode($lesson->id) }}">Reschedule</a>-->
                    <a class="bottom btn-outline-grey w-50" id="reschduleBtn" href="/lesson/reschedule/{{ $lesson->id }}">{{ __('frontend.reschedule') }}</a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rescdule" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="pop-det">
                <button class="close" type="button" data-dismiss="modal">
                    <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                    </svg>
                </button>


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
                @if(isset($lesson))
                <form action="{{route('course.report', $lesson->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p class="occurred">{{ __('frontend.select_issue') }}</p>
                    <div class="row">
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="We agreed to reschedule"><span class="label-text">{{ __('frontend.student_lesson_issue_1') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="We had technical problems"><span class="label-text">{{ __('frontend.student_lesson_issue_2') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="thrpiate's didn't meet my expectation"><span class="label-text">{{ __('frontend.student_lesson_issue_3') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="thrpiate was late"><span class="label-text">{{ __('frontend.student_lesson_issue_4') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="thrpiate was absent"><span class="label-text">{{ __('frontend.student_lesson_issue_5') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <label class="che-box">
                                <input type="checkbox" name="title[]" value="Other issue"><span class="label-text">{{ __('frontend.student_lesson_issue_6') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-12 fild">
                            <textarea class="form-control" name="detail" placeholder="Write Comment here…" autocomplete="off" autofocus="" required=""></textarea>
                            <label class="floating-label">{{ __('frontend.issue_comment') }} </label>
                        </div>
                    </div>
                    <div class="fild bot-de bot-card">
                        <button class="bottom" type="submit">{{ __('frontstaticword.Report') }}</button><a class="bottom" data-dismiss="modal">{{ __('frontend.cancel') }}</a>
                    </div>
                </form>
                @endif
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
            <div class="photo mt-2"> <img src="" id="timage" alt="" title=""></div>
            <div class="text-center mt-4" id="record_id">
                <h3 class="title txt-blue">{{ __('frontend.lesson_review') }}</h3>
                <p class="mt-2 txt-grey"> {{ __('frontend.lesson_review_text') }}</p>
            </div>
            <form action="#">
                <div class="rev-item lessonprve">
                    <ul class="stars">
                        <li class="star" title="" data-value="1"><i class="fas fa-star"></i></li>
                        <li class="star" title="" data-value="2"><i class="fas fa-star"></i></li>
                        <li class="star" title="" data-value="3"><i class="fas fa-star"></i></li>
                        <li class="star" title="" data-value="4"><i class="fas fa-star"></i></li>
                        <li class="star" title="" data-value="5"><i class="fas fa-star"></i></li>
                    </ul>
                </div>
                <div class="fild bot-de bot-card border-0 m-0">
                    <button class="bottom confirm btn-green w-50" type="submit" value="">{{ __('frontstaticword.send') }}</button>
                    <a class="bottom w-50" href="#" data-dismiss="modal">{{ __('frontend.cancel') }} </a>
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

            // $('.confirm').on('click', function() {
            //     // alert(record_id)
            //     $.ajax({
            //         url: "/api/confirmLesson",
            //         type: "POST",
            //         data: {
            //             record_id: record_id
            //         },
            //         dataType: "json",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(data) {
            //             location.reload();
            //         }
            //     })
            // })
        })
        $('.stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
			var stars = "{{ __('frontend.stars') }}";
			var lesson_rating_text_1 = "{{ __('frontend.lesson_rating_text_1') }}";
			var lesson_rating_text_2 = "{{ __('frontend.lesson_rating_text_2') }}";
            if (ratingValue > 1) {
                msg = lesson_rating_text_1 + ' ' + ratingValue + ' ' + stars;
            } else {
                msg = lesson_rating_text_2 + ' ' + ratingValue + ' ' + stars;
            }

            // alert(record_id);
            $('#starsValue').val(onStar);
            // var tutor_id = $("#tutor_id").val();
            // var course_id = $("#course_id").val();

            $('.confirm').on('click', function() {

                $.ajax({
                    url: "/reviewrating",
                    type: "POST",
                    data: {
                        onStar: onStar,
                        // tutor_id :tutor_id,
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
        });

        $('.cancelLesson').on('click', function() {
            record_id = $(this).attr('record_id');
            tutor_id = $(this).attr('tutor_id');

            $('.cancelButton').on('click', function() {
                $('.cancelButton').prop('disabled', true);
                $('#reschduleBtn').fadeOut(300);;

                $.ajax({
                    url: "/api/cancelLesson",
                    type: "POST",
                    data: {
                        record_id: record_id,
                        tutor_id: tutor_id,
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
