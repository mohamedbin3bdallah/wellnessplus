@extends('admin.layouts.master')
@section('title', __('adminstaticword.email_verification'))
@section('body')

@section('stylesheets')
  <style>
  #checkBtn
  {
	  position: fixed;
	  bottom: 50px;
	  left: 40%;
	  width: 25%;
	  z-index: 100;
  }
  </style>
@endsection

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.email_verification') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
			<form id="data-table-form" action="{{ route('send.email.verify') }}" method="POST">
			 {{ csrf_field() }}
			 <button type="submit" id="checkBtn" class="btn btn-md btn-success">{{ __('adminstaticword.send') }}</button>
             <table id="data-table" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
				  <th>{{ __('adminstaticword.choose') }}</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Role') }}</th>
                  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                </thead>
              </table>
			</form>
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
        $('#data-table').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 5, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [1] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get.email.verify') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "choose" },
                { "data": "name" },
				{ "data": "email" },
				{ "data": "role" },
                { "data": "created_at" },
            ]
        });
    });
	
	$('#checkBtn').click(function() {
		checked = $("input[type=checkbox]:checked").length;

		if(!checked) {
			alert("{{ __('backend.please_select_one_of_the_users') }}");
			return false;
		}
		else $('#data-table-form').submit()
    });
})(jQuery);
</script>

@endsection