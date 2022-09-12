@extends('frontend.layouts.layout')
@section('title', $page->title)

@section('pageContent')
    @include('admin.message')
    <!-- main wrapper -->
    <section id="blog-home" class="blog-home-main-block">
        <div class="container">
            <h1 class="blog-home-heading text-white">@if(isset($page->title)){{ $page->title }} @endif</h1>
        </div>
    </section>
    <section id="policy-block" class="privacy-policy-block">
        <div class="container">
            <div class="panel-setting-main-block">
                <div class="panel-setting">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="info">@if(isset($page->details)){!! $page->details !!} @endif</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main wrapper -->
@endsection
