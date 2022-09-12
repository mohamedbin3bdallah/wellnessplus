<div id="coupons_details_modal" class="modal fade" role="dialog">
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
						<h3 class="widget-user-username text-center" id="coupons_details_modal_name"></h3>
						<h5 class="widget-user-desc text-center" id="coupons_details_modal_type"></h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" src="" alt="User Avatar">
					</div>
				</div>
				<!-- /.widget-user -->
            </div>
            <div class="modal-body">
                <div class="table-responsive">
             <table id="coupons_details" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.CouponCode') }}</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
				  <th>{{ __('adminstaticword.CouponLimitationForSingleUser') }}</th>
				  <th>{{ __('adminstaticword.DiscountType') }}</th>
				  <th>{{ __('adminstaticword.Amount') }}</th>
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
function couponTotal(id,name,image,status)
{
	(function($){
	$(document).ready(function () {
		table = $('#coupons_details').DataTable( {
			destroy: true,
		});
		table.destroy();
		
        $('#coupons_details').DataTable({
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
                     "url": "{{ route('get-total-coupons-details') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function ( d ) {
								d._token = "{{csrf_token()}}";
								d.userId = id;
								d.status = status;
							}
                   },
            "columns": [
                { "data": "id" },
                { "data": "code" },
				{ "data": "name" },
				{ "data": "limit" },
				{ "data": "type" },
				{ "data": "amount" },
				{ "data": "created_at" },
            ]
        });
		
		$.get("{{URL::to('/')}}" + '/images/user_img/' + image)
			.done(function() { 
				$('.img-circle').attr('src','/images/user_img/' + image);
			}).fail(function() { 
				$('.img-circle').attr('src','/images/user_img/general.png');
		});
		$('#coupons_details_modal_name').html(name);
		$('#coupons_details_modal_type').html("{{ __('adminstaticword.coupons')}}");
		$('.widget-user-header').attr('id','bg-color-student');
		$('#coupons_details_modal').modal('show');
    });
	})(jQuery);
}
</script>