<form action="{{ route('seo.set') }}" method="POST">
	@csrf
	<div class="row">
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('meta_data_desc') ? ' has-error' : '' }}">
				<label for="">{{ __('adminstaticword.MetaDataDescription') }}:</label>
				<textarea placeholder="{{ __('adminstaticword.MetaDataDescription') }}" class="form-control" name="meta_data_desc" id="" cols="30" rows="10">{{ $setting->meta_data_desc }}</textarea>
				<small class="text-danger">{{ $errors->first('meta_data_desc',__('dashboard.required').' '.__('adminstaticword.MetaDataDescription')) }}</small>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('meta_data_keyword') ? ' has-error' : '' }}">
				<label for="">{{ __('adminstaticword.MetaDataKeywords') }}:</label>
				<textarea placeholder="{{ __('adminstaticword.MetaDataKeywords') }}" class="form-control" name="meta_data_keyword" id="" cols="30" rows="10">{{ $setting->meta_data_keyword }}
				</textarea>
				<small class="text-danger">{{ $errors->first('meta_data_keyword',__('dashboard.required').' '.__('adminstaticword.MetaDataKeywords')) }}</small>
			</div>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('google_ana') ? ' has-error' : '' }}">
				<label for="">{{ __('adminstaticword.GoogleAnalyticKey') }}:</label>
				<input type="text" class="form-control" placeholder="{{ __('adminstaticword.GoogleAnalyticKey') }}" name="google_ana" value="{{ $setting->google_ana }}">
				<small class="text-danger">{{ $errors->first('google_ana',__('dashboard.required').' '.__('adminstaticword.GoogleAnalyticKey')) }}</small>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('fb_pixel') ? ' has-error' : '' }}">
				<label for="">{{ __('adminstaticword.FacebookPixelCode') }}:</label>
				<input type="text" name="fb_pixel" class="form-control" placeholder="{{ __('adminstaticword.FacebookPixelCode') }}" value="{{ $setting->fb_pixel }}">
				<small class="text-danger">{{ $errors->first('fb_pixel',__('dashboard.required').' '.__('adminstaticword.FacebookPixelCode')) }}</small>
			</div>
		</div>
	</div>
	<br>

	<div class="box-footer">	
		<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i>{{ __('adminstaticword.Save') }}</button>
	</div>
	
</form>


