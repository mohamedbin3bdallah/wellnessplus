@extends("admin/layouts.master")
@section('title',__('adminstaticword.Tutor').' '.__('adminstaticword.Country').' '.__('adminstaticword.pricePerHour'))

@section('body')
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Tutor').' '.__('adminstaticword.Country').' '.__('adminstaticword.pricePerHour') }}</h3>
          <a href="{{ route('create.tutor.country.pricePerHour') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> {{ __('adminstaticword.add') }} </a>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="tutor-country" class="table table-bordered table-striped">
              <thead>
                <th>#</th>
                <th>{{ __('adminstaticword.Tutor') }}</th>
				<th>{{ __('adminstaticword.Mobile') }}</th>
				<th>{{ __('adminstaticword.Email') }}</th>
				<th>{{ __('adminstaticword.Country') }}</th>
                <th>{{ __('adminstaticword.pricePerHour') }}</th>
				<th>{{ __('adminstaticword.Status') }}</th>
				<th>{{ __('adminstaticword.CreatedAt') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
(function($){
	$(document).ready(function () {
        $('#tutor-country').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 7, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [8,9] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get.tutor.country.pricePerHour') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "tutor" },
                { "data": "mobile" },
				{ "data": "email" },
				{ "data": "country" },
				{ "data": "price" },
				{ "data": "status" },
				{ "data": "created_at" },
                { "data": "edit" },
				{ "data": "delete" },
            ]
        });
    });
})(jQuery);
</script>
@endsection