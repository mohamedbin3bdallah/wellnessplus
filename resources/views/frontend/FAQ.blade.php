@extends('frontend.layouts.layout')
@section('title', __('frontend.faq_title'))

@section('pageContent')

<section class="answer">
    <div class="container">
        <h3 class="title">{{ __('frontend.faq_1') }}</h3>
        {{--<p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do  eiusmod tempor incididunt ut labore et.</p>--}}
        <div class="accordion questions" id="accordionExample">

            @php $i=1; @endphp
            @foreach($faqs as $faq)
            {{--@php dd($faq->details) @endphp--}}
            <div class="option">
                <div class="click-title" id="heading_{{$i}}"><a class="d-block position-relative collapsible-link" href="#" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="false" aria-controls="collapse_{{$i}}">{!! $faq->title !!}</a></div>
                <div class="collapse" id="collapse_{{$i}}" aria-labelledby="heading_{{$i}}" data-parent="#accordionExample">
                    <p class="all-text">{!! $faq->details !!} </p>
                </div>
            </div>

            @php $i++; @endphp

            @endforeach
        </div>
    </div>
</section>
@endsection
