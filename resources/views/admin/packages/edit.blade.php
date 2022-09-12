@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.Edit').' '.__('adminstaticword.Package'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Package') }}</h3>
                </div>
                <div class="panel-body">


                    <form id="demo-form2" method="post" action="/admins/package/{{$package->id}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                                <input type="text" class="form-control" name="name" value="{{ $package->name }}" id="sub_heading" required>
                            </div>
                            <div class="col-md-2">
                                <label for="local">{{ __('adminstaticword.numOfHours') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="number" name="numOfHours" value="{{ $package->numOfHours }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="local">{{ __('adminstaticword.discountPerHour') }}:<sup class="redstar">*</sup></label>
                                <!--<input class="form-control" type="number" name="discountPercentage" value="{{ $package->discountPercentage }}" required>-->
								<input class="form-control" type="text" name="discountPercentage" value="{{ $package->discountPercentage }}" required>
                            </div> <div class="col-md-2">
                                <label for="local">{{ __('adminstaticword.icon') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="file" name="icon" value="{{ $package->icon }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="role">{{ __('adminstaticword.Status') }}: <sup class="redstar">*</sup></label>
                                <select class="form-control js-example-basic-single" name="active" required>
                                    @if($package->active == 0)
                                        <option value="0" selected>
                                            {{ __('adminstaticword.notActive') }}
                                        </option>
                                    @else
                                        <option value="1" selected>
                                            {{ __('adminstaticword.Active') }}
                                        </option>
                                    @endif
                                    <option value="0">{{ __('adminstaticword.notActive') }}</option>
                                    <option value="1">{{ __('adminstaticword.Active') }}</option>
                                </select>
                            </div>
                        </div>
						
						<div class="row">
							<div class="col-md-2">
                                <label for="organization_flag">{{ __('adminstaticword.organization_flag') }}:</label>
                                <input type="checkbox" name="organization_flag" @if($package->organization_flag == 1) {{ 'checked' }} @endif />
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

