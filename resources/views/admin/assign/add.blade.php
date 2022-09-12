@extends("admin/layouts.master")
@section('title',__('adminstaticword.assigntutortopartner'))
@section("body")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.assigntutortopartner') }}</h3>
            <div class="panel-heading">
            </div>
			
			@if(Auth::User()->role != "admin") {{ __('adminstaticword.youarenotadmin') }}
			
            @else
			<form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('assign/store')}}" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      {{ __('adminstaticword.Partner') }} <span class="redstar">*</span>
                    </label>


                    <div class="col-md-6 col-sm-6 col-xs-12">

                      <select required class="form-control js-example-basic-single" name="partner_id">
                      <option value="">{{ __('adminstaticword.Partner') }}:</option>

                      @foreach ($partners as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->fname.' '.$partner->lname }}</option>
                      @endforeach
                    </select>

                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      {{ __('adminstaticword.Tutor') }} <span class="redstar">*</span>
                    </label>


                    <div class="col-md-6 col-sm-6 col-xs-12">

                      <select required class="form-control js-example-basic-single" name="tutor_id">
                      <option value="">{{ __('adminstaticword.Tutor') }}:</option>

                      @foreach ($tutors as $tutor)
                        <option value="{{ $tutor->id }}">{{ $tutor->fname.' '.$tutor->lname.' - '.$tutor->email }}</option>
                      @endforeach
                    </select>

                    </div>
                </div>
				
                <div class="box-footer">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <button type="submit" class="btn btn-primary">{{ __('adminstaticword.Save') }}</button>
                </div>
            </form>
			@endif
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</section>

@endsection
