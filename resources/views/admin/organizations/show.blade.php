@extends('admin.layouts.master')
@section('title', 'Packages - Admin')
@section('body')
        @include('admin.message')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Packages</h1>
                    </div>
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tax" aria-hidden="true"></i> Packages</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">

                                    @include('admin.packages.index')
                                </div>
                                <div role="tabpanel" class="fade tab-pane" id="profile">

                                    @include('admin.packages.index')
                                </div>
                                <div role="tabpanel" class="fade tab-pane" id="admin">

                                    @include('admin.packages.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
