@extends('admin.layouts.master')
@section('title', __('adminstaticword.WidgetSetting'))
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.WidgetSetting') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{action('WidgetController@update')}}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
		                
		              	<div class="row">
		                  <div class="col-md-4">
		                    <label for="heading">{{ __('adminstaticword.WidgetOne') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show['widget_one'] }}" autofocus name="widget_one" type="text" class="form-control" placeholder="{{ __('adminstaticword.WidgetOne') }}" required/>
		                  </div>

	                      <div class="col-md-4">
	                        <label for="heading">{{ __('adminstaticword.WidgetTwo') }}<sup class="redstar">*</sup></label>
	                        <input value="{{ $show['widget_two'] }}" autofocus name="widget_two" type="text" class="form-control" placeholder="{{ __('adminstaticword.WidgetTwo') }}" required/>
	                      </div>

	                      <div class="col-md-4">
	                        <label for="heading">{{ __('adminstaticword.WidgetThree') }}<sup class="redstar">*</sup></label>
	                        <input value="{{ $show['widget_three'] }}" autofocus name="widget_three" type="text" class="form-control" placeholder="{{ __('adminstaticword.WidgetThree') }}" required/>
	                      </div>
			            </div>
			            <br>
						
						<div class="box-footer">
			            	<button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
			        	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection
