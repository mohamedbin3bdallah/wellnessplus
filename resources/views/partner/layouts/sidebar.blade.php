<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
          <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="img-circle" alt="User Image">

          @else
          <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="User Image">

          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::User()->fname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ __('adminstaticword.Online') }}</a>
        </div>
      </div>

      @if(Auth::User()->role == "partner")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">{{ __('adminstaticword.Navigation') }}</li>

          <li class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}"><a href="{{route('user.index')}}"><i class="flaticon-user" aria-hidden="true"></i><span>{{ __('adminstaticword.students') }}</span></a></li>
		  
		  <li class="{{ Nav::isRoute('all.instructor') }}"><a href="{{route('all.instructor')}}"><i class="flaticon-customer"></i>{{ __('adminstaticword.Tutors') }}</a></li>
		  
		  @if(isset($gsetting) && $gsetting->bbl_enable == 1)<li class="{{ Nav::isRoute('bbl.all.meeting') }}"><a href="{{ route('bbl.all.meeting') }}"><i class="flaticon-terms-and-conditions"></i>{{ __('dashboard.list').' '.__('dashboard.meetings') }}</a></li>@endif
        </ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>
