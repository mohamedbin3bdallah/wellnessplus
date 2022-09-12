@extends('admin.layouts.master')
@section('title', __('adminstaticword.Edit').' '.__('adminstaticword.User'))
@section('body')

@section('stylesheets')
  <link rel="stylesheet" href="{{ url('admin/css/user.css') }}" />
@endsection

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Users') }}</h3>


        </div>
        <br>
        <div class="panel-body">
          <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="fname">
                  {{ __('adminstaticword.FirstName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->fname }}" autofocus required name="fname" type="text" class="form-control" placeholder="{{ __('adminstaticword.FirstName') }}"/>
              </div>

              <div class="col-md-6">
                <label for="lname">
                  {{ __('adminstaticword.LastName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->lname }}" required name="lname" type="text" class="form-control" placeholder="{{ __('adminstaticword.LastName') }}"/>
              </div>
            </div>
            <br>

            <div class="row">

              <div class="col-md-6">
                <label for="mobile"> {{ __('adminstaticword.Mobile') }}:<sup class="redstar">*</sup></label>
                <input value="{{ $user->mobile }}" required type="text" name="mobile" placeholder="{{ __('adminstaticword.Mobile') }}" class="form-control">
               </div>
               <div class="col-md-6">
                <label for="mobile">{{ __('adminstaticword.Email') }}:<sup class="redstar">*</sup> </label>
                <input value="{{ $user->email }}" required type="email" name="email" placeholder="{{ __('adminstaticword.Email') }}" class="form-control">
              </div>
            </div>

            <div class="row">

              <div class="col-md-6">
                <label for="replacement"> {{ __('adminstaticword.replacement') }}:<sup class="redstar"></sup></label>
                <input value="{{ ($user->turor_order != 100000) ? $user->turor_order : "" }}" type="number" name="turor_order" placeholder="{{ __('adminstaticword.replacement') }}" class="form-control">
               </div>
            </div>

            <br>

            <div class="row">
              <div class="col-md-6">
                  <label for="address">{{ __('adminstaticword.YoutubeUrl') }}:<sup class="redstar"></sup> </label>
                  <input value="{{ $user->youtube_url }}" type="url" name="youtube_url" class="form-control" >
              </div>

                <div class="col-md-6">
                    @if($user->role == 'instructor')
						<label>{{ __('adminstaticword.Video') }}:<sup class="redstar"></sup></label>
						<input class="custom-file-input" type="file" id="uploadVideo" accept="video/mp4,video/x-m4v,video/*" name="uploadVideo">
						<label class="custom-file-label " for="uploadVideo" style="color: red" id="uploadVideoLabel"> </label>
					@endif
                </div>
{{--              <div class="col-md-6">--}}
{{--                <label for="dob">{{ __('adminstaticword.DateofBirth') }}: </label>--}}
{{--                <div class="input-group date">--}}
{{--                  <div class="input-group-addon">--}}
{{--                    <i class="fa fa-calendar"></i>--}}
{{--                  </div>--}}
{{--                  --}}{{-- <input type="date" value="{{ $user->dob }}" name="dob" required class="form-control pull-right" id="datepicker" placeholder="{{ __('adminstaticword.DateofBirth') }}"> --}}
{{--                  <input type="date" id="date" name="dob" class="form-control" placeholder="" value="{{ $user->dob }}" >--}}
{{--                </div>--}}
{{--              </div>--}}
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
               <label for="gender">{{ __('adminstaticword.Gender') }}:</label>
                <br>
                <input type="radio" name="gender" id="ch1" value="m" {{ $user->gender == 'm' ? 'checked' : '' }}> {{ __('adminstaticword.Male') }}
                <input type="radio" name="gender" id="ch2" value="f" {{ $user->gender == 'f' ? 'checked' : '' }}> {{ __('adminstaticword.Female') }}
                <input type="radio" name="gender" id="ch3" value="o" {{ $user->gender == 'o' ? 'checked' : '' }}> {{ __('adminstaticword.Other') }}
              </div>

{{--              <div class="col-md-6" hidden>--}}
{{--                <label for="role">{{ __('adminstaticword.SelectRole') }}:</label>--}}
{{--                  @if(Auth::User()->role=="admin")--}}
{{--                  <select class="form-control js-example-basic-single" name="role">--}}
{{--                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('dashboard.student') }}</option>--}}
{{--                    <option {{ $user->role == 'admin' ? 'selected' : ''}} value="admin">{{ __('adminstaticword.Admin') }}</option>--}}
{{--                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>--}}
{{--                  </select>--}}
{{--                  @endif--}}
{{--                  @if(Auth::User()->role=="instructor")--}}
{{--                  <select class="form-control js-example-basic-single" name="role">--}}
{{--                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('dashboard.student') }}</option>--}}
{{--                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>--}}
{{--                  </select>--}}
{{--                  @endif--}}
{{--                  @if(Auth::User()->role=="user")--}}
{{--                  <select class="form-control js-example-basic-single" name="role">--}}
{{--                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('dashboard.student') }}</option>--}}
{{--                  </select>--}}
{{--                  @endif--}}
{{--              </div>--}}
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.Country') }}:</label>
                <select id="country_id" class="form-control js-example-basic-single" name="country_id">
                  <option value="none" selected disabled hidden>
                      {{ __('adminstaticword.SelectanOption') }}
                    </option>

                  @foreach ($countries as $coun)
                    <option value="{{ $coun->country_id }}" {{ $user->country_id == $coun->country_id ? 'selected' : ''}}>{{ $coun->nicename }}
                    </option>
                  @endforeach
                </select>
              </div>

{{--              <div class="col-md-3">--}}
{{--                <label for="city_id">{{ __('adminstaticword.State') }}:</label>--}}
{{--                <select id="upload_id" class="form-control js-example-basic-single" name="state_id">--}}
{{--                  <option value="none" selected disabled hidden>--}}
{{--                    {{ __('adminstaticword.SelectanOption') }}--}}
{{--                  </option>--}}
{{--                  @foreach ($states as $s)--}}
{{--                    <option value="{{ $s->state_id}}" {{ $user->state_id==$s->state_id ? 'selected' : '' }}>{{ $s->name}}</option>--}}
{{--                  @endforeach--}}

{{--                </select>--}}
{{--              </div>--}}

{{--              <div class="col-md-3">--}}
{{--                <label for="city_id">{{ __('adminstaticword.City') }}:</label>--}}
{{--                <select id="grand" class="form-control js-example-basic-single" name="city_id">--}}
{{--                  <option value="none" selected disabled hidden>--}}
{{--                     {{ __('adminstaticword.SelectanOption') }}--}}
{{--                  </option>--}}
{{--                  @foreach ($cities as $c)--}}
{{--                    <option value="{{ $c->id }}" {{ $user->city_id == $c->id ? 'selected' : ''}}>{{ $c->name }}--}}
{{--                    </option>--}}
{{--                  @endforeach--}}
{{--                </select>--}}
{{--              </div>--}}

{{--              <div class="col-md-3">--}}
{{--                <label for="pin_code">{{ __('adminstaticword.Pincode') }}:</label>--}}
{{--                <input value="{{ $user->pin_code }}" placeholder="{{ __('adminstaticword.Pincode') }}" type="text" name="pin_code" class="form-control">--}}
{{--              </div>--}}
            </div>
            <br>
              @if(Auth::User()->role=="admin")

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Verified') }}:</label>
                <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="c033"   type="checkbox" name="verified" {{ $user->verified == '1' ? 'checked' : '' }}>
                <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes" for="c033"></label>
                </li>
                <input type="hidden" name="free4" for="verified" id="tt">
              </div>

              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $user->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
              </li>
              <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>
                <div class="col-md-3">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.visibility') }}:</label>
                    <li class="tg-list">
                        <input class="tgl tgl-skewed" id="visibility" type="checkbox" name="visibility" {{ $user->visibility == '1' ? 'checked' : '' }} >
                        <label class="tgl-btn" data-tg-off="Hide" data-tg-on="Show" for="visibility"></label>
                    </li>
                    <input type="hidden"  name="free2" value="0" for="visibility" id="visibility">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Archive') }}:</label>
                    <li class="tg-list">
                        <input class="tgl tgl-skewed" id="archive" type="checkbox" name="archive" {{ $user->archive == '0' ? 'checked' : '' }} >
                        <label class="tgl-btn" data-tg-off="archive" data-tg-on="unarchive" for="archive"></label>
                    </li>
                    <input type="hidden"  name="free3" value="0" for="archive" id="archive">
                </div>
                @endif
{{--              <div class="col-md-3">--}}
{{--                  <label  for="married_status">{{ __('adminstaticword.ChooseMarrigeStatus') }}: </label>--}}
{{--                  <select class="form-control js-example-basic-single" id="married_status" name="married_status">--}}
{{--                    <option value="none" selected disabled hidden>--}}
{{--                       {{ __('adminstaticword.SelectanOption') }}--}}
{{--                    </option>--}}
{{--                    <option id="Unmarried" {{ $user->married_status == 'Unmarried' ? 'selected' : ''}} value="Unmarried">{{ __('adminstaticword.Unmarried') }}</option>--}}
{{--                    <option id="Married" {{ $user->married_status == 'Married' ? 'selected' : ''}} value="Married">{{ __('adminstaticword.Married') }}</option>--}}
{{--                    <option id="Divorced" {{ $user->married_status == 'Divorced' ? 'selected' : ''}} value="Divorced">{{ __('adminstaticword.Divorced') }}</option>--}}
{{--                    <option id="Widowed" {{ $user->married_status == 'Widowed' ? 'selected' : ''}} value="Widowed">{{ __('adminstaticword.Widowed') }}</option>--}}
{{--                  </select>--}}
{{--                  <br>--}}
{{--              </div>--}}


              <div class="col-md-3 display-none" id="doaboxxx">
                <label for="dob">{{ __('adminstaticword.DateofAnniversary') }}: </label>
                <input value="{{ $user->doa }}" name="doa" id="doa" type="text" class="form-control" placeholder="{{ __('adminstaticword.DateofAnniversary') }}">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                <input type="file" name="user_img" class="form-control">
              </div>
              <div class="col-md-6">
                @if($user->user_img != null || $user->user_img !='')
                  <div class="edit-user-img">
                    <img id="image_0" src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
				  <div id="modal_0" class="modal image_modal">
					<span class="close close_0">&times;</span>
					<img class="modal-content" id="img_0">
					<div id="caption_0" class="caption"></div>
				  </div>
                @else
                  <div class="edit-user-img">
                    <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @endif
              </div>
            </div>
			
		{{-- 	@if($user->user_details != null) --}}
				<div class="row">
					<div class="col-md-6">
						<label>{{ __('frontstaticword.national_id_image') }}:<sup class="redstar">*</sup></label>
						<input type="file" name="national_id_img" class="form-control">
					</div>
					
					<div class="col-md-6">
            @isset($user->user_details->national_id_image)
					@if($user->user_details->national_id_image != null || $user->user_details->national_id_image !='')
						<div class="edit-user-img">
							<img id="image_1" src="{{ url('/images/national_id/'.$user->user_details->national_id_image) }}" class="img-fluid" alt="User National ID" class="img-responsive">
						</div>
						<div id="modal_1" class="modal image_modal">
							<span class="close close_1">&times;</span>
							<img class="modal-content" id="img_1">
							<div id="caption_1" class="caption"></div>
						</div>
					@endif
          @endisset
					</div>
				</div>
				<br>
	{{-- 		@endif --}}

            <div class="row">
              <div class="col-md-12">
                <div class="update-password">
                  <label for="box1"> {{ __('adminstaticword.UpdatePassword') }}:</label>
                  <input type="checkbox" id="myCheck" name="update_pass" onclick="myFunction()">
                </div>
              </div>
            </div>

            <div class="row display-none" id="update-password">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Password') }}</label>
                <input type="password" name="password" class="form-control" placeholder="{{ __('adminstaticword.Password') }}">
              </div>
              <div class="col-md-6">
                <label>{{ __('adminstaticword.ConfirmPassword') }}</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="{{ __('adminstaticword.ConfirmPassword') }}">
              </div>
            </div>
            <br>


            <div class="row">
              <div class="col-md-12">
                <label for="detail">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="detail" class="form-control" rows="5" placeholder="{{ __('adminstaticword.Detail') }}" value="">{{ $user->detail }}</textarea>
              </div>
            </div>
            <br>

{{--            <div class="box-header with-border">--}}
{{--              <h3 class="box-title">{{ __('adminstaticword.SocialProfile') }}</h3>--}}
{{--            </div>--}}
            <br>

{{--            <div class="row">--}}
{{--              <div class="col-md-6">--}}
{{--                <label for="fb_url">--}}
{{--                {{ __('adminstaticword.FacebookUrl') }}:--}}
{{--                </label>--}}
{{--                <input autofocus name="fb_url" value="{{ $user->fb_url }}" type="text" class="form-control" placeholder="{{ __('adminstaticword.FacebookUrl') }}"/>--}}
{{--              </div>--}}
{{--              <div class="col-md-6">--}}
{{--                <label for="youtube_url">--}}
{{--                {{ __('adminstaticword.YoutubeUrl') }}:--}}
{{--                </label>--}}
{{--                <input autofocus name="youtube_url" value="{{ $user->youtube_url }}" type="text" class="form-control" placeholder="{{ __('adminstaticword.YoutubeUrl') }}"/>--}}
{{--                <br>--}}
{{--              </div>--}}
{{--            --}}
{{--              <div class="col-md-6">--}}
{{--                <label for="twitter_url">--}}
{{--                {{ __('adminstaticword.TwitterUrl') }}:--}}
{{--                </label>--}}
{{--                <input autofocus name="twitter_url" value="{{ $user->twitter_url }}" type="text" class="form-control" placeholder="{{ __('adminstaticword.TwitterUrl') }}"/>--}}
{{--              </div>--}}
{{--              <div class="col-md-6">--}}
{{--                <label for="linkedin_url">--}}
{{--                {{ __('adminstaticword.LinkedInUrl') }}:--}}
{{--                </label>--}}
{{--                <input autofocus name="linkedin_url" value="{{ $user->linkedin_url }}" type="text" class="form-control" placeholder="{{ __('adminstaticword.LinkedInUrl') }}"/>--}}
{{--              </div>--}}
{{--            </div>--}}
            <br>
            <br>


            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary" id="formSubmition">
                <i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}
              </button>
            </form>
              <a href="{{ route('user.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
              </a>
            </div>
            <br>

          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')

<script>
(function($) {
  "use strict";
	
  var imageModals = document.getElementsByClassName('image_modal');
  for(var i=0;i< imageModals.length;i++)
  {
	var modal = document.getElementById('modal_'+i);
	if(typeof(modal) != 'undefined' && modal != null)
	{
		var image = document.getElementById('image_'+i);
		var img = document.getElementById('img_'+i);
		var caption = document.getElementById('caption_'+i);
		image.onclick = function(){
		  modal.style.display = 'block';
		  img.src = this.src;
		  caption.innerHTML = this.alt;
		}
		var span = document.getElementsByClassName('close_'+i)[0];
		span.onclick = function() {
		  modal.style.display = 'none';
		}
	}
  }

  /*var national_id_img_modal = document.getElementById("national_id_image_modal");
  if (typeof(national_id_img_modal) != 'undefined' && national_id_img_modal != null)
  {
	var national_id_img = document.getElementById("national_id_image");
	var modalNationalIdImg = document.getElementById("img01");
	var captionNationalIdText = document.getElementById("caption01");
	national_id_img.onclick = function(){
	  national_id_img_modal.style.display = "block";
	  modalNationalIdImg.src = this.src;
	  captionNationalIdText.innerHTML = this.alt;
	}
	var span = document.getElementsByClassName("close01")[0];
	span.onclick = function() {
	  national_id_img_modal.style.display = "none";
	}
  }
  
  var user_img_modal = document.getElementById("user_image_modal");
  if (typeof(user_img_modal) != 'undefined' && user_img_modal != null)
  {
	var user_img = document.getElementById("user_image");
	var modalUserImg = document.getElementById("img02");
	var captionUserText = document.getElementById("caption02");
	user_img.onclick = function(){
	  user_img_modal.style.display = "block";
	  modalUserImg.src = this.src;
	  captionUserText.innerHTML = this.alt;
	}
	var span = document.getElementsByClassName("close02")[0];
	span.onclick = function() {
	  user_img_modal.style.display = "none";
	}
  }*/
  
  $( function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });


  $('#married_status').change(function() {

    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  tinymce.init({selector:'textarea#detail'});

  $(function() {
    var urlLike = '{{ url('country/dropdown') }}';
    $('#country_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">' + "{{ __('dashboard.please_choose') }}" +'</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

  $(function() {
    var urlLike = '{{ url('country/gcity') }}';
    $('#upload_id').change(function() {
      var up = $('#grand').empty();
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">' + "{{ __('dashboard.please_choose') }}" +'</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });


$('#archive').change(function() {
    alert('Are You Sure ?!')
});

 /* $('#uploadVideo').on('change', function() {
      let size = this.files[0].size; // this is in bytes
      if (size > 102400) {
          alert("file size is more than 50 MB");
          $("#uploadVideoLabel").text('file size is greater than 50 MB');
          $("#formSubmition").attr('disabled', 'disabled');
      }else{
          $("#uploadVideoLabel").text('');

          $("#formSubmition").removeAttr('disabled');
      }
  });*/
})(jQuery);

function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("update-password");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>

@endsection

