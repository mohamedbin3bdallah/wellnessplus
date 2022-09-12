@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.Add').' '.__('adminstaticword.Package'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.Package') }}</h3>
                </div>
                <div class="panel-body">


                    <form id="demo-form2" method="post" action="{{route('store.package')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                                <input type="text" class="form-control" name="name" id="sub_heading" placeholder="{{ __('adminstaticword.Name') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="rate">{{ __('adminstaticword.numOfHours') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="number" min="1" max="100" name="numOfHours" placeholder="{{ __('adminstaticword.numOfHours') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="rate">{{ __('adminstaticword.discountPerHour') }}:<sup class="redstar">*</sup></label>
                                <!--<input class="form-control" type="number" min="0" max="100" name="discountPercentage" placeholder="Please enter discount per hour" required>-->
								<input class="form-control" type="text" name="discountPercentage" placeholder="{{ __('adminstaticword.discountPerHour') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="rate">{{ __('adminstaticword.icon') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="file" name="icon" required>
                            </div>
                            <div class="col-md-2">
                                <label for="status">{{ __('adminstaticword.Status') }}: <sup class="redstar">*</sup></label>
                                <select class="form-control js-example-basic-single" name="active" required>
                                    <option value="none" selected disabled hidden>
                                        {{ __('adminstaticword.SelectanOption') }}
                                    </option>
                                    <option value="0">Not Active</option>
                                    <option value="1"> Active</option>
                                </select>
                            </div>
                        </div>
						
						<div class="row">
							<div class="col-md-2">
                                <label for="organization_flag">{{ __('adminstaticword.organization_flag') }}:</label>
                                <input type="checkbox" name="organization_flag" />
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

