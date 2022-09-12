@extends('admin.layouts.master')
@section('title', __('adminstaticword.Tutors').' '.__('adminstaticword.organization'))

@section('stylesheets')

<style>
.dataTables_filter
{
	display: none;
}
</style>

@endsection

@section('body')

<script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Tutors') }} {{ __('adminstaticword.organization') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
			  <table id="datatable" class="table table-bordered table-striped table-responsive display nowrap">
				<div class="row">
				<div class="col-md-3">
					<label for="organization">{{ __('adminstaticword.organization') }}</label>
					<select class="form-control js-example-basic-single" name="organization" id="organization" required>
						<option value="">{{ __('adminstaticword.all') }}</option>
						@foreach($organizations as $organization)
							<option value="{{$organization->id}}">{{$organization->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<label for="country">{{ __('adminstaticword.Country') }}</label>
					<select class="form-control js-example-basic-single" name="country" id="country" required>
						<option value="">{{ __('adminstaticword.all') }}</option>
						@foreach($countries as $country)
							<option value="{{$country->id}}">{{$country->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<label for="date">{{ __('adminstaticword.registrationDate') }}</label>
					<input type="date" class="form-control" name="date" id="date" />
				</div>
				<div class="col-md-3">
					<label for="search">{{ __('adminstaticword.search') }}</label>
					<input type="text" class="form-control" name="search" id="search" />
				</div>
				</div>
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Tutor') }}</th>
                  <th>{{ __('adminstaticword.organization') }}</th>
				  <th>{{ __('adminstaticword.Country') }}</th>
                  <th>{{ __('adminstaticword.pricePerHour') }}</th>
				  @foreach($packages as $package)
					<th>{{ $package->name.' (%'.$package->discountPercentage.')' }}</th>
				  @endforeach
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

<script>
(function($){
	$(document).ready(function () {
		var count = {{count($packages)}} + 6;
		var order = new Array(count).fill(null).map((_, i) => i);
		
        $('#datatable').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ order.length - 1, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": order }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('/report/tutors_organization') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
								d.organization = $('#organization').val();
								d.country = $('#country').val();
								d.date = $('#date').val();
								d.search = $('#search').val();
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "tutor" },
                { "data": "organization" },
				{ "data": "country" },
				{ "data": "pricePerHour" },
				@foreach($packages as $packag)
					{ "data": "{{ $packag->id }}" },
				@endforeach
                { "data": "created_at" },
            ]	 

        });
		$('#organization').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#country').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#date').on('change', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
		$('#search').on('keyup', function() {
			$tabla = $('#datatable').DataTable();
			$tabla.ajax.reload( null, false ); 
		});
    });
})(jQuery);
</script>

@endsection