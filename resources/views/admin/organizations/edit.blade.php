@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.Edit').' '.__('adminstaticword.organization'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.organization') }}</h3>
                </div>
                <div class="panel-body">
				
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
				@endif

                    <form id="demo-form2" method="post" action="/admins/organization/{{$organization->id}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                                <input type="text" class="form-control" name="name" value="{{ $organization->name }}" id="sub_heading" required>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                <label for="commission">{{ __('adminstaticword.commission') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="number" name="commission" value="{{ $organization->commission }}" required>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                <label for="active">{{ __('adminstaticword.Status') }}: <sup class="redstar">*</sup></label>
                                <select class="form-control js-example-basic-single" name="active" required>
                                    <option value="0" @if($organization->active == 0) {{ 'selected' }} @endif>{{ __('adminstaticword.notActive') }}</option>
                                    <option value="1" @if($organization->active == 1) {{ 'selected' }} @endif>{{ __('adminstaticword.Active') }}</option>
                                </select>
                            </div>
                        </div>
						
                        <br>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-md btn-primary">{{ __('adminstaticword.Save') }}</button>
                        </div>


                    </form>
                </div>
                <!-- /.panel body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>

@endsection

