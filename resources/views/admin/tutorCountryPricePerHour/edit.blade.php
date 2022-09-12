@extends("admin/layouts.master")
@section('title', __('adminstaticword.edit').' '.__('adminstaticword.Country').' '.__('adminstaticword.pricePerHour'))

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
		{{ __('adminstaticword.edit').' '.__('adminstaticword.Country').' '.__('adminstaticword.pricePerHour') }}
      </div>
    </div>
    <form action="{{ route('update.tutor.country.pricePerHour',$data->id) }}" method="POST">
    @csrf
	{{ method_field('PUT') }}
      <div class="box-body">
		  <div class="form-group">
              <label>{{ __('adminstaticword.Tutor') }}: <span class="redstar">*</span></label>
              <select required class="form-control js-example-basic-single" name="tutor_id">
                <option value="">{{ __('adminstaticword.Tutor') }}:</option>
                @foreach ($tutors as $tutor)
                    @if(isset($tutor->user))<option value="{{ $tutor->id }}" @if($data->tutor_id == $tutor->id) {{ 'selected' }} @endif>{{ $tutor->user->fname.' '.$tutor->user->lname.' - '.$tutor->user->email }}</option>@endif
                @endforeach
			  </select>
			  <span class="text-danger">{{ $errors->has('tutor_id') ? $errors->first('tutor_id') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.Country') }}: <span class="redstar">*</span></label>
              <select required class="form-control js-example-basic-single" name="country_id">
                <option value="">{{ __('adminstaticword.Country') }}:</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if($data->country_id == $country->id) {{ 'selected' }} @endif>{{ $country->nicename }}</option>
                @endforeach
			  </select>
			  <span class="text-danger">{{ $errors->has('country_id') ? $errors->first('country_id') : '' }}</span>
          </div>
		  <div class="form-group">
              <label>{{ __('adminstaticword.pricePerHour') }}: <span class="redstar">*</span></label>
              <input required type="text" class="form-control" name="pricePerHour" value="{{ $data->pricePerHour }}">
              <span class="text-danger">{{ $errors->has('pricePerHour') ? $errors->first('pricePerHour') : '' }}</span>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Status') }}: <span class="redstar">*</span></label>
              <select required class="form-control" name="status">
                  <option value="0" @if($data->status == 0) {{ 'selected' }} @endif>{{ __('adminstaticword.notActive') }}</option>
                  <option value="1" @if($data->status == 1) {{ 'selected' }} @endif>{{ __('adminstaticword.Active') }}</option>
              </select>
			  <span class="text-danger">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
          </div>
      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('show.tutor.country.pricePerHour') }}" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection