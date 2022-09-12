@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.Edit').' '.__('adminstaticword.Email_templates'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Email_templates') }}</h3>
                </div>
                <div class="panel-body">


                    <form id="demo-form2" method="post" action="{{route('email.templates.update')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                                <label for="booked_successfully_studnet_email">{{ __('dashboard.email_template_tutor') }}<sup class="redstar">*</sup></label>
                                <textarea type="text" class="form-control" name="booked_successfully_tutor_email"  placeholder="Student booked a session successfully" required>{{ $email_templates ? $email_templates->booked_successfully_tutor_email : ""}}</textarea>

                        </div>

                        <div class="row">
                            <label for="booked_successfully_tutor_email">{{ __('dashboard.email_template_student') }} <sup class="redstar">*</sup></label>

                            <textarea type="text" class="form-control" name="booked_successfully_studnet_email"  placeholder="Session booked successfully" required>{{ $email_templates ? $email_templates->booked_successfully_studnet_email : ""}}</textarea>

                        </div>

                        <div class="row">
                            <label for="refund_request_email">{{ __('dashboard.request_refund_template') }}:<sup class="redstar">*</sup></label>
                            <textarea type="text" class="form-control" name="refund_request_email"  placeholder="Your reund request placed successfully" required>{{ $email_templates ? $email_templates->refund_request_email : ""}}</textarea>

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

