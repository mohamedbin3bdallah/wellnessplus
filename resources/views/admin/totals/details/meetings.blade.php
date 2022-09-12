<div id="meetings_details_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
		<!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="delete-icon"></div>
				<br>
				<!--<h4 class="modal-heading"></h4>-->
			
				<!-- Widget: user widget style 1 -->
				<div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header" id="">
						<h3 class="widget-user-username text-center" id="meetings_details_modal_name"></h3>
						<h5 class="widget-user-desc text-center" id="meetings_details_modal_type"></h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" src="" alt="User Avatar">
					</div>
				</div>
				<!-- /.widget-user -->
            </div>
            <div class="modal-body">
                <div class="table-responsive">
             <table id="meetings_details" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.time') }}</th>
				  <th>{{ __('adminstaticword.meeting').' '.__('adminstaticword.id') }}</th>
				  <th>{{ __('adminstaticword.meeting').' '.__('adminstaticword.Name') }}</th>
				  <th>{{ __('adminstaticword.password') }}</th>
				  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                </thead>
              </table>
            </div>
            </div>
            <div class="modal-footer">
			</div>
        </div>
	</div>
</div>

<script>
function meetingTotal(id,name,type,image,status)
{
	(function($){
	$(document).ready(function () {
		table = $('#meetings_details').DataTable( {
			destroy: true,
		});
		table.destroy();
		
        $('#meetings_details').DataTable({
			"dom": 'Blfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"lengthMenu": [[10, 25, 50, 1000000], [10, 25, 50, "All"]],
			"pageLength": 10,
			"order": [[ 6, "DESC" ]],
			"columnDefs": [
				{ "orderable": false, "targets": [5] }
			],
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ route('get-total-meetings-details') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
								d.userId = id;
								d.type = type;
								d.status = status;
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "name" },
				{ "data": "time" },
				{ "data": "meetingId" },
				{ "data": "meetingName" },
				{ "data": "password" },
				{ "data": "created_at" },
            ]
        });
		
		$.get("{{URL::to('/')}}" + '/images/user_img/' + image)
			.done(function() { 
				$('.img-circle').attr('src','/images/user_img/' + image);
			}).fail(function() { 
				$('.img-circle').attr('src','/images/user_img/general.png');
		});
		$('#meetings_details_modal_name').html(name);
		$('#meetings_details_modal_type').html(type.charAt(0).toUpperCase() + type.slice(1) + " {{ __('adminstaticword.meetings')}}");
		$('.widget-user-header').attr('id','bg-color-' + type);
		$('#meetings_details_modal').modal('show');
    });
	})(jQuery);
}
</script>