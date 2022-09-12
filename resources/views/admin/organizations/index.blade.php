@extends('admin/layouts.master')
@section('body')
@section("title", __('adminstaticword.organizations'))

<section class="content">
    @include('admin.message')
    <div class="row">
        <div class="col-xs-12">

            <div class="box-header">
                <a href="{{ action('OrganizationsController@create') }}" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                        <tr class="table-heading-row">
                            <th>#</th>
                            <th>{{ __('adminstaticword.Name') }}</th>
							<th>{{ __('adminstaticword.commission') }}</th>
                            <th>{{ __('adminstaticword.Status') }}</th>
                            <th>{{ __('adminstaticword.Edit') }}</th>
                            <th>{{ __('adminstaticword.Delete') }}</th>
                        </tr>
                        </thead>
                        @if ($organizations)
                        <tbody>
                        @foreach ($organizations as $key => $organization)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>{{$organization->name}}</td>
                            <td>{{$organization->commission}}</td>
							@if($organization->active == 1)
                            <td>{{ __('adminstaticword.Active') }}</td>
                            @else
                            <td>{{ __('adminstaticword.notActive') }}</td>
                            @endif
                            <td><a class="btn btn-success btn-sm" href="/admins/organization/edit/{{$organization->id}}">
                                    <i class="glyphicon glyphicon-pencil"></i></a></td>

                            <td><form method="post" action="/admins/organization/delete/{{$organization->id}}"
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
