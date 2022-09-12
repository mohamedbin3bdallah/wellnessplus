@extends('admin.layouts.master')
@section('title', __('adminstaticword.appointments'))
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
          <h3 class="box-title">{{ __('adminstaticword.appointments') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
		  
			<div class="box">
			  <div class="box-header with-border">
				<h5 class="">{{ __('dashboard.filters') }}</h5>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			  </div>
			  <div class="box-body">
				<div class="row">
				  <div class="col-md-6">
				    <label for="student">{{ __('adminstaticword.student') }}</label>
					<select class="form-control js-example-basic-single" name="student[]" id="student" multiple>
						@foreach($students as $student)
							<option value="{{ $student->id }}">{{ $student->fname.' '.$student->lname.' - '.$student->email }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-6">
				    <label for="tutor">{{ __('adminstaticword.Tutor') }}</label>
					<select class="form-control js-example-basic-single" name="tutor[]" id="tutor" multiple>
						@foreach($tutors as $tutor)
							@if($tutor->user)<option value="{{ $tutor->id }}">{{ $tutor->user->fname.' '.$tutor->user->lname.' - '.$tutor->user->email }}</option>@endif
						@endforeach
					</select>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-4">
				    <label for="date">{{ __('adminstaticword.Date') }}</label>
					<select class="form-control js-example-basic-single" name="date[]" id="date" multiple>
						@foreach($dates as $date)
							<option value="{{ $date->date }}">{{ $date->date }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-4">
				    <label for="time">{{ __('adminstaticword.time') }}</label>
					<select class="form-control js-example-basic-single" name="time[]" id="time" multiple>
						@foreach($times as $time)
							<option value="{{ $time->start_time }}">{{ $time->start_time }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-4">
				    <label for="status">{{ __('adminstaticword.Status') }}</label>
					<select class="form-control js-example-basic-single" name="status[]" id="status" multiple>
						@foreach($statuses as $status)
							<option value="{{ $status->id }}">{{ $status->status }}</option>
						@endforeach
					</select>
				  </div>
				</div>
			  </div>
			</div>
				
            <div class="table-responsive">
             <table id="datatable" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.student') }}</th>
				  <th>{{ __('adminstaticword.Tutor') }}</th>
				  <th>{{ __('adminstaticword.Date') }}</th>
                  <th>{{ __('adminstaticword.time') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
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

@include('admin.users.tutors.detail')

<script>
(function($){
	$(document).ready(function () {
		$("[data-widget='collapse']").click();
		
        $('#datatable').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 3, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get.appointments') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
							d._token = "{{csrf_token()}}";
							d.student = $('#student').val();
							d.tutor = $('#tutor').val();
							d.date = $('#date').val();
							d.time = $('#time').val();
							d.status = $('#status').val();
						}
                   },
            "columns": [
                { "data": "id" },
				{ "data": "student" },
                { "data": "tutor" },
				{ "data": "date" },
                { "data": "time" },
				{ "data": "status" },
            ]
        });
		
		$('#student').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#tutor').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#date').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#time').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#status').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
    });
})(jQuery);
</script>

@endsection