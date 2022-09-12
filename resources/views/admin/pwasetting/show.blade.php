@extends('admin.layouts.master')
@section('title', __('dashboard.pwa').' '.__('dashboard.settings'))
@section('body')
@include('admin.message')


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">{{ __('dashboard.pwa').' '.__('dashboard.settings') }}</h1>
        </div>
    	 <div class="box-body">
          <!-- Nav tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-language" aria-hidden="true"></i> {{ __('adminstaticword.Update').' '.__('dashboard.manifest') }}</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('adminstaticword.Update').' '.__('dashboard.sw').' '.__('dashboard.js') }}</a></li>
              <li role="presentation"><a href="#admin" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-laptop" aria-hidden="true"></i> {{ __('adminstaticword.Update').' '.__('dashboard.pwa').' '.__('dashboard.icons') }}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="home">
              	<br>
              	@include('admin.pwasetting.manifest')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="profile">
              	<br>
              	@include('admin.pwasetting.sw')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="admin">
                <br>
                @include('admin.pwasetting.icon')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
