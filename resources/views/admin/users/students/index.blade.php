@extends('admin.layouts.master')
@section('title', __('adminstaticword.students'))
@section('body')

@section('stylesheets')
<link rel="stylesheet" href="{{ url('admin/css/total.css') }}">
<link rel="stylesheet" href="{{ url('admin/css/users.css') }}">
@endsection

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.students') }}</h3>
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
				  <div class="col-md-4">
				    <label for="country">{{ __('adminstaticword.Country') }}</label>
					<select class="form-control js-example-basic-single" name="country[]" id="country" multiple>
						@foreach($countries as $country)
							<option value="{{ $country->id }}">{{ $country->nicename }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-4">
				    <label for="organization">{{ __('adminstaticword.organization') }}</label>
					<select class="form-control js-example-basic-single" name="organization[]" id="organization" multiple>
						@foreach($organizations as $organization)
							<option value="{{ $organization->id }}">{{ $organization->name }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-4">
				    <label for="package">{{ __('adminstaticword.Package') }}</label>
					<select class="form-control js-example-basic-single" name="package[]" id="package" multiple>
						@foreach($packages as $package)
							<option value="{{ $package->id }}">{{ $package->name }}</option>
						@endforeach
					</select>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-3">
				    <label for="status">{{ __('adminstaticword.Status') }}</label>
					<select class="form-control js-example-basic-single" name="status" id="status">
						<option value="99999">{{ __('adminstaticword.all') }}</option>
						<option value="0">{{ __('adminstaticword.notActive') }}</option>
						<option value="1">{{ __('adminstaticword.Active') }}</option>
					</select>
				  </div>
				  <div class="col-md-3">
				    <label for="gender">{{ __('adminstaticword.Gender') }}</label>
					<select class="form-control js-example-basic-single" name="gender[]" id="gender" multiple>
						<option value="m">{{ __('adminstaticword.Male') }}</option>
						<option value="f">{{ __('adminstaticword.Female') }}</option>
						<option value="o">{{ __('adminstaticword.Other') }}</option>
						<option value="null">{{ __('adminstaticword.not_specified') }}</option>
					</select>
				  </div>
				  <div class="col-md-3">
				    <label for="verification">{{ __('adminstaticword.verification') }}</label>
					<select class="form-control js-example-basic-single" name="verification" id="verification">
						<option value="99999">{{ __('adminstaticword.all') }}</option>
						<option value="0">{{ __('adminstaticword.not_verified') }}</option>
						<option value="1">{{ __('adminstaticword.verified') }}</option>
					</select>
				  </div>
				  <div class="col-md-3">
				    <label for="date">{{ __('adminstaticword.CreatedAt') }}</label>
					<input type="date" class="form-control" name="date" id="date" />
				  </div>
				</div>
			  </div>
			</div>
				
            <div class="table-responsive">
             <table id="datatable" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
				  <th>{{ __('adminstaticword.Name') }}</th>
				  <th>{{ __('adminstaticword.Gender') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Mobile') }}</th>
				  <th>{{ __('adminstaticword.Country') }}</th>
				  <th>{{ __('adminstaticword.organization') }}</th>
				  <th>{{ __('adminstaticword.Package') }}</th>
				  <th>{{ __('adminstaticword.verification') }}</th>
				  <th>{{ __('adminstaticword.Status') }}</th>
				  <th>{{ __('adminstaticword.CreatedAt') }}</th>
				  <th>{{ __('adminstaticword.Edit') }}</th>
				  <th>{{ __('adminstaticword.Delete') }}</th>
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
			"order": [[ 11, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [1,7,8,12,13] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get.students.users') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
							d._token = "{{csrf_token()}}";
							d.country = $('#country').val();
							d.organization = $('#organization').val();
							d.package = $('#package').val();
							d.status = $('#status').val();
							d.gender = $('#gender').val();
							d.verification = $('#verification').val();
							d.date = $('#date').val();
						}
                   },
            "columns": [
                { "data": "id" },
				{ "data": "image" },
                { "data": "name" },
				{ "data": "gender" },
                { "data": "email" },
				{ "data": "mobile" },
				{ "data": "country" },
				{ "data": "organization" },
				{ "data": "package" },
				{ "data": "verification" },
				{ "data": "status" },
				{ "data": "created_at" },
				{ "data": "edit" },
				{ "data": "delete" },
            ]
        });
		
		$('#country').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#organization').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#package').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#status').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#gender').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#verification').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#date').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		
		$('#datatable').on('click', '.changData', function() {
			var id = $(this).attr('id');
			var type = $(this).attr('type');
			var to = $(this).attr('to');
			$.ajax({
				type:"POST",
				url: "{{ route('change.students.users') }}",
				data: {
					_token: "{{csrf_token()}}",
					id: id,
					type: type,
					to: to
				},
				success:function(response){
					//console.log(response);
					var response_data = JSON.parse(response);
					if(response_data.status) {
						$tabla = $('#datatable').DataTable();
						$tabla.ajax.reload( null, false );
						//alert(response_data.message);
					} else {
						$tabla = $('#datatable').DataTable();
						$tabla.ajax.reload( null, false );
						alert(response_data.message);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//console.log(XMLHttpRequest);
				}
			});
		});
    });
})(jQuery);
</script>

@endsection