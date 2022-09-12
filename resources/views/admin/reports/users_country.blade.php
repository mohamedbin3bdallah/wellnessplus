@extends('admin.layouts.master')
@section('title', __('adminstaticword.Users').' '.__('adminstaticword.Country'))
@section('body')

<script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Users').' '.__('adminstaticword.Country') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
			<form method="get" action="/report/users_country">
				<div class="row">
					<div class="col-md-4">
						<label for="role">{{ __('adminstaticword.SelectRole') }}</label>
						<select class="form-control js-example-basic-single" name="role">
							<option value="none" selected disabled hidden>{{ __('adminstaticword.all') }}</option>
							<option value="user">{{ __('adminstaticword.User') }}</option>
							<option value="instructor">{{ __('adminstaticword.Tutor') }}</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="country">{{ __('adminstaticword.Country') }}</label>
						<select class="form-control js-example-basic-single" name="country">
							<option value="none" selected disabled hidden>{{ __('adminstaticword.all') }}</option>
							@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label for="date">{{ __('adminstaticword.registrationDate') }}</label>
						<input type="date" class="form-control" name="date" />
					</div>
				<div class="row">
				</div>
					<div class="col-md-4">
						<input type="submit" class="btn btn-md btn-primary" />
					</div>
				</div>
			</form>
			
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Country') }}</th>
                  <th>{{ __('adminstaticword.count') }}</th>
                </thead>
				<tbody>
				  @foreach ($result as $key => $record)
				  <tr>
					<td>{{$key+1}}</td>
					<td>{{$record->name}}</td>
					<td>{{$record->count}}</td>
				  </tr>
				  @endforeach
				</tbody>
              </table>
			  
			  <!-- Bar chart -->
			  <div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-bar-chart-o"></i>
					<h3 class="box-title"></h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div id="bar-chart" style="height: 300px;"></div>
				</div>
				<!-- /.box-body-->
			  </div>
			  <!-- /.box -->
		  
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<style>
.flot-x-axis .flot-tick-label {
    white-space: nowrap;
    transform: translate(-15px, 0) rotate(-90deg);
    text-indent: -1100%;
    transform-origin: top right;
    text-align: right !important;
}
</style>

<script src="{{url('admin/bower_components/Flot/jquery.flot.js')}}"></script>
<!--<script src="{{url('admin/bower_components/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{url('admin/bower_components/Flot/jquery.flot.pie.js')}}"></script>-->
<script src="{{url('admin/bower_components/Flot/jquery.flot.categories.js')}}"></script>
<script>
  //$(function () {
    /*
     * BAR CHART
     * ---------
     */
    var bar_data = {
      data : [
		@foreach ($result as $key => $record)
			['{{$record->name}}','{{$record->count}}'],
		@endforeach
		],
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          //show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */
  //})
</script>
@endsection