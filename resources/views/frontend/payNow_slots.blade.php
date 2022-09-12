@extends('frontend.layouts.layout')
@section('title', __('frontend.pay_now'))

@section('pageContent')
<section class="findtutor payment-page">
    @include('admin.message')
    <div class="container">
        <div class="content-all">
            <div class="row">
                <div class="col-sm-6 contenuser findinner">
                    <div class="itemtutor d-flex mb-3">
                                 <div class="tu-photo sm">
                            <div class="img"><img src="{{ url('/images/user_img/'.$user->user->user_img) }}" alt="{{ __('frontend.website_name') }}" title="{{ __('frontend.website_name') }}"></div>
                        </div>
                        <div class="tu-content">
                            <div class="in-pay">
                                <div class="minhead">
                                    <h3 class="title">{{$user->user->fname}} {{$user->user->lname}}</h3>
                                    <div class="flag" title="{{$user->nicename}}">{{country($user->user->country->iso)->getEmoji()}}</div>
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
                                    <ul class="rating">
                                        <li class="fas fa-star active"></li>
                                        <li class="fas fa-star active"></li>
                                        <li class="fas fa-star active"></li>
                                        <li class="fas fa-star active"></li>
                                    </ul>
                                </div>
                                <h3 class="title siz-titl">{{$user->headline}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="itemtutor paybox">

                        <div class="childbox">
                            @if(isset($studentPackage))
                            <h3 class="title">{{ __('frontend.package').' '.__('frontend.details') }}</h3>
                            <div class="headtext">
                                <p class="textline">
                                    {{ $studentPackage->package->name }}
                                </p>
                                <small>
                                    {{ $user->user->fname }} {{ $user->user->lname }}
                                </small>
                            </div>
                            @else
                            @foreach($appointment_array as $appointment)
                            <h3 class="title txt-blue">{{ __('frontend.date_and_time') }}</h3>
                            <div class="headtext">
                                <p class="textline">


                                    @php
                                    // get tutor time zone
                                    $time_zone = \App\Time_zone::find($user->user->time_zone_id);

                                    // get slot time format to conver it
                                    $slot_time = date(" H:i:s", strtotime("$appointment->start_time"));

                                    // convert from time zone to time zone saved in session
                                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , $appointment->date. $slot_time , $time_zone->time_zone_name )
                                    ->setTimezone(session('currentTimeZoneName'));

                                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');



                                    @endphp
                                    {{ $appointment->date . ' ' .$correct_time }}
                                </p>
                                <small>
                                    {{ session('currentTimeZone') }}
                                </small>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="childbox serv-det">
                            <h3 class="title txt-blue">{{ __('frontend.service').' '.__('frontend.details') }}
                                <small>{{ __('frontend.price_per_hour') }}</small>
                            </h3>
                            @php
                            $discountAmount = 0;
                            $offer_price = 0;
                            $transaction_fees = 0;
                            $bank_fees = 0;
                            $appointment_ids = [];
                            $cart_ids = [];
                            foreach($cartRecord_array as $cartRecord)
                            {
                            $discountAmount = ($cartRecord->disamount != null) ? $discountAmount + $cartRecord->disamount: $discountAmount + 0;
                            $offer_price = $offer_price + $cartRecord->offer_price;
                            $transaction_fees = $transaction_fees + ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
                            $bank_fees = $bank_fees + ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
                            $appointment_ids[] = $cartRecord->appointment_id;
                            $cart_ids[] = $cartRecord->id;
                            }

                            $transaction_fees = number_format(($transaction_fees ) , 2, '.', '');
                            $bank_fees = number_format(($bank_fees ) , 2, '.', '');
							$currency_code = ($currency and trim($currency->currency) != '' and $currency->currency != NULL)? $currency->currency:__('frontend.current_currency');
                            @endphp

                            <ul class="listserv">
                                <li>
                                    <p>
                                        @if(isset($studentPackage))
                                        {{ $studentPackage->package->numOfHours }} {{ __('frontend.hours') }}
                                        @else
                                        {{count($cartRecord_array)}} {{ __('frontend.hours') }} {{ __('frontend.lesson') }}
                                        @endif
                                    </p>

                                    <span>{{$currency_code}} {{$offer_price}}</span>
                                </li>
                                <li>
                                    <p>{{ __('frontend.transaction_fee') }}<span class="fas fa-question tooltiptext"><small>{{ __('frontend.transaction_fee_text') }}</small> </span>
                                    </p>
                                    <span> {{$currency_code}} {{ $transaction_fees ? $transaction_fees : 00.00}}</span>
                                </li>
                                <li>
                                    <p>{{ __('frontend.lesson_cancellation') }} <span class="fas fa-question tooltiptext"><small>{{ __('frontend.lesson_cancellation_text') }}</small> </span>
                                    </p>
                                    <span class="green">{{ __('frontend.free') }}</span>
                                </li>
                                <li>
                                    <p>{{ __('frontend.discount') }}<span class="fas fa-question tooltiptext"><small>{{ __('frontend.discount_text') }}</small> </span>
                                    </p>
                                    <span>{{$currency_code}} {{ $discountAmount }}</span>
                                </li>
                                <li>
                                    <p>{{ __('frontend.subtotal') }}</p>
                                    <span>{{$currency_code}} {{ $offer_price - $discountAmount }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="childbox total-det">
                            <h3 class="price-tp">{{ __('frontend.total') }}
                                <span>{{$currency_code}} {{ ($offer_price - $discountAmount ) + $transaction_fees }}</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 contenuser mt-0">
                          <div class="itemtutor promoCode p-0">
                            <div class="head-block">
                                <h5 class="text-light"> {{ __('frontend.payment') }}</h5>

                            </div>
                            <div class="wrapper-promo p-3">

                        <div class="childbox border-0 mt-0"><i class="fas fa-check"> </i>
                            <div class="primary">
                                <h5 class="title">{{ __('frontend.payment_section') }}</h5>
                                <p class="text">{{ __('frontend.payment_section_text') }}</p>
                            </div>
                        </div>
                        {{--<div class="text-center"><a class="bottom" href="#booking-pay" data-toggle="modal">Pay--}}
                        {{--Now</a></div>--}}

                        {{--<!-- vapulus pay btn script -->--}}
                        {{--<script id="vapulusScript"--}}
                        {{--vapulusId="acaab6b3-bb82-4a39-90b8-b779669af32c"--}}
                        {{--amount="{{ $offer_price - $discountAmount }}"--}}
                        {{--onaccept="https://wellness.live/payment/vapulus/callback/{{ $cartRecord->id }}"--}}
                        {{--onfail="https://wellness.live/payment/vapulus/callback/failTransaction/{{ $cartRecord->id }}"--}}
                        {{--src="https://storage.googleapis.com/vapulus-website/script.js"></script>--}}
                        {{--<!-- /vapulus pay btn script -->--}}

                        {{-- Flatterwave payment gatway--}}

                        @php
                        $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                        array('metaname' => 'size', 'metavalue' => 'big'));
                        @endphp


                        @if($user_balance && $user_balance->balance > 0)
                        <form method="post" action="/slots-balance">
                            <div class="text-center">
                                @csrf
                                <input type="hidden" name="appointment" value="{{implode('_', $appointment_ids)}}">
                                <input type="hidden" name="tutor" value="{{$user_balance->tutor_id}}" />
                                <button class="bottom" type="submit">{{ __('frontend.go_with_balance') }} </button>
                            </div>
                        </form>
                        @endif

                        @if($offer_price - $discountAmount + $transaction_fees - $bank_fees == 0)
                        <form method="post" action="/slots-free">
                            <div class="text-center">
                                @csrf
                                <input type="hidden" name="ref" value="{{ implode('_', $cart_ids) }}" /> <!-- Ucomment and  Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
                                <button class="bottom" type="submit">{{ __('frontend.go_free') }} </button>
                            </div>
                        </form>
                        @else
                        <div class="text-center">
                            @if($offer_price - $discountAmount + $transaction_fees > 0)
                            @if($offer_price - $discountAmount < $offer_price) @else @if($setting->payment_getway == 1)
                                <form>
                                    <script src="https://checkout.flutterwave.com/v3.js"></script>
                                    <button class="bottom btn-green w-100 mb-3" type="button" id="payNow">{{ __('frontend.pay_now') }}</button>
                                </form>
                                @elseif($setting->payment_getway == 2)
                                <form method="post" action="/payment-slots/makePayment">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="type" value="frontend">
                                    <input type="hidden" name="page" value="/mylessons/{{ Auth::user()->id }}">
                                    <input type="hidden" name="ref" value="{{ base64_encode(Auth::user()->id) }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->fname.' '.Auth::user()->lname }}">
                                    <input type="hidden" name="tx_ref" value="{{ base64_encode(implode('_', $cart_ids).'-'.implode('_', $appointment_ids).'-'.Auth::user()->id.'-'.$tutor.'-'.$package.'-myfatoora') }}">
                                    <input type="hidden" name="amount" value="{{ $offer_price - $discountAmount + $transaction_fees - $bank_fees }}">
                                    <input type="submit" class="bottom" value="Pay Now">
                                </form>
                                @endif

                                {{-- <button class="bottom" type="submit" >Pay Now</button>--}}



                                @endif
                                @else
                                {{ __('frontstaticword.youcantusethiscoupon') }}
                                @endif
                        </div>
                        @endif
                        @if($offer_price - $discountAmount + $transaction_fees - $bank_fees != 0 )

                        @if(!$discountAmount)
                        @if(isset($studentPackage))
                        @else
                        <h3 class="title"> {{ __('frontend.promo_code') }}</h3>
                        <form action="{{ url("/apply/slots-coupon") }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="appointment" value="{{implode('_', $appointment_ids)}}">
                            <input type="hidden" name="tutor" value="{{ $tutor }}" />

                            <div class="row">
                                <div class="col-sm-12 fild">
                                    <input class="form-control" type="text" name="coupon" placeholder="{{ __('frontend.enter_promo_code') }}" autocomplete="off" required>
                                    <label class="floating-label">{{ __('frontend.promo_code') }}</label>
                                  <div class="text-right mt-3">
                                        <button class="btn btn-md btn-outline-blue w-50" type="submit" data-toggle="modal">{{ __('frontend.add') }}
                                        </button>
                                    </div>

                                </div>
                                {{-- <div class="col-sm-12 fild line-pass">--}}
                                {{-- <label class="che-box">--}}
                                {{-- <input type="checkbox" name="freeRefund"><span class="label-text">I want a free session or a refund if the tutor doesn’t meet my needs</span>--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                            </div>
                        </form>
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="booking-pay" role="dialog">
    <div class="modal-dialog popreview" style="margin-top: 100px;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal">
                <svg width="16" height="16" viewBox="0 0 12 12" f xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66271 6.00002L11.8625 0.800231C12.0455 0.617161 12.0455 0.320349 11.8625 0.137303C11.6794 -0.0457441 11.3826 -0.0457675 11.1995 0.137303L5.99975 5.33709L0.799987 0.137303C0.616917 -0.0457675 0.320105 -0.0457675 0.137058 0.137303C-0.0459882 0.320373 -0.0460117 0.617185 0.137058 0.800231L5.33682 6L0.137058 11.1998C-0.0460117 11.3829 -0.0460117 11.6797 0.137058 11.8627C0.228582 11.9542 0.348558 12 0.468535 12C0.588511 12 0.708464 11.9542 0.800011 11.8627L5.99975 6.66295L11.1995 11.8627C11.291 11.9542 11.411 12 11.531 12C11.651 12 11.7709 11.9542 11.8625 11.8627C12.0455 11.6796 12.0455 11.3828 11.8625 11.1998L6.66271 6.00002Z" fill="#000"></path>
                </svg>
            </button>
            <div class="photopay"><img src="/frontAssets/images/photopay.png" alt="" title=""></div>
            <div class="text-center mt-4">
                <h3 class="title">{{ __('frontend.thank_you') }}</h3>
                <p class="mt-2"> {{ __('frontend.booking_your_lesson_done_successfuly') }}</p>
                <div class="bot-ok">
                    <button class="bottom" id="hideModal" type="submit">{{ __('frontend.ok') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('footerAssets')
<script type="text/javascript">
    (function($) {
        $("#payNow").on("click", function() {
            makePayment();
        });


        function makePayment() {
            FlutterwaveCheckout({
                public_key: "{{ env('RAVE_PUBLIC_KEY') }}",
                tx_ref: "{{ base64_encode(implode('_', $cart_ids).'-'.implode('_', $appointment_ids).'-'.Auth::user()->id.'-'.$tutor.'-'.$package.'-flutterwave') }}",
                amount: "{{ $offer_price - $discountAmount + $transaction_fees - $bank_fees}}",
                currency: "USD",
                country: "US",
                payment_options: " ",
                redirect_url: "https://www.wellness.live/payment-slots/frontend",
                meta: {
                    consumer_id: "{{$user->id}}",
                    consumer_mac: "92a3-912ba-1192a",
                },
                customer: {
                    email: "{{Auth::user()->email}}",
                    phone_number: "{{Auth::user()->mobile}}",
                    name: "{{Auth::user()->fname}} {{Auth::user()->lname}}",
                },
                callback: function(data) {
                    console.log(data);
                    const {
                        amount,
                        currency,
                        customer,
                        status
                    } = data;
                    if (status === "successful") {
                        window.location.href = `https://www.wellness.live/payment-slots/frontend?status=${status}`;
                    }
                },
                onclose: function() {
                    // close modal
                },
                customizations: {
                    title: "{{ __('frontend.website_name') }}",
                    description: "{{ __('frontend.payment_for_items_in_cart') }}",
                    logo: "https://wellness.live/images/logo/logo.png",
                },
            });
        }
    })(jQuery);
</script>
@endsection
