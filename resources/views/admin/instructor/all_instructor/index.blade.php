@extends('admin/layouts.master')
@section('title', __('adminstaticword.AllTutors'))
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.AllTutors') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
{{--                    <th>{{ __('lookups.'.$speciality->slug_lang_name) }}</th>--}}

                    <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
				  <th>{{ __('frontstaticword.CountryOfResidence') }}</th>
                    <th>{{ __('adminstaticword.PricePerHour') }}</th>
                  <th>{{ __('adminstaticword.Detail') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
				  @if(Auth::user()->role == 'admin')
					<th>{{ __('adminstaticword.View') }}</th>
					<th>{{ __('adminstaticword.Delete') }}</th>
				  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)

                <tr>
                	<td><img src="{{ asset('images/user_img/'.$item->user_img)}}" class="img-responsive"></td>
                  <td>{{$item->fname}} {{$item->lname}}</td>
                  <td>{{$item->email}}</td>
				  <td>@if(isset($item->user->country_residence->name)) {{$item->user->country_residence->name}} @endif</td>
                    <td>{{$item->PricePerHour}}</td>
                  <td>{{ str_limit($item->detail, $limit= 50, $end = '...')}}</td>
                  <td>
                    @if($item->status==1)
                      {{ __('adminstaticword.Approved') }}
                    @else
                      {{ __('adminstaticword.Pending') }}
                    @endif
                  </td>
                  @if(Auth::user()->role == 'admin')
				  <td><a class="btn btn-primary btn-sm" href="{{url('requestinstructor/edit/allInstrutors/'.$item->id)}}">{{ __('adminstaticword.View') }}</a></td>

                  <td><form  method="post" action="{{url('requestinstructor/'.$item->id)}}
                        "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                         <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                      </form>
                  </td>
				  @endif

                </tr>
                @endforeach

              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection
