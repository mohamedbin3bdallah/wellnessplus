@extends('admin.layouts.master')
@section('title', __('dashboard.about'))
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="content">
      	<div class="row">
	        <div class="col-md-12">
	        	<div class="box box-primary">
		           	<div class="box-header with-border">
	              		<h3 class="box-title">{{ __('dashboard.about') }}</h3>
	           		</div>
		          	<div class="panel-body">
		          		<form action="{{ action('AboutController@update') }}" method="POST" enctype="multipart/form-data">
			                {{ csrf_field() }}
			                {{ method_field('PUT') }}

							<div class="row">
								<div class="col-md-12">
			                        <label  for="one_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.header'), 'nom'=>'']) }}</label>
			                        <li class="tg-list-item">
			                          <input name="one_enable" class="tgl tgl-skewed" id="sec_one1" type="checkbox" {{ $data['one_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_one1"></label>
			                        </li>

			                        <br>

					                <div class="row" style="{{ $data['one_enable']==1 ? '' : 'display:none' }}" id="sec_one">
					                  <div class="col-md-6">
					                    <label for="one_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['one_heading'] }}" autofocus  name="one_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>

										<br>

					                    <label for="one_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['one_text']}}" autofocus  name="one_text" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}"/>
					                  </div>
					                  <div class="col-md-6">
										<label for="link_four">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['link_four']}}" autofocus  name="link_four" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>

					                    <br>

					                    <label for="one_image">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.one'), 'type'=>'', 'param'=>__('dashboard.background_image'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="one_image"  id="one_image">
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['one_image']) }}" class="img-responsive"/>
					                  </div>
					              	</div>
			                    </div>
			                </div>
			              	<br>
			              	<br>


							<div class="row">
								<div class="col-md-12">
			                        <label  for="two_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.profile'), 'nom'=>'']) }}</label>
			                        <li class="tg-list-item">
			                          <input name="two_enable" class="tgl tgl-skewed" id="sec_two2" type="checkbox" {{ $data['two_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_two2"></label>
			                        </li>

			                        <br>

					              	<div class="row" style="{{ $data['two_enable']==1 ? '' : 'display:none' }}" id="sec_two">

					              	  
					                  <div class="col-md-6">
					                    <label for="two_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['two_heading'] }}" autofocus  name="two_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="two_text" rows="3" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}">{{ $data['two_text'] }}</textarea>
					                    <br>
					                  </div>

					                  <div class="col-md-6">
					                    <label for="two_imageone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="two_imageone"  id="two_imageone">
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['two_imageone']) }}" class="img-responsive"/>
					                  </div>

									  <div class="col-md-6">
					                    <label for="two_imagetwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="two_imagetwo" id="two_imagetwo" >
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['two_imagetwo']) }}" class="img-responsive"/>
					                    <br>
					                    <br>
					                  </div>

					                  <div class="col-md-6">
					                    <label for="two_imagethree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="two_imagethree" id="two_imagethree" >
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['two_imagethree']) }}" class="img-responsive"/>
					                  </div>

					                  <div class="col-md-6">
					                    <label for="two_imagefour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="two_imagefour"  id="two_imagefour" >
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['two_imagefour']) }}" class="img-responsive"/>
					                    <br>
					                    <br>
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_txtone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['two_txtone'] }}" name="two_txtone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}"/>
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_txttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['two_txttwo'] }}" name="two_txttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}"/>
					                    <br>
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_txtthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['two_txtthree'] }}" name="two_txtthree" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}" />
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_txtfour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['two_txtfour'] }}" name="two_txtfour" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.instructor'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.four')]) }}"/>
					                    <br>
					                  </div>

					                  <div class="col-md-6">
					                   	<label for="two_imagetext">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="two_imagetext" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.one')]) }}">{{ $data['two_imagetext'] }}</textarea>
					                    <br>
					                  </div>
					                  <div class="col-md-6">
					                   	<label for="text_one">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="text_one" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.two')]) }}">{{ $data['text_one'] }}</textarea>
					                    <br>
					                  </div>
					                  <div class="col-md-6">
					                   	<label for="text_two">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="text_two" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.three')]) }}">{{ $data['text_two'] }}</textarea>
					                    <br>
					                  </div>
					                  <div class="col-md-6">
					                   	<label for="text_three">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="text_three" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.two'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.detail'), 'nom'=>__('dashboard.four')]) }}">{{ $data['text_three'] }}</textarea>
					                    <br>
					                  </div>

						            </div>
			                    </div>
			                </div>
							<br>
							<br>


							<div class="row">
								<div class="col-md-12">
			                        <label for="three_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
			                        <li class="tg-list-item">
			                          <input name="three_enable" class="tgl tgl-skewed" id="sec_three3" type="checkbox" {{ $data['three_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_three3"></label>
			                        </li>

			                        <br>

									<div class="row" style="{{ $data['three_enable']==1 ? '' : 'display:none' }}" id="sec_three">
						                <div class="col-md-6">
						                   	<label for="three_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_heading'] }}" autofocus name="three_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
						                </div>
						                <div class="col-md-6">
						                   	<label for="three_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <textarea name="three_text" rows="3" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}">{{ $data['three_text'] }}</textarea>
						                    <br>
						                </div>

						              	<div class="col-md-4">
						                   	<label for="three_countone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_countone'] }}" name="three_countone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.one')]) }}"/>
						                </div>

						              	<div class="col-md-4">
						                   	<label for="three_counttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_counttwo'] }}" name="three_counttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.two')]) }}"/>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_countthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_countthree'] }}" name="three_countthree" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.three')]) }}" />
						                    <br>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_countfour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_countfour'] }}" name="three_countfour" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.four')]) }}" />
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_countfive">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_countfive'] }}" name="three_countfive" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.five')]) }}" />
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_countsix">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_countsix'] }}" name="three_countsix" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.counter'), 'nom'=>__('dashboard.six')]) }}" />
						                    <br>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txtone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txtone'] }}" name="three_txtone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}"  />
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txttwo'] }}" name="three_txttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}" />
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txtthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txtthree'] }}" name="three_txtthree" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}"/>
						                    <br>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txtfour">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.four')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txtfour'] }}" name="three_txtfour" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.four')]) }}"/>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txtfive">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.five')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txtfive'] }}" name="three_txtfive" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.five')]) }}"/>
						              	</div>

						              	<div class="col-md-4">
						                   	<label for="three_txtsix">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.six')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['three_txtsix'] }}" name="three_txtsix" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.three'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.six')]) }}"/>
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
			                          <input name="four_enable" class="tgl tgl-skewed" id="sec_four4" type="checkbox" {{ $data['four_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_four4" ></label>
			                        </li>

			                        <br>

									<div class="row" style="{{ $data['four_enable']==1 ? '' : 'display:none' }}" id="sec_four">
						                <div class="col-md-6">
						                    <label for="four_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['four_heading'] }}" autofocus name="four_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
						                </div>

						                {{-- <div class="col-md-6">
						                   	<label for="four_btntext">Section Four Button Text:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['four_btntext'] }}" autofocus name="four_btntext" type="text" class="form-control" placeholder="Enter Heading"/>
						                    <br>
						                </div> --}}

						                <div class="col-md-12">
						                   	<label for="four_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <textarea name="four_text" rows="3"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}">{{ $data['four_text'] }}</textarea>
						                    <br>
						                </div>

						                <div class="col-md-4">
						                    <label for="four_imageone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
						                    <input type="file" name="four_imageone"  id="four_imageone" >
						                    <br>
						                    <img src="{{ url('/images/about/'.$data['four_imageone']) }}" class="img-responsive"/>
					                  	</div>

					                  	<div class="col-md-5">
						                    <label for="four_imagetwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
						                    <input type="file" name="four_imagetwo"  id="four_imagetwo" >
						                    <br>
						                    <img src="{{ url('/images/about/'.$data['four_imagetwo']) }}" class="img-responsive"/>
						                    <br>
						                    <br>
					                  	</div>

					                  	<div class="col-md-4">
						                    <label for="four_txtone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['four_txtone'] }}" name="four_txtone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}"/>
						                </div>

						                <div class="col-md-4">
						                    <label for="four_txttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['four_txttwo'] }}" name="four_txttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>__('dashboard.image'), 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}"/>
						                    <br>
						                </div>

						                <div class="col-md-4 display-none">
						                    <label for="four_icon">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.four'), 'type'=>'', 'param'=>__('dashboard.icon'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <input value="1"name="four_icon" type="text" class="form-control" placeholder="Enter Heading"/>
						                </div>
										

					              	</div>
					            </div>
					        </div>
							<br>
							<br>

							
							<div class="row">
								<div class="col-md-12">
			                        <label  for="five_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
			                        <li class="tg-list-item">
			                          <input name="five_enable" class="tgl tgl-skewed" id="sec_five5" type="checkbox" {{ $data['five_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_five5"></label>
			                        </li>

			                        <br>

									<div class="row" style="{{ $data['five_enable']==1 ? '' : 'display:none' }}" id="sec_five">
					                  <div class="col-md-6">
					                    <label for="five_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['five_heading'] }}" autofocus name="five_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
					                  </div>

					                 

					                  <div class="col-md-12">
					                   	<label for="five_text">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="five_text" rows="5" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>'']) }}">{{ $data['five_text'] }}</textarea>
					                    <br>
					                  </div>

					              	  <div class="col-md-4">
					                    <label for="five_imageone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="five_imageone"  id="five_imageone">
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['five_imageone']) }}" class="img-responsive"/>
					                  </div>
					                  <div class="col-md-4">
					                    <label for="five_imagetwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="five_imagetwo"  id="five_imagetwo">
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['five_imagetwo']) }}" class="img-responsive"/>
					                  </div>
					              	  <div class="col-md-4">
					                    <label for="five_imagethree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.five'), 'type'=>'', 'param'=>__('dashboard.image'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input type="file" name="five_imagethree"  id="five_imagethree">
					                    <br>
					                    <img src="{{ url('/images/about/'.$data['five_imagethree']) }}" class="img-responsive"/>
					                  </div>
					              	</div>
					            </div>
					        </div>
							<br>
							<br>


							<div class="row">
								<div class="col-md-12">
			                        <label  for="six_enable">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>'', 'nom'=>'']) }}</label>
			                        <li class="tg-list-item">
			                          <input name="six_enable" class="tgl tgl-skewed" id="sec_six6" type="checkbox" {{ $data['six_enable']==1 ? 'checked' : '' }}/>
			                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_six6"></label>
			                        </li>

			                        <br>

									<div class="row" style="{{ $data['six_enable']==1 ? '' : 'display:none' }}" id="sec_six">
					                  <div class="col-md-12">
					                    <label for="six_heading">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['six_heading'] }}" name="six_heading" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.heading'), 'nom'=>'']) }}"/>
					                    <br>
					                  </div>

					                  <div class="col-md-4">
					                    <label for="six_txtone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['six_txtone'] }}" name="six_txtone" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.one')]) }}"/>
					                  </div>

					                  <div class="col-md-4">
					                    <label for="six_txttwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['six_txttwo'] }}" name="six_txttwo" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.two')]) }}"/>
					                  </div>

					                  <div class="col-md-4">
					                    <label for="six_txtthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}:<sup class="redstar">*</sup></label>
					                    <input value="{{ $data['six_txtthree'] }}" name="six_txtthree" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.text'), 'nom'=>__('dashboard.three')]) }}"/>
					                    <br>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="six_deatilone">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="six_deatilone" rows="5"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}">{{ $data['six_deatilone'] }}</textarea>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="six_deatiltwo">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="six_deatiltwo" rows="5"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}">{{ $data['six_deatiltwo'] }}</textarea>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="six_deatilthree">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    <textarea name="six_deatilthree" rows="5"  class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.detail'), 'nom'=>'']) }}" >{{ $data['six_deatilthree'] }}</textarea>
					                    <br>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="link_one">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                     <input value="{{ $data['link_one'] }}" name="link_one" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="link_two">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                     <input value="{{ $data['link_two'] }}" name="link_two" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>
					                  </div>

					                  <div class="col-md-4">
					                   	<label for="link_three">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                     <input value="{{ $data['link_three'] }}" name="link_three" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>
					                    <br>
					                  </div>


					                   <div class="col-md-6">
					                  	 	<label for="four_btntext">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'Facebook', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
						                    <input value="{{ $data['four_btntext'] }}" autofocus name="four_btntext" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'Facebook', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>
					                  	 </div>
					                  	 <div class="col-md-6">
					                  	 	<label for="five_btntext">{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'Instagram', 'param'=>__('dashboard.link'), 'nom'=>'']) }}:<sup class="redstar">*</sup></label>
					                    	<input value="{{ $data['five_btntext'] }}" autofocus name="five_btntext" type="text" class="form-control" placeholder="{{ __('dashboard.section_num_type_param_nom', ['num'=>__('dashboard.six'), 'type'=>'Instagram', 'param'=>__('dashboard.link'), 'nom'=>'']) }}"/>
					                    	<br>
					                  	 </div>
					                  


					              	</div>
					              	<br>

					              	
					            </div>
					        </div>
							<br>
							<br>

							
			              	

			              	<button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('dashboard.save') }}</button>

			          	</form>
		          	</div>
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

  $(function(){

      $('#sec_one1').change(function(){
        if($('#sec_one1').is(':checked')){
        	$('#sec_one').show('fast');
        }else{
        	$('#sec_one').hide('fast');
        }

      });

      $('#sec_two2').change(function(){
        if($('#sec_two2').is(':checked')){
        	$('#sec_two').show('fast');
        }else{
        	$('#sec_two').hide('fast');
        }

      });

      $('#sec_three3').change(function(){
        if($('#sec_three3').is(':checked')){
        	$('#sec_three').show('fast');
        }else{
        	$('#sec_three').hide('fast');
        }

      });

      $('#sec_four4').change(function(){
        if($('#sec_four4').is(':checked')){
        	$('#sec_four').show('fast');
        }else{
        	$('#sec_four').hide('fast');
        }

      });

      $('#sec_five5').change(function(){
        if($('#sec_five5').is(':checked')){
        	$('#sec_five').show('fast');
        }else{
        	$('#sec_five').hide('fast');
        }

      });

      $('#sec_six6').change(function(){
        if($('#sec_six6').is(':checked')){
        	$('#sec_six').show('fast');
        }else{
        	$('#sec_six').hide('fast');
        }

      });

  });
})(jQuery);
</script>


@endsection






