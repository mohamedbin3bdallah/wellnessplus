<div id="tutor_detail_modal" class="modal fade" role="dialog">
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
						<h3 class="widget-user-username text-center" id="tutor_detail_modal_name"></h3>
						<h5 class="widget-user-desc text-center" id="tutor_detail_modal_type"></h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" src="" alt="User Avatar">
					</div>
				</div>
				<!-- /.widget-user -->
            </div>
            <div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table-responsive display nowrap">
						<thead>
							<th width="15%"></th>
							<th width="85%"></th>
						</thead>
						<tbody>
							<tr class="tutor-detail-tr">
								<th>{{ __('frontstaticword.headLine') }}</th>
								<td id="headline"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('frontstaticword.Detail') }}</th>
								<td id="detail"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('adminstaticword.Resume') }}</th>
								<td id="file"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('adminstaticword.Video') }}</th>
								<td id="video"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('adminstaticword.schedule') }}</th>
								<td id="schedule"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('adminstaticword.education') }}</th>
								<td id="education"></td>
							</tr>
							<tr class="tutor-detail-tr">
								<th>{{ __('adminstaticword.certificate') }}</th>
								<td id="certificate"></td>
							</tr>
							<tr>
								<th>{{ __('adminstaticword.work_experience') }}</th>
								<td id="work"></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
            <div class="modal-footer">
			</div>
        </div>
	</div>
</div>

<script>
function showDetail(id,name,type,image)
{
	(function($){
	$(document).ready(function () {
		//$('.modal-body').html('');
		$.ajax({
          type:"POST",
          url: "{{ route('get.detail.tutors.users') }}",
          data: {
			  _token: "{{csrf_token()}}",
			  id: id
		  },
          success:function(response){
            //console.log(response);
			var response_data = JSON.parse(response);
			if(response_data.status) {
				$('.modal-body').removeClass('text-center');
				$.each(response_data.data, function(key, value) {
					$('#'+key).html(value);
				});
			} else {
				$('.modal-body').addClass('text-center');
				$('.modal-body').html(response_data.message);
			}
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            //console.log(XMLHttpRequest);
          }
        });
		
		if(image)
		{
			$.get("{{URL::to('/')}}" + '/images/user_img/' + image)
				.done(function() { 
					$('.img-circle').attr('src','/images/user_img/' + image);
				}).fail(function() { 
					$('.img-circle').attr('src','/images/user_img/general.png');
			});
		}
		else $('.img-circle').attr('src','/images/user_img/general.png');
		
		$('#tutor_detail_modal_name').html(name);
		$('#tutor_detail_modal_type').html(type.charAt(0).toUpperCase() + type.slice(1) + " {{ __('adminstaticword.Detail')}}");
		$('.widget-user-header').attr('id','bg-color-' + type);
		$('#tutor_detail_modal').modal('show');
    });
	})(jQuery);
}
</script>