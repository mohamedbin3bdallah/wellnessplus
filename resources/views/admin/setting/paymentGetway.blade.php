<form action="{{ route('setting.payment.getway') }}" method="POST">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-12">
			
			<input type="radio" name="paymentGetway" value="1" @if($setting->payment_getway == 1) {{'checked'}} @endif><label>&nbsp;&nbsp;&nbsp;FlatterWave</label>
			<br>
			<input type="radio" name="paymentGetway" value="2" @if($setting->payment_getway == 2) {{'checked'}} @endif><label>&nbsp;&nbsp;&nbsp;MyFatoora</label>
			
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
            
			<br>

        </div>
	</div>
	<br>
	<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}</button>
</form>


