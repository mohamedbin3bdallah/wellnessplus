@extends('admin.layouts.master')
@section('title', __('adminstaticword.Edit').' '.__('adminstaticword.Question').' '.__('adminstaticword.Report'))
@section('body')
 
<section class="content">
   @include('admin.message')
  	<div class="row">
	    <div class="col-xs-12">
	    	<div class="box box-primary">
	           	<div class="box-header with-border">
	          	<h3 class="box-title">{{ __('adminstaticword.Edit').' '.__('adminstaticword.Question').' '.__('adminstaticword.Report') }}</h3>
	       		</div>
	          	<div class="panel-body">
	          		<form action="{{url('user/question/report/'.$show->id)}}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
						
		                <div class="row">
		                  <div class="col-md-6">
		                    <label for="title">{{ __('adminstaticword.Title') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show->title }}" autofocus required name="title" type="text" class="form-control" placeholder="{{ __('adminstaticword.Title') }}"/>
		                  </div>
		                  <div class="col-md-6">
		                    <label for="email">{{ __('adminstaticword.Email') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show->email }}" autofocus required name="email" type="email" class="form-control" placeholder="{{ __('adminstaticword.Email') }}"/>
		                  </div>
		              	</div>
		              	<br>

		              	<div class="row">
		                  <div class="col-md-12">
		                    <label for="detail">{{ __('adminstaticword.Detail') }}<sup class="redstar">*</sup></label>
		                    <textarea name="detail" value="" rows="4"  class="form-control" placeholder="{{ __('adminstaticword.Detail') }}">{{ $show->detail }}</textarea>
		                  </div>
		              	</div>
		              	<br>
						<div class="box-footer">
			              	<button value="" type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
			             </div>
		          	</form>
	          	</div>
	      	</div>
	  	</div>
	</div>
</section>
@endsection

