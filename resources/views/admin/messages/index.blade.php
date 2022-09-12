@extends('admin.layouts.master')
@section('title', __('adminstaticword.messages'))
@section('body')

<script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.messages') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
             <table id="messages" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.sender') }}</th>
                  <th>{{ __('adminstaticword.receiver') }}</th>
                  <th>{{ __('adminstaticword.subject') }}</th>
                  <th>{{ __('adminstaticword.content') }}</th>
				  <th>{{ __('adminstaticword.read') }}</th>
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
        $('#messages').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 6, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get.messages') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "sender" },
                { "data": "receiver" },
				{ "data": "subject" },
				{ "data": "budy" },
				{ "data": "read" },
                { "data": "created_at" },
            ]
        });
    });
})(jQuery);
</script>

@endsection