@extends('admin.layouts.master')
@section('title', __('adminstaticword.Users'))
@section('body')

<script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Users') }}</h3>
          <a class="btn btn-info btn-sm" href="{{ route('user.add') }}">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.User') }}</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              @if(Auth::user()->role == 'partner') <table id="partnertable" class="table table-bordered table-striped table-responsive display nowrap">
			  @else <table id="admintable" class="table table-bordered table-striped table-responsive display nowrap">
			  @endif
				@if(Auth::user()->role == 'admin')
				<div class="row">
				<div class="col-md-6">
					<label for="role">{{ __('adminstaticword.Role') }}</label>
					<select class="form-control js-example-basic-single" name="role" id="role" required>
						<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
						<option value="user">{{ __('dashboard.student') }}</option>
						<option value="partner">{{ __('adminstaticword.Partner') }}</option>
						<option value="admin">{{ __('adminstaticword.Admin') }}</option>
						<option value="instructor">{{ __('adminstaticword.Tutor') }}</option>
					</select>
				</div>
				<div class="col-md-6">
					<label for="tutorStatus">{{ __('adminstaticword.instructorStatus') }}</label>
					<select class="form-control js-example-basic-single" name="tutorStatus" id="tutorStatus" required>
						<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
						<option value="1">{{ __('adminstaticword.Approved') }}</option>
						<option value="2">{{ __('adminstaticword.Pending') }}</option>
					</select>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
					<label for="tutorStatus">{{ __('adminstaticword.Country') }}</label>
					<select class="form-control js-example-basic-single" name="country" id="country" required>
						<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
						@foreach($countries as $country)
							<option value="{{$country->id}}">{{$country->name}}</option>
						@endforeach
					</select>
				</div>
				</div>
				@endif
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.FirstName') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.paidpackages') }}</th>@endif
                  <th>{{ __('adminstaticword.Role') }}</th>
                  @if(Auth::user()->role == 'admin')<th>{{ __('adminstaticword.instructorStatus') }}</th>@endif
                  <th>{{ __('adminstaticword.Mobile') }}</th>
                  <th>{{ __('adminstaticword.Country') }}</th>
				  <th>{{ __('frontstaticword.CountryOfResidence') }}</th>
                  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.actions') }}</th>@endif
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

<script>
(function($){
	$(document).ready(function () {
        $('#admintable').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 9, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [1,5,7,8,10,11,12] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('/user/getusers') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
								d.role = $('#role').val();
								d.tutorStatus = $('#tutorStatus').val();
								d.country = $('#country').val();
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "image" },
                { "data": "fname" },
				{ "data": "email" },
				{ "data": "role" },
				{ "data": "instructorstatus" },
				{ "data": "mobile" },
				{ "data": "country" },
				{ "data": "CountryOfResidence" },
                { "data": "created_at" },
                { "data": "status" },
				{ "data": "edit" },
				{ "data": "delete" },
            ]	 

        });
		/*$('#role').on('change', function() {
			$('#admintable').DataTable().search(
				$('#role').val()       
			).draw();
		});*/
		$('#role').on('change', function() {
			$tabla = $('#admintable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#tutorStatus').on('change', function() {
			$tabla = $('#admintable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#country').on('change', function() {
			$tabla = $('#admintable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
    });

	$(document).ready(function () {
        $('#partnertable').DataTable({
			"pageLength": 10,
			"order": [[ 9, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [1,4,7,8,10,11,12,13] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('/user/getusers') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "image" },
                { "data": "fname" },
				{ "data": "email" },
				{ "data": "paid" },
				{ "data": "role" },
				{ "data": "mobile" },
				{ "data": "country" },
				{ "data": "CountryOfResidence" },
                { "data": "created_at" },
                { "data": "status" },
				{ "data": "edit" },
				{ "data": "delete" },
				{ "data": "actions" },
            ]	 

        });
    });
})(jQuery);
</script>

@endsection