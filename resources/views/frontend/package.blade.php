{{--{{substr(\Illuminate\Support\Carbon::today()->addDay(6),0, 10)}}--}}
@extends('frontend.layouts.layout')
@section('title', \Lang::get('Package page'))

@section('pageContent')

<section class="findtutor">
    @include('admin.message')

    <div class="container">
        <div class="content-all package-content">
            <div class="row">
                <div class="col-sm-7 contenuser findinner" id="content">
                    <div class="itemtutor package-details">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="sidetitle p-0 "> Package Details</h3>
                            <div class="session-price">
                                <h3>$ 500/<span>Session</span></h3>
                            </div>
                        </div>

                        <h6 class="sessionum mb-4">Arabic for beginners <span> (12 sessions)</span></h6>

                        <div class="headtext">
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                                eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                                takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet</p>
                        </div>
                        <div class="my-3">
                            <a href="#" class="bottom book-trial bookingBottom">Book Now</a>
                        </div>

                    </div>

                    <div class="itemtutor">
                        <h3 class="sidetitle px-0"> thrpiate details</h3>
                        <div class="flex-box">
                            <div class="tu-photo">
                                <div class="img">

                                    <!--a(href="#" class="fas fa-heart")-->

                                    <img src="/frontAssets/images/bg4-photo.jpg" alt="Arabia" title="Arabia">
                                    <div class="feature">Featured</div>
                                    <a href="#" class="ico-status">
                                        <i></i>

                                    </a>
                                </div>
                                <div class="price">15.00</div>
                                <div class="price-to">USD/H</div>
                            </div>
                            <div class="tu-content position-relative">
                                <div class="minhead">
                                    <h3 class="title" style="color: #af8b62 !important;">Ibrahim saleh.</h3>
                                    <div class="flag" title="EGYPT">🇪🇬</div>
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
                                <h3 class="title siz-titl">Arabic teacher.</h3>

                                <div class="minhead towhead">
                                    <div class="speaks">
                                        <p>speaks :</p><span>Arabic</span><strong>A1</strong>
                                    </div>
                                </div>
                                <div id="makeFav">
                                    <a class="md-heart" href="#"><img src="/frontAssets/images/md-heart.png" alt="Arabia" title="Arabia"></a>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="Arabia" title="Arabia">
                                            <input value="60" class="input-group tutor_id" id="tutor_id" hidden="">

                                            <div class="con-item">
                                                <h4 class="title">Active clients</h4><span>0 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="Arabia" title="Arabia">
                                            <div class="con-item">
                                                <h4 class="title">sessions</h4><span>0 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 itemactiv">
                                        <div class="mactiv"><img src="/frontAssets/images/review.png" alt="Arabia" title="Arabia">
                                            <div class="con-item">
                                                <h4 class="title">Reviews</h4><span>0 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="childbox">
                            <h3 class="title">About Me</h3>
                            <div class="headtext ">
                                <p class="textline">ليسانس الآداب قسم اللغة الع</p>
                                <div class="onclick"><span class="more" style="display: block;">+ Read more</span><span class="cancel" style="display: none;">X hide</span></div>
                                <p class="divhidslid" style="display: none;">ربية - كلية الآداب - جامعة الإسكندرية
                                    دبلوم المعهد العالي للدراسات الإسلامية بالقاهرة
                                    الدبلوم العام في التربية - كلية التربية - جامعة الإسكندرية
                                    حاصل على درجة الماجستير في البلاغة والنقد والأدب العربي
                                    باحث دكتوراه في البلاغة والنقد والأدب العربي - كلية الآداب - جامعة قناة </p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-5 contenuser sidbar">

                    <div class="itemtutor bord-colo">
                        <h3 class="title"> Schedule</h3>

                        <div class="responsive">
                            <div>
                                <div class="between w-100">
                                    <p class="day-ma">September 14, 2020 - September 21, 2020</p>
                                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                        local timezone</p>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice
                                        between the schedule and your first session</p>
                                </div>
                                <div>
                                    <div class="fild position-relative"> <i class="fas fa-chevron-down iconsel"></i>
                                        <select class="form-control required" name="zone" autocomplete="off" required="required">
                                            <option> </option>
                                            <option>11:40 (GMT+3) - Africa, Asmara</option>
                                            <option>zone</option>
                                            <option>zone</option>
                                        </select>
                                        <label class="floating-label">Time zone </label>
                                    </div>
                                </div>

                                <div class="num-book">
                                    <div class="row">
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat active">Sat</p>
                                                <div class="numb active"> 10</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Sun</p>
                                                <div class="numb"> 11</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Mon</p>
                                                <div class="numb"> 12</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Tue</p>
                                                <div class="numb"> 13</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Wed</p>
                                                <div class="numb"> 14</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Thu</p>
                                                <div class="numb"> 15</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Fri</p>
                                                <div class="numb"> 16</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a></nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="between">
                                    <p class="day-ma">September 14, 2020 - September 21, 2020</p>
                                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                        local timezone</p>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice
                                        between the schedule and your first session</p>
                                </div>
                                <div class="num-book">
                                    <div class="row">
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat active">Sat</p>
                                                <div class="numb active"> 10</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Sun</p>
                                                <div class="numb"> 11</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Mon</p>
                                                <div class="numb"> 12</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Tue</p>
                                                <div class="numb"> 13</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Wed</p>
                                                <div class="numb"> 14</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Thu</p>
                                                <div class="numb"> 15</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Fri</p>
                                                <div class="numb"> 16</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a></nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="between">
                                    <p class="day-ma">September 14, 2020 - September 21, 2020</p>
                                    <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your
                                        local timezone</p>
                                    <p class="textsacand"><i class="fas fa-info-circle"></i> At least 2 days notice
                                        between the schedule and your first session</p>
                                </div>
                                <div class="num-book">
                                    <div class="row">
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat active">Sat</p>
                                                <div class="numb active"> 10</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Sun</p>
                                                <div class="numb"> 11</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a><a class="active" href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Mon</p>
                                                <div class="numb"> 12</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Tue</p>
                                                <div class="numb"> 13</div>
                                                <nav class="listnum"> <a class="active" href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Wed</p>
                                                <div class="numb"> 14</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum">
                                                <p class="sat">Thu</p>
                                                <div class="numb"> 15</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a><a href="#">03:00</a></nav>
                                            </div>
                                        </div>
                                        <div class="col innerbook">
                                            <div class="innernum active">
                                                <p class="sat">Fri</p>
                                                <div class="numb"> 16</div>
                                                <nav class="listnum"> <a class="active" href="#"> 03:00</a><a href="#">03:00</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a><a href="#">Booked</a></nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bot-show"><a class="bottom view-sce"> <span class="viw-show">View Full Scedule <i class="fas fa-angle-down"></i></span></a></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<section class="packages no-bg">
    <div class="container">
        <h3 class="sidetitle"><span>Other Packages</span></h3>
        <div class="row">
            <div class="col-sm-4 item">
                <div class="inner-bg">
                    <div class="photo"><img src="/frontAssets/images/bg4-photo.jpg" alt="Arabia" title="Arabia">
                        <div class="feature">Featured</div>
                        <a href="#" class="ico-status">
                            <i></i>

                        </a>
                        <a href="#" class="ico-fav">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25.7" height="24.665" viewBox="0 0 25.7 24.665">
                                <defs>
                                    <filter id="Icon_ionic-md-heart" x="0" y="0" width="25.7" height="24.665" filterUnits="userSpaceOnUse">
                                        <feOffset dy="1" input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="1.5" result="blur" />
                                        <feFlood flood-opacity="0.161" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_ionic-md-heart)">
                                    <path id="Icon_ionic-md-heart-2" data-name="Icon ionic-md-heart" d="M11.225,18.992l-1.138-1.027c-4.043-3.712-6.711-6.121-6.711-9.121A4.269,4.269,0,0,1,7.692,4.5a4.644,4.644,0,0,1,3.532,1.659A4.644,4.644,0,0,1,14.757,4.5a4.269,4.269,0,0,1,4.317,4.344c0,3-2.669,5.41-6.711,9.121Z" transform="translate(1.63 -0.5)" fill="#d9dfe8" stroke="#fff" stroke-width="1" />
                                </g>
                            </svg>

                        </a>
                    </div>
                    <div class="session-price">
                        <h3>$ 500/<span>Session</span></h3>
                    </div>
                    <h4 class="name">Arabic for beginners </h4>
                    <div class="name-inst"> with mr/ Ahmed Mahmoud </div>

                    <p class="text"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam</p>
                    <a href="#" class="btn-more"> More Details</a>
                </div>


            </div>
            <div class="col-sm-4 item">
                <div class="inner-bg">
                    <div class="photo"><img src="/frontAssets/images/bg4-photo.jpg" alt="Arabia" title="Arabia">
                        <div class="feature">Featured</div>
                        <a href="#" class="ico-status">
                            <i></i>

                        </a>
                        <a href="#" class="ico-fav">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25.7" height="24.665" viewBox="0 0 25.7 24.665">
                                <defs>
                                    <filter id="Icon_ionic-md-heart" x="0" y="0" width="25.7" height="24.665" filterUnits="userSpaceOnUse">
                                        <feOffset dy="1" input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="1.5" result="blur" />
                                        <feFlood flood-opacity="0.161" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_ionic-md-heart)">
                                    <path id="Icon_ionic-md-heart-2" data-name="Icon ionic-md-heart" d="M11.225,18.992l-1.138-1.027c-4.043-3.712-6.711-6.121-6.711-9.121A4.269,4.269,0,0,1,7.692,4.5a4.644,4.644,0,0,1,3.532,1.659A4.644,4.644,0,0,1,14.757,4.5a4.269,4.269,0,0,1,4.317,4.344c0,3-2.669,5.41-6.711,9.121Z" transform="translate(1.63 -0.5)" fill="#d9dfe8" stroke="#fff" stroke-width="1" />
                                </g>
                            </svg>

                        </a>
                    </div>
                    <div class="session-price">
                        <h3>$ 500/<span>Session</span></h3>
                    </div>
                    <h4 class="name">Arabic for beginners </h4>
                    <div class="name-inst"> with mr/ Ahmed Mahmoud </div>

                    <p class="text"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam</p>
                    <a href="#" class="btn-more"> More Details</a>
                </div>


            </div>
            <div class="col-sm-4 item">
                <div class="inner-bg">
                    <div class="photo"><img src="/frontAssets/images/bg4-photo.jpg" alt="Arabia" title="Arabia">
                        <div class="feature">Featured</div>
                        <a href="#" class="ico-status">
                            <i></i>

                        </a>
                        <a href="#" class="ico-fav">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25.7" height="24.665" viewBox="0 0 25.7 24.665">
                                <defs>
                                    <filter id="Icon_ionic-md-heart" x="0" y="0" width="25.7" height="24.665" filterUnits="userSpaceOnUse">
                                        <feOffset dy="1" input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="1.5" result="blur" />
                                        <feFlood flood-opacity="0.161" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_ionic-md-heart)">
                                    <path id="Icon_ionic-md-heart-2" data-name="Icon ionic-md-heart" d="M11.225,18.992l-1.138-1.027c-4.043-3.712-6.711-6.121-6.711-9.121A4.269,4.269,0,0,1,7.692,4.5a4.644,4.644,0,0,1,3.532,1.659A4.644,4.644,0,0,1,14.757,4.5a4.269,4.269,0,0,1,4.317,4.344c0,3-2.669,5.41-6.711,9.121Z" transform="translate(1.63 -0.5)" fill="#d9dfe8" stroke="#fff" stroke-width="1" />
                                </g>
                            </svg>

                        </a>
                    </div>
                    <div class="session-price">
                        <h3>$ 500/<span>Session</span></h3>
                    </div>
                    <h4 class="name">Arabic for beginners </h4>
                    <div class="name-inst"> with mr/ Ahmed Mahmoud </div>

                    <p class="text"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam</p>
                    <a href="#" class="btn-more"> More Details</a>
                </div>


            </div>
        </div>
    </div>
</section>

@endsection
@section('footerAssets')


@endsection
