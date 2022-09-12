@extends("admin/layouts.master")
@section('title', __('adminstaticword.addPackage'))

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
		{{ __('adminstaticword.addPackage') }}
      </div>
    </div>
    <form action="{{ route('store.tutor.packages') }}" method="POST">
    @csrf
      <div class="box-body">
		  <div class="form-group">
              <label>{{ __('adminstaticword.Tutor') }}: <span class="redstar">*</span></label>
              <select required class="form-control js-example-basic-single" name="tutor_id">
                <option value="">{{ __('adminstaticword.Tutor') }}:</option>
                @foreach ($tutors as $tutor)
                    @if(isset($tutor->user))<option value="{{ $tutor->id }}">{{ $tutor->user->fname.' '.$tutor->user->lname }}</option>@endif
                @endforeach
			  </select>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Name') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
              <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.title') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
              <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.about') }}: <span class="redstar">*</span></label>
              <textarea required="" class="form-control" id="about" name="about">{{ old('about') }}</textarea>
              <span class="text-danger">{{ $errors->has('about') ? $errors->first('about') : '' }}</span>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Description') }}: <span class="redstar">*</span></label>
              <textarea required="" class="form-control ckeditor" id="description" name="description">{{ old('description') }}</textarea>
              <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.numOfHours') }}: <span class="redstar">*</span></label>
			  <input required="" type="number" class="form-control" id="numOfHours" name="numOfHours" value="{{ old('numOfHours') }}">
              <span class="text-danger">{{ $errors->has('numOfHours') ? $errors->first('numOfHours') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.origenalPrice') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="origenalPrice" name="origenalPrice" value="{{ old('origenalPrice') }}">
              <span class="text-danger">{{ $errors->has('origenalPrice') ? $errors->first('origenalPrice') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.discountPrice') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="discountPrice" name="discountPrice" value="{{ old('discountPrice') }}">
              <span class="text-danger">{{ $errors->has('discountPrice') ? $errors->first('discountPrice') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.pricePerHour') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="pricePerHour" name="pricePerHour" value="{{ old('pricePerHour') }}">
              <span class="text-danger">{{ $errors->has('pricePerHour') ? $errors->first('pricePerHour') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.totalPrice') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="totalPrice" name="totalPrice" value="{{ old('totalPrice') }}">
              <span class="text-danger">{{ $errors->has('totalPrice') ? $errors->first('totalPrice') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.featured') }}: <span class="redstar">*</span></label>
              <select required="" name="featured" id="featured" class="form-control">
                  <option value="0">{{ __('adminstaticword.no') }}</option>
                  <option value="1">{{ __('adminstaticword.yes') }}</option>
              </select>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Status') }}: <span class="redstar">*</span></label>
              <select required="" name="status" id="status" class="form-control">
                  <option value="0">{{ __('adminstaticword.notActive') }}</option>
                  <option value="1">{{ __('adminstaticword.Active') }}</option>
              </select>
          </div>
      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('show.tutor.packages') }}" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection


@section('scripts')

<script>
(function($){
	$(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
})(jQuery);
</script>

@endsection