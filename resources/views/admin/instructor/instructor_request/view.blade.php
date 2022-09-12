@extends('admin.layouts.master')
@section('title', __('adminstaticword.View').' '.__('adminstaticword.TutorsRequest'))
@section('body')
<section class="content">
  @include('admin.message')
{{--    {{dd($show)}}--}}
  <div class="row">
    <div class="col-md-12">
    	<div class="box box-primary">
           	<div class="box-header with-border">
          	<h3 class="box-title">{{ __('adminstaticword.TutorsRequest') }}</h3>
       		</div>
          	<div class="panel-body">
                @if($show->file == null && $show->video == null && $show->youtube_url == null)
                    <h2 style="color: #9e0505; margin-left: 40%">{{ __('dashboard.profile_not_ompleted') }} </h2>
                @endif
          		<div class="view-instructor">
                    <div class="instructor-detail">
                    	<ul>
                    		<li><img src="{{ asset('images/user_img/'.$show->image) }}" class="img-circle"/></li>
                    		<li>{{ __('adminstaticword.Name') }}: {{ $show->fname }} {{ $show->lname }}</li>
                    		<li>{{ __('adminstaticword.Role') }}: {{ $show->role }}</li>
                    		<li>{{ __('adminstaticword.Phone') }}: {{ $show->mobile }}</li>
                    		<li>{{ __('adminstaticword.Email') }}: {{ $show->email }}</li>
                            <li>{{ __('adminstaticword.Country') }}: {{ $show->country_name }}</li>
							<li>{{ __('frontstaticword.CountryOfResidence') }}: @if(isset($show->user->country_residence->name)) {{ $show->user->country_residence->name }} @endif</li>
{{--                            <li>{{ __('adminstaticword.DateofBirth') }}: {{ $show->dob }}</li>--}}
{{--                    		<li>{{ __('adminstaticword.Gender') }}: {{ $show->gender }}</li>--}}
                    		<li>{{ __('adminstaticword.Detail') }}: {!! $show->userDetail !!}</li>
                            <li>{{ __('adminstaticword.PricePerHour') }}: {{ $show->PricePerHour }} USD</li>
{{--                            <li>{{ __('adminstaticword.languageSpoken') }}: {{ $show->languageSpoken }}</li>--}}
                            <li>{{ __('adminstaticword.CreatedAt') }}: {{ $show->created_at }}</li>
                            <li>{{ __('adminstaticword.Resume') }}: <a href="{{ asset('files/instructor/'.$show->file) }}" download="{{$show->file}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download"></i></a></li>
                            <li>{{ __('adminstaticword.Video') }}

                                @if($show->youtube_url != null)
                                <div class="iframe">
                                    <iframe src="{{$show->youtube_url}}"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                @endif
                                @if($show->video != null)
                                <video class="player-course-chapter-list"  loop muted   src="{{ asset('files/instructor/'.$show->video) }}" controls>
                                </video>
                                @endif
                            </li>

                    	</ul>
                    </div>
          		</div>


	            <form action="{{url('requestinstructor/update/'.$page.'/'.$show->id)}}" method="POST" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                {{ method_field('PUT') }}

	                <input type="hidden" value="{{ $show->user_id }}" name="user_id" class="form-control">
					        <input type="hidden" value="{{ $show->role }}" name="role" class="form-control">
                  <input type="hidden" value="{{ $show->mobile }}" name="mobile" class="form-control">
                  <input type="hidden" value="{{ $show->detail }}" name="detail" class="form-control">
{{--                  <input type="hidden" value="{{ $show->gender }}" name="gender" class="form-control">--}}
{{--                  <input type="hidden" value="{{ $show->dob }}" name="dob" class="form-control">--}}
                  <input type="hidden" value="{{ $show->image }}" name="image" class="form-control">
                    <div class="col-md-4">
                        <label  for="married_status">{{ __('adminstaticword.Status') }}: </label>
                        <select class="form-control js-example-basic-single" id="cb333" name="status">
                            <option value="none" selected disabled hidden>
                                {{ __('adminstaticword.SelectanOption') }}
                            </option>
                            <option id="Pending" {{ $show->status == 0 ? 'selected' : ''}} value="0">{{ __('adminstaticword.Pending') }}</option>
                            <option id="Approved" {{ $show->status == 1 ? 'selected' : ''}} value="1">{{ __('adminstaticword.Approved') }}</option>
                            <option id="Rejected" {{ $show->status == 2 ? 'selected' : ''}} value="1">{{ __('adminstaticword.Rejected') }}</option>
                        </select>
                        <br>
                    </div>
					
					<div class="col-md-4">
                        <label  for="married_status">{{ __('adminstaticword.recommendation') }}: </label>
                        <select class="form-control js-example-basic-single" id="cb555" name="recommendation">
                            <option value="none" selected disabled hidden>
                                {{ __('adminstaticword.SelectanOption') }}
                            </option>
                            <option {{ $show->recommendation == 0 ? 'selected' : ''}} value="0">{{ __('adminstaticword.notrecommended') }}</option>
                            <option {{ $show->recommendation == 1 ? 'selected' : ''}} value="1">{{ __('adminstaticword.recommended') }}</option>
                        </select>
                        <br>
                    </div>
{{--	              	<div class="row">--}}
{{--	                  <div class="col-md-6">--}}

{{--	                    <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>--}}
{{--	                    <br>--}}
{{--	                    <li class="tg-list-item">--}}
{{--	                    <input class="tgl tgl-skewed" id="cb333" type="checkbox" {{ $show->status==1 ? 'checked' : '' }}>--}}
{{--	                    <label class="tgl-btn" data-tg-off="Pending" data-tg-on="Approved" for="cb333"></label>--}}
{{--	                    </li>--}}
{{--	                    <input type="hidden" name="status" value="{{ $show->status }}" id="c33">--}}
{{--		              </div>--}}

{{--	              	</div>--}}
	              	<br>
					<div class="col-md-4">
						<button value="" type="submit"  class="btn btn-lg col-md-12 btn-primary">{{ __('adminstaticword.Save') }}</button>
					</div>

	          	</form>
          	</div>
      	</div>
  	</div>
  </div>
</section>
@endsection
