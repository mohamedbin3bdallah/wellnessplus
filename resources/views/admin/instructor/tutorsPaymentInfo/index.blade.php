@extends('admin/layouts.master')
@section('title', __('adminstaticword.tutorsPaymentInfo'))
@section('body')

    <section class="content">
        @include('admin.message')
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('adminstaticword.tutorsPaymentInfo') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('adminstaticword.Image') }}</th>
                                    <th>{{ __('adminstaticword.Name') }}</th>
                                    <th>{{ __('adminstaticword.AccountName') }}</th>
                                    <th>{{ __('adminstaticword.AccountNumber') }}</th>
                                    <th>{{ __('adminstaticword.Iban') }}</th>
                                    <th>{{ __('adminstaticword.CreatedAt') }}</th>
{{--                                    <th>{{ __('adminstaticword.Delete') }}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tutorsPaymentInfo as $item)

                                    <tr>
                                        <td><img src="{{ asset('images/user_img/'.$item->user_img)}}" class="img-responsive"></td>
                                        <td>{{$item->fname}} {{$item->lname}}</td>
                                        <td>{{$item->account_name}}</td>
                                        <td>{{$item->account_number}}</td>
                                        <td>{{$item->iban}}</td>
                                        <td>{{$item->created_at}}</td>

{{--                                        <td><form  method="post" action="{{url('requestinstructor/'.$item->id)}}--}}
{{--                                                "data-parsley-validate class="form-horizontal form-label-left">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}

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
