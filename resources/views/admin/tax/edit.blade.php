@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.Edit').' '.__('adminstaticword.Tax'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Tax') }}</h3>
                </div>
                <div class="panel-body">


                    <form id="demo-form2" method="post" action="/admins/tax/{{$tax->id}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-5">
                                <label for="name">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                                <input type="text" class="form-control" name="name" value="{{ $tax->name }}" id="sub_heading" placeholder="{{ __('adminstaticword.Name') }}" required>
                            </div>
                            <div class="col-md-5">
                                <label for="local">{{ __('adminstaticword.RateIn%') }}:<sup class="redstar">*</sup></label>
                                <input class="form-control" type="number" min="1" max="100" name="rate" value="{{ $tax->rate }}" placeholder="{{ __('adminstaticword.RateIn%') }}" required>
                            </div>

                            <div class="col-md-2">
                                <label for="role">{{ __('adminstaticword.Status') }}: <sup class="redstar">*</sup></label>
                                <select class="form-control js-example-basic-single" name="status" required>
                                    @if($tax->status == 0)
                                    <option value="0" selected>
                                        {{ __('adminstaticword.notActive') }}
                                    </option>
                                    @else
                                        <option value="1" selected>
                                             {{ __('adminstaticword.Active') }}
                                        </option>
                                    @endif
                                        <option value="0">{{ __('adminstaticword.notActive') }}</option>
                                    <option value="1"> {{ __('adminstaticword.Active') }}</option>
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

