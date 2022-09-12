@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.packages'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-xs-12">

            <div class="box-header">
                <a href="{{ action('PackagesController@create') }}" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                        <tr class="table-heading-row">
                            <th>#</th>
                            <th>{{ __('adminstaticword.Name') }}</th>
                            <th>{{ __('adminstaticword.numOfHours') }}</th>
                            <th>{{ __('adminstaticword.discountPerHour') }}</th>
							<th>{{ __('adminstaticword.organization_flag') }}</th>
                            <th>{{ __('adminstaticword.Status') }}</th>
                            <th>{{ __('adminstaticword.Edit') }}</th>
                            <th>{{ __('adminstaticword.Delete') }}</th>
                        </tr>
                        </thead>
                        @if ($packages)
                        <tbody>
                        @foreach ($packages as $key => $package)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>{{$package->name}}</td>
                            <td>{{$package->numOfHours}}</td>
                            <td>{{$package->discountPercentage}}</td>
							<td><input type="checkbox" @if($package->organization_flag == 1) {{ 'checked' }} @endif disabled/></td>
                            @if($package->active == 1)
                            <td>Active</td>
                            @else
                            <td>Not Active</td>
                            @endif
                            <td><a class="btn btn-success btn-sm" href="/admins/package/edit/{{$package->id}}">
                                    <i class="glyphicon glyphicon-pencil"></i></a></td>

                            <td><form method="post" action="/admins/package/delete/{{$package->id}}"
                                      data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection
