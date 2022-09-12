@extends("admin/layouts.master")
@section('title',__('adminstaticword.tutorPackages'))

@section('body')
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.tutorPackages') }}</h3>
          <a href="{{ route('create.tutor.packages') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> {{ __('adminstaticword.addPackage') }} </a>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>

                <th>{{ __('adminstaticword.ID') }}</th>
                <th>{{ __('adminstaticword.Tutor') }}</th>
                <th>{{ __('adminstaticword.Name') }}</th>
				<th>{{ __('adminstaticword.title') }}</th>
				<th>{{ __('adminstaticword.about') }}</th>
                <th>{{ __('adminstaticword.Description') }}</th>
                <th>{{ __('adminstaticword.numOfHours') }}</th>
                <th>{{ __('adminstaticword.origenalPrice') }}</th>
                <th>{{ __('adminstaticword.discountPrice') }}</th>
                <th>{{ __('adminstaticword.pricePerHour') }}</th>
                <th>{{ __('adminstaticword.totalPrice') }}</th>
				<th>{{ __('adminstaticword.featured') }}</th>
				<th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </thead>

              <tbody>
                @foreach($data as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->tutor->user->fname.' '.$value->tutor->user->lname }}</td>
                    <td>{{ $value->name }}</td>
					<td>{{ $value->title }}</td>
					<td>{{ $value->about }}</td>
                    <!--<td>{!! $value->description !!}</td>-->
					<td>
					  <a data-toggle="modal" data-target="#details{{ $value->id }}" class="btn btn-info">{{ __('adminstaticword.details') }}</a>
					  <div id="details{{ $value->id }}" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
							  <h4 class="modal-heading">{{ $value->title }}</h4>
                            </div>
                            <div class="modal-body text-center">
							  <p>{!! $value->description !!}</p>
                            </div>
                            <div class="modal-footer">
                            </div>
                          </div>
                        </div>
					  </div>
					</td>
					<td>{{ $value->numOfHours }}</td>
					<td>{{ $value->origenalPrice }}</td>
					<td>{{ $value->discountPrice }}</td>
					<td>{{ $value->pricePerHour }}</td>
					<td>{{ $value->totalPrice }}</td>
					<td>
						@if($value->featured != 1)
							<form action="{{ route('change.tutor.packages') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}" /><input type="hidden" name="type" value="featured" /><span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span><input type="hidden" name="package" value="{{ $value->id }}" /><span class="text-danger">{{ $errors->has('package') ? $errors->first('package') : '' }}</span><input type="hidden" name="value" value="1" /><span class="text-danger">{{ $errors->has('value') ? $errors->first('value') : '' }}</span><button  type="Submit" class="btn btn-xs btn-danger">{{ __('adminstaticword.no') }}</button></form>
						@else
							<form action="{{ route('change.tutor.packages') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}" /><input type="hidden" name="type" value="featured" /><span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span><input type="hidden" name="package" value="{{ $value->id }}" /><span class="text-danger">{{ $errors->has('package') ? $errors->first('package') : '' }}</span><input type="hidden" name="value" value="0" /><span class="text-danger">{{ $errors->has('value') ? $errors->first('value') : '' }}</span><button  type="Submit" class="btn btn-xs btn-success">{{ __('adminstaticword.yes') }}</button></form>
						@endif
                    </td>
					<td>
						@if($value->status != 1)
							<form action="{{ route('change.tutor.packages') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}" /><input type="hidden" name="type" value="status" /><span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span><input type="hidden" name="package" value="{{ $value->id }}" /><span class="text-danger">{{ $errors->has('package') ? $errors->first('package') : '' }}</span><input type="hidden" name="value" value="1" /><span class="text-danger">{{ $errors->has('value') ? $errors->first('value') : '' }}</span><button  type="Submit" class="btn btn-xs btn-danger">{{ __('adminstaticword.notActive') }}</button></form>
						@else
							<form action="{{ route('change.tutor.packages') }}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}" /><input type="hidden" name="type" value="status" /><span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span><input type="hidden" name="package" value="{{ $value->id }}" /><span class="text-danger">{{ $errors->has('package') ? $errors->first('package') : '' }}</span><input type="hidden" name="value" value="0" /><span class="text-danger">{{ $errors->has('value') ? $errors->first('value') : '' }}</span><button  type="Submit" class="btn btn-xs btn-success">{{ __('adminstaticword.Active') }}</button></form>
						@endif
                    </td>
					<td>
                      <a href="{{ route('edit.tutor.packages',$value->id) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-pencil"></i>
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" data-target="#delete{{ $value->id }}" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                      </a>
					  <div id="delete{{ $value->id }}" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading">{{ __('dashboard.are_you_sure') }}</h4>
                              <p>{{ __('dashboard.delete_message') }}</p>
                            </div>
                            <div class="modal-footer">
                                 <form method="post" action="{{route('delete.tutor.packages',$value->id)}}" class="pull-right">
                                    {{csrf_field()}}
                                    {{method_field("DELETE")}}

                                 <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{ __('adminstaticword.no') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('adminstaticword.yes') }}</button>
                              </form>
                            </div>
                          </div>
                        </div>
					  </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
