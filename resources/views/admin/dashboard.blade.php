@extends('admin.layouts.master')
@section('title', __('adminstaticword.Dashboard'))
@section('body')
@if(Auth::User()->role == "admin")

@section('stylesheets')
<link rel="stylesheet" href="{{ url('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<link rel="stylesheet" href="{{ url('admin/bower_components/morris.js/morris.css') }}">
<style>
.box, .small-box
{
	border-radius: 35px 35px 0px 0px;
	box-shadow: 0 5px 9px 0 rgba(0, 0, 0, 0.2), 0 7px 21px 0 rgba(0, 0, 0, 0.19);
}
</style>
@endsection

<section class="content-header">
  <h1>
    {{ __('adminstaticword.Dashboard') }}
    <small>{{ $project_title }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('adminstaticword.Home') }}</a></li>
    <li class="active">{{ __('adminstaticword.Dashboard') }}</li>
  </ol>
</section>
<section class="content">
	<!-- Main row -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $allUsers->where('role', 'user')->count() }}</h3>
              <p>{{ __('adminstaticword.students') }}</p>
			  <hr>
			  <div class="row">
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.Active') }}: {{ $allUsers->where('role', 'user')->where('status', 1)->count() }}</h5>
				</div>
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.notActive') }}: {{ $allUsers->where('role', 'user')->where('status', 0)->count() }}</h5>
				</div>
			  </div>
            </div>
            <div class="icon">
              <i class="flaticon-user"></i>
            </div>
            <a href="{{route('user.index')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-green">--}}
{{--            <div class="inner">--}}
{{--              <h3>--}}
{{--              	@php--}}
{{--              		$cat = App\Categories::all();--}}
{{--              		if(count($cat)>0){--}}

{{--              			echo count($cat);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Categories') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--            	<i class="flaticon-layout"></i>--}}
{{--            </div>--}}
{{--            <a href="{{url('category')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-yellow">--}}
{{--            <div class="inner">--}}
{{--              <h3>--}}
{{--              	@php--}}
{{--              		$course = App\Course::all();--}}
{{--              		if(count($course)>0){--}}

{{--              			echo count($course);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Courses') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--              <i class="flaticon-book"></i>--}}
{{--            </div>--}}
{{--            <a href="{{url('course')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-red">--}}
{{--            <div class="inner">--}}
{{--              <h3>--}}
{{--              	@php--}}
{{--              		$page = App\Order::all();--}}
{{--              		if(count($page)>0){--}}

{{--              			echo count($page);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Orders') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--              <i class="flaticon-shopping-cart-1"></i>--}}
{{--            </div>--}}
{{--            <a href="{{url('order')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-purple">--}}
{{--            <div class="inner">--}}
{{--              <h3>--}}
{{--              	@php--}}
{{--              		$faq = App\FaqStudent::all();--}}
{{--              		if(count($faq)>0){--}}

{{--              			echo count($faq);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Faqs') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--              <i class="flaticon-faq"></i>--}}
{{--            </div>--}}
{{--            <a href="{{url('faq')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-orange">--}}
{{--            <div class="inner">--}}
{{--              <h3>@php--}}
{{--              		$review = App\Page::all();--}}
{{--              		if(count($review)>0){--}}

{{--              			echo count($review);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Pages') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--             <i class="flaticon-report"></i>--}}
{{--            </div>--}}
{{--            <a href="{{ url('page') }}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}
        <div class="col-lg-3 col-xs-6">
{{--          <!-- small box -->--}}
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $tutors->count() }}</h3>
              <p>{{ __('adminstaticword.Instructors') }}</p>
			  <hr>
			  <div class="row">
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.Approved') }}: {{ $tutors->where('status', 1)->count() }}</h5>
				</div>
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.Pending') }}: {{ $tutors->where('status', 0)->count() }}</h5>
				</div>
			  </div>
            </div>
            <div class="icon">
             <i class="flaticon-teacher"></i>
            </div>
            <a href="{{route('all.instructor')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


{{--        <!-- ./col -->--}}
{{--        <div class="col-lg-3 col-xs-6">--}}
{{--          <!-- small box -->--}}
{{--          <div class="small-box bg-blue">--}}
{{--            <div class="inner">--}}
{{--              <h3>--}}
{{--                @php--}}
{{--              		$review = App\Testimonial::all();--}}
{{--              		if(count($review)>0){--}}

{{--              			echo count($review);--}}
{{--              		}--}}
{{--              		else{--}}

{{--              			echo "0";--}}
{{--              		}--}}
{{--              	@endphp--}}
{{--              </h3>--}}
{{--              <p>{{ __('adminstaticword.Testimonials') }}</p>--}}
{{--            </div>--}}
{{--            <div class="icon">--}}
{{--             <i class="flaticon-customer-1"></i>--}}
{{--            </div>--}}
{{--            <a href="{{url('testimonial')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- ./col -->--}}

		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $appointments->count() }}</h3>
              <p>{{ __('adminstaticword.appointments') }}</p>
			  <hr>
			  <div class="row">
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.paid') }}: {{ $appointments->where('payment_transaction_id', '!=', NULL)->count() }}</h5>
				</div>
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.not_paid') }}: {{ $appointments->where('payment_transaction_id', '=', NULL)->count() }}</h5>
				</div>
			  </div>			  
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <div class="small-box-footer" style="height:26px;"></div>
          </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $bigbluemeetings->count() }}</h3>
              <p>{{ __('adminstaticword.meetings') }}</p>
			  <hr>
			  <div class="row">
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.ended') }}: {{ $bigbluemeetings->where('is_ended', 1)->count() }}</h5>
				</div>
				<div class="col-lg-6 col-xs-6">
					<h5>{{ __('adminstaticword.not_ended') }}: {{ $bigbluemeetings->where('is_ended', 0)->count() }}</h5>
				</div>
			  </div>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('bbl.all.meeting')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
    </div>
    <!-- /.row -->
	
	<!-- Main row -->
	<div class="row">
		<div class="col-lg-4 col-xs-12">
		   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.students') }} - {{ __('adminstaticword.Gender') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="students_gender" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="students_gender_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-4 col-xs-12">
		   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.students') }} - {{ __('adminstaticword.verification') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="students_verify" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="students_verify_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-4 col-xs-12">
		   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.students') }} - {{ __('adminstaticword.organization') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="students_organization" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="students_organization_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
	
	<!-- Main row -->
	<div class="row">
		<div class="col-lg-3 col-xs-12">
		   <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.Gender') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="tutors_gender" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="tutors_gender_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		   <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.verification') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="tutors_verify" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="tutors_verify_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		   <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.Status') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="tutors_status" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="tutors_status_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		   <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.recommendation') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="tutors_recommendation" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul id="tutors_recommendation_labels" class="chart-legend clearfix">
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
	
	<!-- Main row -->
	<div class="row">
		<div class="col-lg-3 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('frontstaticword.PreferredStudentAge') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="tutors_preferredStudentAge" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('frontstaticword.preferredStudentLevel') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="tutors_preferredStudentLevel" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.specialty') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="tutors_specialty" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-3 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.organization') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="tutors_organization" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
	
	<!-- Main row -->
	<div class="row">
		<div class="col-lg-6 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.appointments') }} - {{ __('adminstaticword.Status') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="appointments_status_chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		
		<div class="col-lg-6 col-xs-12">
		 <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.meetings') }} - {{ __('adminstaticword.Status') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="meetings_status_chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
	
	<!-- Main row -->
	<div class="row">
		<div class="col-lg-6 col-xs-12">
		   <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.students') }} - {{ __('adminstaticword.Country') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart-responsive">
                    <div id="stuednts-country" style="height: 400px"></div>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
		   </div>
		</div>
		
		<div class="col-lg-6 col-xs-12">
		   <div class="box box-success">
			<div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.Tutors') }} - {{ __('adminstaticword.Country') }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart-responsive">
                    <div id="tutors-country" style="height: 400px"></div>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
		   </div>
		</div>
	</div>
	<!-- /.row -->

	<!-- Main row -->
	<div class="row">
		<!-- Left col -->
    <div class="col-md-6">
      <!-- USERS LIST -->
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('adminstaticword.LatestUsers') }}</h3>

            <div class="box-tools pull-right">
              <span class="label label-danger">
                {{ $allUsers->count().' '.__('adminstaticword.Users') }}
			  </span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            @php
              $users = App\User::limit(8)->orderBy('id', 'DESC')->get();
            @endphp
            <ul class="users-list clearfix">
              @foreach($users as $user)
              <li>
                @if(($user['user_img'] != null || $user['user_img'] !='') && file_exists(public_path('/images/user_img/'.$user['user_img'])))
                  <img src="{{ asset('/images/user_img/'.$user['user_img']) }}" class="img-fluid" alt="User Image">
                @else
                  <img src="{{ asset('images/user_img/general.png')}}" class="img-fluid" alt="User Image">
                @endif
                <a class="users-list-name" href="{{'user/edit/'.$user['id']}}">{{ $user['fname'] }} {{ $user['lname'] }}</a>
                <span class="users-list-date">{{ date('d F Y', strtotime($user['created_at'])) }}</span>
              </li>
              @endforeach

            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{route('user.index')}}" class="uppercase">{{ __('adminstaticword.ViewAll') }}</a>
          </div>
          <!-- /.box-footer -->
      </div>
      <!--/.box -->
	  </div>
	  
	  <div class="col-md-6">
	  <!-- Instructor box -->
      @php
        $instructors = App\Instructor::with('user')->limit(3)->orderBy('id', 'DESC')->get();
      @endphp
      @if( !$instructors->isEmpty() )
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">{{ __('adminstaticword.TutorsRequest') }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chat" id="chat-box">
          <!-- chat item -->

          @foreach($instructors as $instructor)

          @if($instructor->status == 0)
            <div class="item">
              @if(isset($instructor->user->user_img) && ($instructor->user->user_img != null || $instructor->user->user_img != '') && file_exists(public_path('/images/user_img/'.$instructor->user->user_img)))
				<img src="{{ asset('images/user_img/'.$instructor->user->user_img)}}" class="online" alt="User Image">
			  @else
                <img src="{{ asset('images/user_img/general.png')}}" class="online" alt="User Image">
              @endif
              <p class="message">
                <a href="{{'user/edit/'.$instructor->user->id}}" class="name">
                    @if(isset($instructor->created_at))
                    <small class="text-muted pull-right"><i class="fa fa-calendar-check-o"></i>&nbsp;{{ date('jS F Y', strtotime($instructor->created_at)) }}</small>
                    @endif
                        @if(isset($instructor->user->fname))
                        {{ $instructor->user->fname }}&nbsp;{{ $instructor->user->lname }}
                        @endif
                </a>
              </p>
              <div class="attachment">
                <p class="filename" style="float:left;">
                    @if(isset($instructor['file']))
                    <a href="{{ asset('files/instructor/'.$instructor['file']) }}" download="{{$instructor['file']}}">{{ __('adminstaticword.Download').' '.__('adminstaticword.Resume') }} <i class="fa fa-download"></i></a>
                    @endif
                </p>

                <div class="pull-right">
                    @if(isset($instructor['id']))
					<a href="{{route('requestinstructor.edit',$instructor['id'])}}">{{ __('adminstaticword.ViewDetails') }}</a>
                    @endif
                </div>
              </div>
              <!-- /.attachment -->
            </div>
          @endif
          @endforeach
          <!-- /.item -->
        </div>
        <!-- /.chat -->
        <div class="box-footer text-center">
          <a href="{{route('all.instructor')}}" class="btn btn-sm bg-navy btn-flat pull-left">{{ __('adminstaticword.AllTutors') }}</a>
          <a href="{{url('requestinstructor')}}" class="btn btn-sm btn-default btn-flat pull-right">{{ __('adminstaticword.ViewAllTutorsRequest') }}</a>
        </div>
      </div>
      @endif
      <!-- /.box (Instructor box) -->
	  </div>

{{--        <!-- PRODUCT LIST -->--}}
{{--      @php--}}
{{--        $courses = App\Course::limit(5)->orderBy('id', 'DESC')->get()--}}
{{--      @endphp--}}
{{--      @if(!$courses->isEmpty())--}}
{{--      <div class="box box-primary">--}}
{{--          <div class="box-header with-border">--}}
{{--            <h3 class="box-title">{{ __('adminstaticword.RecentCourses') }}</h3>--}}

{{--            <div class="box-tools pull-right">--}}
{{--              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
{{--              </button>--}}
{{--              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <!-- /.box-header -->--}}
{{--          <div class="box-body">--}}
{{--            <ul class="products-list product-list-in-box">--}}

{{--              @foreach($courses as $course)--}}
{{--              <li class="item">--}}
{{--                <div class="product-img">--}}
{{--                  @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')--}}
{{--                    <img src="images/course/<?php echo $course['preview_image'];  ?>" alt="Course Image">--}}
{{--                  @else--}}
{{--                    <img src="{{ Avatar::create($course->title)->toBase64() }}" alt="Course Image">--}}
{{--                  @endif--}}

{{--                </div>--}}
{{--                <div class="product-info">--}}
{{--                  <a href="javascript:void(0)" class="product-title">{{ str_limit($course['title'], $limit = 25, $end = '...') }}--}}
{{--                  <span class="label label-warning pull-right">--}}
{{--                    @if( $course->type == 1)--}}
{{--                      @php--}}
{{--                          $currency2 = App\Currency::first();--}}
{{--                      @endphp--}}
{{--                      @if($course->discount_price == !NULL)--}}
{{--                        <i class="{{ $currency2['icon'] }}"></i>{{ $course['discount_price'] }}--}}
{{--                      @else--}}
{{--                        <i class="{{ $currency2['icon'] }}"></i>{{ $course['price'] }}--}}
{{--                      @endif--}}
{{--                    @else--}}
{{--                      {{ __('adminstaticword.Free') }}--}}
{{--                    @endif--}}
{{--                </span></a>--}}

{{--                  <span class="product-description">--}}
{{--                      {{ str_limit($course->short_detail, $limit = 40, $end = '...') }}--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--              </li>--}}
{{--              @endforeach--}}
{{--            </ul>--}}
{{--          </div>--}}
{{--          <!-- /.box-body -->--}}
{{--          <div class="box-footer text-center">--}}
{{--            <a href="{{url('course')}}" class="uppercase">{{ __('adminstaticword.ViewAll') }}</a>--}}
{{--          </div>--}}
{{--          <!-- /.box-footer -->--}}
{{--      </div>--}}
{{--      @endif--}}
{{--      <!-- /.box -->--}}
{{--    </div>--}}
    <!-- /.col -->
		<div class="col-md-8">
		  <!-- TABLE: LATEST ORDERS -->
      @php
        $orders = App\Order::limit(7)->orderBy('id', 'DESC')->get();
      @endphp
      @if( !$orders->isEmpty() )
			<div class="box box-info">
			    <div class="box-header with-border">
			      <h3 class="box-title">{{ __('adminstaticword.LatestOrders') }}</h3>

			      <div class="box-tools pull-right">
			        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			        </button>
			        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			      </div>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="table-responsive">
			        <table class="table no-margin">
			          <thead>
			          <tr>
			            <th>{{ __('adminstaticword.User') }}</th>
			            <th>{{ __('adminstaticword.Course') }}</th>
			            <th>{{ __('adminstaticword.Amount') }}</th>
			            <th>{{ __('adminstaticword.Date') }}</th>
                  <th>{{ __('adminstaticword.Invoice') }}</th>
			          </tr>
			          </thead>
			          <tbody>
                  @php
                    $orders = App\Order::limit(7)->orderBy('id', 'DESC')->get();
                  @endphp
                  @foreach($orders as $order)
    			          <tr>
    			            <td><a href="#">{{ $order->user['fname'] }}</a></td>
    			            <td>
                        @if($order->course_id != NULL)
                          {{ $order->courses['title'] }}
                        @else
                          {{ $order->bundle['title'] }}
                        @endif
                      </td>
    			            <td>
                        @if($order->coupon_discount == !NULL)
                          <span class="label label-success"><i class="fa {{ $order['currency_icon'] }}"></i> {{ $order['total_amount'] - $order['coupon_discount'] }}</span>
                        @else
                          <span class="label label-success"><i class="fa {{ $order['currency_icon'] }}"></i> {{ $order['total_amount'] }}</span>
                        @endif
                      </td>
    			            <td>
    			              <div class="sparkbar" data-color="#00a65a" data-height="20">{{ date('jS F Y', strtotime($order['created_at'])) }}</div>
    			            </td>
                      <td><a href="{{route('view.order',$order['id'])}}">{{ __('adminstaticword.Invoice') }}</a></td>
    			          </tr>
                  @endforeach
			          </tbody>
			        </table>
			      </div>
			      <!-- /.table-responsive -->
			    </div>
			    <!-- /.box-body -->
			    <div class="box-footer clearfix">
			      <a href="{{url('order')}}" class="btn btn-sm btn-default btn-flat pull-right">{{ __('adminstaticword.ViewAllOrders') }}</a>
			    </div>
			    <!-- /.box-footer -->
			</div>
      @endif

			<!-- /.box -->

		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>

@endif

@endsection

@section('scripts')
<script src="{{ url('admin/bower_components/chart.js/Chart.js') }}"></script>
<script src="{{ url('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('admin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('admin/bower_components/morris.js/morris.min.js') }}"></script>
<script>
(function($){
	var donut = new Morris.Donut({
		element: 'appointments_status_chart',
		resize: true,
		colors: ['#8800af', '#3c8dbc', '#15cbc7', '#00a65a', '#e5ed34', '#f39c12', '#f56954'],
		data: [
			@foreach($appointmentStatus as $app_id => $app_status)
				{label: '{{ $app_status }}', value: '{{ $appointments->where("status_id", $app_id)->count() }}'},
			@endforeach
		],
		hideHover: 'auto'
	});
	
	var donut = new Morris.Donut({
		element: 'meetings_status_chart',
		resize: true,
		colors: ['#00a65a', '#f39c12'],
		data: [
			{label: "{{ __('adminstaticword.disabled') }}", value: '{{ $bigbluemeetings->where("status", 0)->count() }}'},
			{label: "{{ __('adminstaticword.enabled') }}", value: '{{ $bigbluemeetings->where("status", 1)->count() }}'},
		],
		hideHover: 'auto'
	});
	
	// -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	studentsGender = [
		{'value':"{{ $allUsers->where('role', 'user')->where('gender', 'm')->count() }}", 'color':'#3c8dbc', 'highlight':'#3c8dbc', 'label':"{{ __('adminstaticword.Male') }}"},
		{'value':"{{ $allUsers->where('role', 'user')->where('gender', 'f')->count() }}", 'color':'#f56954', 'highlight':'#f56954', 'label':"{{ __('adminstaticword.Female') }}"},
		{'value':"{{ $allUsers->where('role', 'user')->where('gender', 'o')->count() }}", 'color':'#00a65a', 'highlight':'#00a65a', 'label':"{{ __('adminstaticword.Other') }}"},
		{'value':"{{ $allUsers->where('role', 'user')->where('gender', NULL)->count() }}", 'color':'#f39c12', 'highlight':'#f39c12', 'label':"{{ __('adminstaticword.not_specified') }}"},
	];
  
	var li = '';
	for (var res in studentsGender) {
		li += '<li><i class="fa fa-circle-o" style="color:'+studentsGender[res].color+';"></i> '+studentsGender[res].label+'</li>';
	}
	if(li) $('#students_gender_labels').html(li);
  
  var pieChartCanvasStudentsGender = $('#students_gender').get(0).getContext('2d');
  var students_gender       = new Chart(pieChartCanvasStudentsGender);
  var PieDataStudentsGender        = studentsGender;

  var pieOptionsStudentsGender     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  students_gender.Doughnut(PieDataStudentsGender, pieOptionsStudentsGender);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	studentsVerify = [
		{'value':"{{ $allUsers->where('role', 'user')->where('email_verified_at', '!=', NULL)->count() }}", 'color':'#3c8dbc', 'highlight':'#3c8dbc', 'label':"{{ __('adminstaticword.verified') }}"},
		{'value':"{{ $allUsers->where('role', 'user')->where('email_verified_at', NULL)->count() }}", 'color':'#f56954', 'highlight':'#f56954', 'label':"{{ __('adminstaticword.not_verified') }}"},
	];
  
	var li = '';
	for (var res in studentsVerify) {
		li += '<li><i class="fa fa-circle-o" style="color:'+studentsVerify[res].color+';"></i> '+studentsVerify[res].label+'</li>';
	}
	if(li) $('#students_verify_labels').html(li);
  
  var pieChartCanvasStudentsVerify = $('#students_verify').get(0).getContext('2d');
  var students_verify       = new Chart(pieChartCanvasStudentsVerify);
  var PieDataStudentsVerify        = studentsVerify;

  var pieOptionsStudentsVerify     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  students_verify.Doughnut(PieDataStudentsVerify, pieOptionsStudentsVerify);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
	org_colors = ['#00a65a', '#f39c12', '#8800af', '#3c8dbc', '#15cbc7', '#e5ed34', '#f56954'];
	studentsOrganization = [
		@foreach($organizations as $key => $organization)
				{'value':"{{ \App\User::wherehas('student', function($q) use ($organization) { $q->wherehas('user_organization', function($qq) use ($organization) { $qq->where('organization_id', $organization->id); }); })->count() }}", 'color':org_colors["{{$key}}"], 'highlight':org_colors["{{$key}}"], 'label':"{{ $organization->name }}"},
		@endforeach
	];
  
	var li = '';
	for (var res in studentsOrganization) {
		li += '<li><i class="fa fa-circle-o" style="color:'+studentsOrganization[res].color+';"></i> '+studentsOrganization[res].label+'</li>';
	}
	if(li) $('#students_organization_labels').html(li);
  
  var pieChartCanvasStudentsOrganization = $('#students_organization').get(0).getContext('2d');
  var students_organization       = new Chart(pieChartCanvasStudentsOrganization);
  var PieDataStudentsOrganization        = studentsOrganization;

  var pieOptionsStudentsOrganization     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  students_organization.Doughnut(PieDataStudentsOrganization, pieOptionsStudentsOrganization);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	tutorsGender = [
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'gender'=>'m']); })->count() }}", 'color':'#3c8dbc', 'highlight':'#3c8dbc', 'label':"{{ __('adminstaticword.Male') }}"},
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'gender'=>'f']); })->count() }}", 'color':'#f56954', 'highlight':'#f56954', 'label':"{{ __('adminstaticword.Female') }}"},
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'gender'=>'o']); })->count() }}", 'color':'#00a65a', 'highlight':'#00a65a', 'label':"{{ __('adminstaticword.Other') }}"},
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'gender'=>NULL]); })->count() }}", 'color':'#f39c12', 'highlight':'#f39c12', 'label':"{{ __('adminstaticword.not_specified') }}"},
	];
  
	var li = '';
	for (var res in tutorsGender) {
		li += '<li><i class="fa fa-circle-o" style="color:'+tutorsGender[res].color+';"></i> '+tutorsGender[res].label+'</li>';
	}
	if(li) $('#tutors_gender_labels').html(li);
  
  var pieChartCanvasTutorsGender = $('#tutors_gender').get(0).getContext('2d');
  var tutors_gender       = new Chart(pieChartCanvasTutorsGender);
  var PieDataTutorsGender        = tutorsGender;

  var pieOptionsTutorsGender     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  tutors_gender.Doughnut(PieDataTutorsGender, pieOptionsTutorsGender);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	tutorsVerify = [
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where('role', 'instructor')->where('email_verified_at', '!=', NULL); })->count() }}", 'color':'#3c8dbc', 'highlight':'#3c8dbc', 'label':"{{ __('adminstaticword.verified') }}"},
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where('role', 'instructor')->where('email_verified_at', NULL); })->count() }}", 'color':'#f56954', 'highlight':'#f56954', 'label':"{{ __('adminstaticword.not_verified') }}"},
	];
  
	var li = '';
	for (var res in tutorsVerify) {
		li += '<li><i class="fa fa-circle-o" style="color:'+tutorsVerify[res].color+';"></i> '+tutorsVerify[res].label+'</li>';
	}
	if(li) $('#tutors_verify_labels').html(li);
  
  var pieChartCanvasTutorsVerify = $('#tutors_verify').get(0).getContext('2d');
  var tutors_verify       = new Chart(pieChartCanvasTutorsVerify);
  var PieDataTutorsVerify        = tutorsVerify;

  var pieOptionsTutorsVerify     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  tutors_verify.Doughnut(PieDataTutorsVerify, pieOptionsTutorsVerify);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	tutorsStatus = [
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'status'=>1]); })->count() }}", 'color':'#00a65a', 'highlight':'#00a65a', 'label':"{{ __('adminstaticword.Active') }}"},
		{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where(['role'=>'instructor', 'status'=>0]); })->count() }}", 'color':'#f39c12', 'highlight':'#f39c12', 'label':"{{ __('adminstaticword.notActive') }}"},
	];
  
	var li = '';
	for (var res in tutorsStatus) {
		li += '<li><i class="fa fa-circle-o" style="color:'+tutorsStatus[res].color+';"></i> '+tutorsStatus[res].label+'</li>';
	}
	if(li) $('#tutors_status_labels').html(li);
  
  var pieChartCanvasTutorsStatus = $('#tutors_status').get(0).getContext('2d');
  var tutors_status       = new Chart(pieChartCanvasTutorsStatus);
  var PieDataTutorsStatus        = tutorsStatus;

  var pieOptionsTutorsStatus     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  tutors_status.Doughnut(PieDataTutorsStatus, pieOptionsTutorsStatus);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.	
	tutorsRecommendation = [
		{'value':"{{ $tutors->where('recommendation', 1)->count() }}", 'color':'#3c8dbc', 'highlight':'#3c8dbc', 'label':"{{ __('adminstaticword.recommended') }}"},
		{'value':"{{ $tutors->where('recommendation', 0)->count() }}", 'color':'#f56954', 'highlight':'#f56954', 'label':"{{ __('adminstaticword.notrecommended') }}"},
	];
  
	var li = '';
	for (var res in tutorsRecommendation) {
		li += '<li><i class="fa fa-circle-o" style="color:'+tutorsRecommendation[res].color+';"></i> '+tutorsRecommendation[res].label+'</li>';
	}
	if(li) $('#tutors_recommendation_labels').html(li);
  
  var pieChartCanvasTutorsRecommendation = $('#tutors_recommendation').get(0).getContext('2d');
  var tutors_recommendation       = new Chart(pieChartCanvasTutorsRecommendation);
  var PieDataTutorsRecommendation        = tutorsRecommendation;

  var pieOptionsTutorsRecommendation     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  tutors_recommendation.Doughnut(PieDataTutorsRecommendation, pieOptionsTutorsRecommendation);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
  var studentsCountryData = JSON.parse(JSON.stringify({!!$studentsCountryData!!}));
  //$('#stuednts-country').vectorMap({map: 'world_mill_en'});
  $('#stuednts-country').vectorMap({
	map: 'world_mill_en',
	backgroundColor: '#013c5e',
	series: {
    regions: [{
      values: studentsCountryData,
      scale: ['#C8EEFF', '#0071A4'],
      normalizeFunction: 'polynomial'
    }]
	},
	onRegionLabelShow: function(e, el, code){
	  if (typeof studentsCountryData[code] != 'undefined') el.html(el.html()+' ('+studentsCountryData[code]+')');
	  else el.html(el.html()+' (0)');
	}
  });
  
  var tutorsCountryData = JSON.parse(JSON.stringify({!!$tutorsCountryData!!}));
  //$('#tutors-country').vectorMap({map: 'world_mill_en'});
  $('#tutors-country').vectorMap({
	map: 'world_mill_en',
	backgroundColor: '#005830',
	series: {
    regions: [{
      values: tutorsCountryData,
      scale: ['#ccffe8', '#00a65a'],
      normalizeFunction: 'polynomial'
    }]
	},
	onRegionLabelShow: function(e, el, code){
	  if (typeof tutorsCountryData[code] != 'undefined') el.html(el.html()+' ('+tutorsCountryData[code]+')');
	  else el.html(el.html()+' (0)');
	}
  });
  
  var donut = new Morris.Donut({
		element: 'tutors_preferredStudentAge',
		resize: true,
		colors: ['#8800af', '#3c8dbc', '#15cbc7', '#00a65a', '#e5ed34', '#f39c12', '#f56954'],
		data: JSON.parse(JSON.stringify({!!$tutorsPreferredStudentAge!!})),
		hideHover: 'auto'
	});
	
	var donut = new Morris.Donut({
		element: 'tutors_preferredStudentLevel',
		resize: true,
		colors: ['#8800af', '#3c8dbc', '#15cbc7', '#00a65a', '#e5ed34', '#f39c12', '#f56954'],
		data: JSON.parse(JSON.stringify({!!$tutorsPreferredStudentLevel!!})),
		hideHover: 'auto'
	});
	
	var donut = new Morris.Donut({
		element: 'tutors_specialty',
		resize: true,
		colors: ['#8800af', '#3c8dbc', '#15cbc7', '#35e5f3', '#00a65a', '#36d137', '#e5ed34', '#f39c12', '#f56954', '#ef446f', '#A0522D'],
		data: JSON.parse(JSON.stringify({!!$tutorsSpecialty!!})),
		hideHover: 'auto'
	});
	
	var donut = new Morris.Donut({
		element: 'tutors_organization',
		resize: true,
		colors: ['#3c8dbc', '#f56954'],
		data: [
			@foreach($organizations as $key => $organization)
				{'value':"{{ \App\Instructor::wherehas('user', function($q) { $q->where('role', 'instructor'); })->wherehas('tutor', function($q) use ($organization) { $q->wherehas('user_organization', function($qq) use ($organization) { $qq->where('organization_id', $organization->id); }); })->count() }}", 'label':"{{ $organization->name }}"},
			@endforeach
		],
		hideHover: 'auto'
	});
})(jQuery);
</script>
@endsection