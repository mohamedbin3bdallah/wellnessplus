@extends("admin/layouts.master")
@section('title', __('adminstaticword.countries'))
@section("body")

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary" >
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.countries') }}</h3>
          <a href=" {{url('admins/country/create')}} " class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add').' '.__('adminstaticword.Country') }}</a>
        </div>


        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-responsive">

              <thead>
                <tr class="table-heading-row">
                  <th>#</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('dashboard.iso_code_num', ['num'=>2]) }}</th>
                  <th>{{ __('dashboard.iso_code_num', ['num'=>3]) }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach ($countries as $country)

                  <tr>
                    <?php $i++;?>
                    <td><?php echo $i;?></td>
                    <td>{{ $country->nicename }}</td>
                    <td>{{ $country->iso }}</td>
                    <td>{{ $country->iso3 }}</td>
                    <td>
                      <a class="btn btn-success btn-sm" href="{{url('admins/country/'.$country->id. '/edit')}}">

                        <i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                    <td><form  method="post" action="{{url('admins/country/'.$country->id)}}
                        "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                         <button  type="submit" class="btn btn-danger" onclick="return confirm('Delete This User..?)" ><i class="fa fa-fw fa-trash-o"></i></button></td>
                        </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>
@endsection



