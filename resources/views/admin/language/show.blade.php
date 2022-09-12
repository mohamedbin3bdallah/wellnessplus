@extends('admin.layouts.master')
@section('title', __('adminstaticword.Language'))
@section('body')
@include('admin.message')


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">{{ __('adminstaticword.Language') }}</h1>
        </div>
    	 <div class="box-body">
          <!-- Nav tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-language" aria-hidden="true"></i> {{ __('adminstaticword.Language') }}</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('dashboard.word_translation', ['param1'=>'Front', 'param2'=>'Static']) }}</a></li>
              <li role="presentation"><a href="#admin" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('dashboard.word_translation', ['param1'=>'Admin', 'param2'=>'Static']) }}</a></li>
			  <li role="presentation"><a href="#backend" aria-controls="backend" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('dashboard.word_translation', ['param1'=>'Backend', 'param2'=>'']) }}</a></li>
			  <li role="presentation"><a href="#frontend" aria-controls="frontend" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('dashboard.word_translation', ['param1'=>'Frontend', 'param2'=>'']) }}</a></li>
			  <li role="presentation"><a href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('dashboard.word_translation', ['param1'=>'Dashboard', 'param2'=>'']) }}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="home">

              	@include('admin.language.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="profile">

              	@include('admin.language.frontstatic.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="admin">

                @include('admin.language.adminstatic.index')
              </div>
			  <div role="tabpanel" class="fade tab-pane" id="backend">

              	@include('admin.language.backend.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="frontend">

                @include('admin.language.frontend.index')
              </div>
			   <div role="tabpanel" class="fade tab-pane" id="dashboard">

                @include('admin.language.dashboard.index')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
