@extends('admin.layouts.master')
@section('title', __('adminstaticword.Career'))
@section('body')
 
<section class="content">
   @include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              		<h3 class="box-title">{{ __('adminstaticword.Career') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('CareersController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}

						<div class="row">
							<div class="col-md-12">
		                        <label  for="one_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input name="one_enable" class="tgl tgl-skewed" id="section_one1" type="checkbox" {{ $careers['one_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_one1"></label>
		                        </li>
		                        <br>
				                <div class="row" style="{{ $careers['one_enable']==1 ? '' : 'display:none' }}" id="section_one">
				                	<div class="col-md-6">
					                    <label for="one_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['one_heading'] }}" name="one_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}" />
					                </div>

									<div class="col-md-6">
					                    <label for="one_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="one_text" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}" >{{ $careers['one_text'] }}</textarea>
					                    <br>
				                  	</div>

				                  	<div class="col-md-6">
					                    <label for="one_btntxt">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>__('dashboard.button'), 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['one_btntxt'] }}" name="one_btntxt" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>__('dashboard.button'), 'param'=>__('dashboard.text'), 'nom'=>'']) }}" />
									</div>

									<div class="col-md-6">
					                    <label for="one_btntxt">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>__('dashboard.button'), 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['three_btntxt'] }}" name="three_btntxt" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>__('dashboard.button'), 'param'=>__('dashboard.link'), 'nom'=>'']) }}" />
									</div>

				                  	<div class="col-md-6">
					                    <label for="one_video">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="one_video" id="one_video">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['one_video']) }}" class="img-responsive"/>
				                  	</div>
				              	</div>
		                    </div>
		                </div>
		              	<br>
		              	<br>

						
						<div class="row">
							<div class="col-md-12">
		                        <label name="two_enable" for="two_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="section_two2" type="checkbox" {{ $careers['two_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_two2"></label>
		                        </li>
		                        <br>
		                        <div class="row" style="{{ $careers['two_enable']==1 ? '' : 'display:none' }}" id="section_two">
		                        </div>
		                    </div>
		                </div>
						<br>
						<br>


						<div class="row">
							<div class="col-md-12">
		                        <label  for="three_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input name="three_enable" class="tgl tgl-skewed" id="section_three3" type="checkbox" {{ $careers['three_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_three3"></label>
		                        </li>
		                        <br>
		                        <div class="row" style="{{ $careers['three_enable']==1 ? '' : 'display:none' }}" id="section_three">

		                        	<div class="col-md-6">
					                    <label for="three_bg_image">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.background_image'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="three_bg_image"  id="three_bg_image">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['three_bg_image']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-6">
					                    <label for="three_video">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="three_video"  id="three_video">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['three_video']) }}" class="img-responsive"/>
					                    <br>
					                    <br> 
				                  	</div>

									<div class="col-md-6">
					                    <label for="three_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['three_heading'] }}" name="three_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
					                </div>

				                  	
		                        </div>
				            </div>
		                </div>
						<br>
						<br>
								

						<div class="row">
							<div class="col-md-12">
		                        <label  for="four_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input name="four_enable" class="tgl tgl-skewed" id="section_four4" type="checkbox" {{ $careers['four_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_four4"></label>
		                        </li>
		                        <br>
		                        <div class="row" style="{{ $careers['four_enable']==1 ? '' : 'display:none' }}" id="section_four">

									<div class="col-md-4">
					                    <label for="four_img_one">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_one"  id="four_img_one">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_one']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_two">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_two"  id="four_img_two">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_two']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_three">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_three"  id="four_img_three">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_three']) }}" class="img-responsive"/>
					                    <br>
					                    <br>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_four">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_four"  id="four_img_four">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_four']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_five">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_five"  id="four_img_five">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_five']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_six">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_six"  id="four_img_six">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_six']) }}" class="img-responsive"/>
					                    <br>
					                    <br>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_seven">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.seven')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_seven"  id="four_img_seven">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_seven']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_eight">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.eight')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_eight"  id="four_img_eight">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_eight']) }}" class="img-responsive"/>
				                  	</div>

				                  	<div class="col-md-4">
					                    <label for="four_img_nine">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.nine')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="four_img_nine"  id="four_img_nine">
					                    <br>
					                    <img src="{{ url('/images/careers/'.$careers['four_img_nine']) }}" class="img-responsive"/>
					                    <br>
					                    <br>
				                  	</div>
		                        </div>
				            </div>
				        </div>
						<br>
						<br>

						
						<div class="row">
							<div class="col-md-12">
		                        <label  for="four_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input name="five_enable" class="tgl tgl-skewed" id="section_five5" type="checkbox" {{ $careers['five_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_five5"></label>
		                        </li>
		                        <br>
		                        <div class="row" style="{{ $careers['five_enable']==1 ? '' : 'display:none' }}" id="section_five">
									<div class="col-md-4">
					                    <label for="five_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_heading'] }}" name="five_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}" />
					                </div>

				                  	<div class="col-md-4">
					                    <label for="five_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_text'] }}" name="five_text" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}" />
									</div>

									<div class="col-md-4">
					                    <label for="five_icon">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.icon'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_icon'] }}" name="five_icon" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.icon'), 'nom'=>'']) }}" />
					                    <br>
									</div>

									<div class="col-md-6">
					                    <label for="five_textone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textone'] }}" name="five_textone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.one')]) }}"/>
					                    <br>
									
					                    <label for="five_texttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_texttwo'] }}" name="five_texttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.two')]) }}" />
					                    <br>
									
					                    <label for="five_textthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textthree'] }}" name="five_textthree" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.three')]) }}" />
					                    <br>
									
					                    <label for="five_textfour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textfour'] }}" name="five_textfour" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.four')]) }}" />
					                    <br>
									
					                    <label for="five_textfive">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textfive'] }}" name="five_textfive" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.five')]) }}" />
					                    <br>
									
					                    <label for="five_textsix">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textsix'] }}" name="five_textsix" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.six')]) }}" />
					                    <br>
									
					                    <label for="five_textseven">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.seven')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textseven'] }}" name="five_textseven" type="text" class="form-control" placeholder="Enter {{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.seven')]) }}" />
					                    <br>
									
					                    <label for="five_texteight">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.eight')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_texteight'] }}" name="five_texteight" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.eight')]) }}"/>
					                    <br>
									
					                    <label for="five_textnine">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.nine')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textnine'] }}" name="five_textnine" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.nine')]) }}" />
					                    <br>
									
					                    <label for="five_textten">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.ten')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['five_textten'] }}" name="five_textten" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.ten')]) }}" />
					                    <br>
									</div>

									<div class="col-md-6">
					                   	<label for="five_dtlone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlone" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.one')]) }}" >{{ $careers['five_dtlone'] }}</textarea>
					                    <br>
					                   
					                   	<label for="five_dtltwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtltwo" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.two')]) }}" >{{ $careers['five_dtltwo'] }}</textarea>
					                    <br>
					                    
					                
					                   	<label for="five_dtlthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlthree" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.three')]) }}" >{{ $careers['five_dtlthree'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtlfour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlfour" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.four')]) }}" >{{ $careers['five_dtlfour'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtlfive">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlfive" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.five')]) }}" >{{ $careers['five_dtlfive'] }}</textarea>
					                    <br>
					                   
					                   	<label for="five_dtlsix">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlsix" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.six')]) }}" >{{ $careers['five_dtlsix'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtlseven">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.seven')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlseven" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.seven')]) }}" >{{ $careers['five_dtlseven'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtleight">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.eight')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtleight" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.eight')]) }}" >{{ $careers['five_dtleight'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtlnine">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.nine')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlnine" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.nine')]) }}" >{{ $careers['five_dtlnine'] }}</textarea>
					                    <br>
					                    
					                   	<label for="five_dtlten">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.ten')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_dtlten" rows="1"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.ten')]) }}" >{{ $careers['five_dtlten'] }}</textarea>
					                    <br>
					                </div>
		                        </div>
				            </div>
				        </div>
						<br>
						<br>


						<div class="row">
							<div class="col-md-12">
		                        <label  for="four_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
		                        <li class="tg-list-item">
		                          <input name="six_enable" class="tgl tgl-skewed" id="section_six6" type="checkbox" {{ $careers['six_enable']==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="section_six6"></label>
		                        </li>
		                        <br>
		                        <div class="row" style="{{ $careers['six_enable']==1 ? '' : 'display:none' }}" id="section_six">
		                        	<div class="col-md-6">
					                    <label for="six_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_heading'] }}" name="six_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}" />
					                </div>

									<div class="col-md-6">
					                   	<label for="six_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}<sup class="redstar">*</sup></label>
					                    <textarea name="six_text" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}" >{{ $careers['six_text'] }}</textarea>
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_one">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_one'] }}" name="six_topic_one" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.one')]) }}" />
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_two">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_two'] }}" name="six_topic_two" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.two')]) }}" />
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_three">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_three'] }}" name="six_topic_three" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.three')]) }}" />
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_four">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_four'] }}" name="six_topic_four" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.four')]) }}" />
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_five">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_five'] }}" name="six_topic_five" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.five')]) }}" />
					                </div>

					                <div class="col-md-6">
					                    <label for="six_topic_six">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $careers['six_topic_six'] }}" name="six_topic_six" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.topic'), 'nom'=>__('dashboard.six')]) }}" />
					                    <br>
					                </div>
		                        </div>
				            </div>
				        </div>
						<br>
						<br>
		              	
						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
    </div>
</section>
@endsection



@section('script')
<script>
(function($) {
  "use strict";

  	$(document).ready(function(){

      $('#section_one1').change(function(){
        if($('#section_one1').is(':checked')){
        	$('#section_one').show('fast');
        }else{
        	$('#section_one').hide('fast');
        }

      });

      $('#section_two2').change(function(){
        if($('#section_two2').is(':checked')){
        	$('#section_two').show('fast');
        }else{
        	$('#section_two').hide('fast');
        }

      });

      $('#section_three3').change(function(){
        if($('#section_three3').is(':checked')){
        	$('#section_three').show('fast');
        }else{
        	$('#section_three').hide('fast');
        }

      });

      $('#section_four4').change(function(){
        if($('#section_four4').is(':checked')){
        	$('#section_four').show('fast');
        }else{
        	$('#section_four').hide('fast');
        }

      });

      $('#section_five5').change(function(){
        if($('#section_five5').is(':checked')){
        	$('#section_five').show('fast');
        }else{
        	$('#section_five').hide('fast');
        }

      });

      $('#section_six6').change(function(){
        if($('#section_six6').is(':checked')){
        	$('#section_six').show('fast');
        }else{
        	$('#section_six').hide('fast');
        }

      });
  	});
 })(jQuery);
</script>


@endsection







