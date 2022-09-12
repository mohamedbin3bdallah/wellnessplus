@extends('admin/layouts.master')
@section('title', __('adminstaticword.filter_log'))
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.filter_log') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>{{ __('adminstaticword.ID') }}</th>
                  <th>{{ __('adminstaticword.Country') }}</th>
                  <th>{{ __('adminstaticword.Specialties') }}</th>
                  <th>{{ __('adminstaticword.Price_from') }}</th>
                  <th>{{ __('adminstaticword.Price_to') }}</th>
                  <th>{{ __('adminstaticword.Lanugages') }}</th>
                  <th>{{ __('adminstaticword.Search_words') }}</th>
                  <th>{{ __('adminstaticword.User_id') }}</th>
                  <th>{{ __('adminstaticword.Times') }}</th>
                  <th>{{ __('adminstaticword.Days') }}</th>
                  <th>{{ __('adminstaticword.Native_speaker') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  @php
                    if($item->country != "null" ){
                      $countries = \App\Allcountry::whereIn('id' , json_decode($item->country , true))->pluck('name');
                      $countries = json_encode($countries);
                    }else{
                      $countries = "";
                    }
                  @endphp
                	<td>{{$countries}}</td>
                  @php
                    if($item->specialties != "null" ){
                      $specialties = \App\Specialties::whereIn('id' , json_decode($item->specialties , true))->pluck('specialty');
                      $specialties = json_encode($specialties);
                    }else{
                      $specialties = "";
                    }
                  @endphp
                  <td>{{$specialties}}</td>
                  <td>{{$item->from}}</td>
                  <td>{{$item->to}}</td>
                  @php
                    if($item->language != "null" ){
                      $language = \App\AllLanguages::whereIn('id' , json_decode($item->language , true))->pluck('isoName');
                      $language = json_encode($language);
                    }else{
                      $language = "";
                    }
                  @endphp

                  <td>{{$language}}</td>
                  <td>{{$item->search_words}}</td>
                  <td>{{$item->user_id}}</td>
                  <td>{{($item->times != "null") ? $item->times : ""}}</td>
                  <td>{{($item->days != "null") ? $item->days : ""}}</td>
                  <td>{{$item->native_speaker}}</td>
                  

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
