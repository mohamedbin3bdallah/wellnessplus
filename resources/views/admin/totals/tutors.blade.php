@extends('admin.layouts.master')
@section('title', __('adminstaticword.Tutors').' '.__('adminstaticword.total'))
@section('body')

@section('stylesheets')
<link rel="stylesheet" href="{{ url('admin/css/total.css') }}">
@endsection

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Tutors') }} {{ __('adminstaticword.total') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
             <table id="tutors_total" class="table table-bordered table-striped table-responsive display nowrap">
				<div class="row status">
				  <div class="col-md-5">
				    <label>{{ __('adminstaticword.appointments').' '.__('adminstaticword.Status') }}</label>
					@php
						$statuses = \App\AppointmentStatus::get();
						$status_classes = ['scheduled', 'waitingConfirm', 'confirmed', 'cancelled', 'reserved', 'waitingResolution', 'pendingPayment'];
					@endphp
					<h4>
						@foreach($statuses as $key => $status)
							<span class="label label-pad {{ $status_classes[$key] }}">{{ $status->status }}</span>&nbsp;&nbsp;&nbsp;
						@endforeach
						<span class="label label-pad label-default">{{ __('dashboard.total') }}</span>
					</h4>
				  </div>
				  <div class="col-md-2">
				    <label>{{ __('adminstaticword.meetings').' '.__('adminstaticword.Status') }}</label>
					<h4>
						<span class="label label-pad cancelled">{{ __('adminstaticword.ended') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad pendingPayment">{{ __('adminstaticword.not_ended') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad label-default">{{ __('dashboard.total') }}</span>
					</h4>
				  </div>
				  <div class="col-md-3">
				    <label>{{ __('adminstaticword.messages').' '.__('adminstaticword.Status') }}</label>
					<h4>
						<span class="label label-pad cancelled">{{ __('adminstaticword.readed') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad pendingPayment">{{ __('adminstaticword.notreaded') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad label-default">{{ __('dashboard.total') }}</span>
					</h4>
				  </div>
				  <div class="col-md-2">
				    <label>{{ __('adminstaticword.packages').' '.__('adminstaticword.Status') }}</label>
					<h4>
						<span class="label label-pad cancelled">{{ __('adminstaticword.paid') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad pendingPayment">{{ __('adminstaticword.not_paid') }}</span>&nbsp;&nbsp;&nbsp;
						<span class="label label-pad label-default">{{ __('dashboard.total') }}</span>
					</h4>
				  </div>
				</div>
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Mobile') }}</th>
				  <th>{{ __('adminstaticword.Country') }}</th>
				  <th>{{ __('adminstaticword.appointments') }}</th>
				  <th>{{ __('adminstaticword.meetings') }}</th>
				  <th>{{ __('adminstaticword.students') }}</th>
				  <th>{{ __('adminstaticword.favourites') }}</th>
				  <th>{{ __('adminstaticword.messages') }}</th>
				  <th>{{ __('adminstaticword.packages') }}</th>
				  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                </thead>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')

@include('admin.totals.details.appointments')
@include('admin.totals.details.meetings')
@include('admin.totals.details.dealwiths')
@include('admin.totals.details.favourites')
@include('admin.totals.details.messages')
@include('admin.totals.details.packages')

<script>
(function($){
	$(document).ready(function () {
        $('#tutors_total').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 11, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [5,6,7,8,9,10] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get-tutors-total') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
				{ "data": "mobile" },
				{ "data": "country" },
				{ "data": "appointments" },
				{ "data": "meetings" },
				{ "data": "students" },
				{ "data": "favourites" },
				{ "data": "messages" },
				{ "data": "packages" },
				{ "data": "created_at" },
            ]
        });
    });
})(jQuery);
</script>

@endsection