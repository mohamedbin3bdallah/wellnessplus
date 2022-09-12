@extends('admin.layouts.master')
@section('title', 'View User - Admin')
@section('body')

<script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Users') }}</h3>
          <a class="btn btn-info btn-sm" href="{{ route('user.add') }}">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.User') }}</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              @if(Auth::user()->role == 'partner') <table id="partnertable" class="table table-bordered table-striped table-responsive display nowrap">
			  @else <table id="admintable" class="table table-bordered table-striped table-responsive display nowrap">
			  @endif
				@if(Auth::user()->role == 'admin')
				<div class="col-md-12">
					<label for="role">{{ __('adminstaticword.SelectRole') }}</label>
					<select class="form-control js-example-basic-single" name="role" id="role" required>
						<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
						<option value="user">{{ __('adminstaticword.User') }}</option>
						<option value="partner">{{ __('adminstaticword.Partner') }}</option>
						<option value="admin">{{ __('adminstaticword.Admin') }}</option>
						<option value="instructor">{{ __('adminstaticword.Tutor') }}</option>
					</select>
				</div>
				@endif
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.FirstName') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.paidpackages') }}</th>@endif
                  <th>{{ __('adminstaticword.Role') }}</th>
                  <th>{{ __('adminstaticword.instructorStatus') }}</th>
                  <th>{{ __('adminstaticword.Mobile') }}</th>
                  <th>{{ __('adminstaticword.Country') }}</th>
                  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.actions') }}</th>@endif
                </thead>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
		
		
		<!-- /.box-header -->
        <!--<div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.FirstName') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.paidpackages') }}</th>@endif
                  <th>{{ __('adminstaticword.Role') }}</th>
                  <th>{{ __('adminstaticword.instructorStatus') }}</th>
                  <th>{{ __('adminstaticword.Mobile') }}</th>
                  <th>{{ __('adminstaticword.Country') }}</th>
                  <th>{{ __('adminstaticword.CreatedAt') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
				  @if(Auth::user()->role == 'partner')<th>{{ __('adminstaticword.actions') }}</th>@endif
                </thead>

                <tbody>
                  <?php $i=0;?>

                    @foreach ($users as $user)
                      @if($user->id != Auth::User()->id)
                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($user->user_img != null || $user->user_img !='')
                            <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-responsive">
                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif
                        </td>
                        <td>{{ $user['fname'] }}</td>
                        <td>{{ $user['email'] }}</td>
						@if(Auth::user()->role == 'partner')
							<td>
							@if($user->studentpackage->where('paid',1)->count())
								@foreach($user->studentpackage->where('paid',1) as $key => $studentpackage)
									@if($studentpackage->package->organization_flag == 1)
									{{($key+1).'-'.$studentpackage->package->name}}
									<br>
									@endif
								@endforeach
							@endif
							</td>
						@endif
                          @if($user['role'] == 'instructor')
                        <td>Tutor</td>
                          @elseif($user['role'] == 'admin')
                              <td>Admin</td>
						  @elseif($user['role'] == 'partner')
                              <td>{{ __('adminstaticword.Partner') }}</td>
                          @elseif($user['role'] == 'user')
                              <td>Student</td>
                          @endif
                          <td>
                              @if(isset($user->instructor->status))
                                  @if($user->instructor->status == 1)
                                      Approved
                                  @else
                                      Pending
                                  @endif
                              @endif
                          </td>

                        <td>
                          {{$user->mobile}}
                        </td>


                          @if(isset($user->country['name']))
                        <td>{{  $user->country['name']  }}</td>
                          @else
                        <td></td>
                          @endif
                          <td>{{$user->created_at}}</td>
                              <td>
                          <form action="{{ route('user.quick',$user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $user->status ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($user->status ==1)
                              {{ __('adminstaticword.Active') }}
                              @else
                              {{ __('adminstaticword.Deactive') }}
                              @endif
                            </button>
                          </form>
                        </td>

                        <td>
                          <a class="btn btn-success btn-sm" href="{{ route('user.update',$user->id) }}">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>

                        <td><form  method="post" action="{{ route('user.delete',$user->id) }}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                              <button onclick="return confirm('Are you sure you want to delete?')"  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                            </form>
                        </td>
						@if(Auth::user()->role == 'partner')<td>
							@php
								$count = 0;
							@endphp
							@if($user->studentpackage->where('paid',0)->count())
								@foreach($user->studentpackage->where('paid',0) as $studentpackage)
									@if($studentpackage->package->organization_flag == 1)
									<button type="button" class="btn btn-xs btn-danger" style="margin:5px;" id="buypackage{{$studentpackage->id}}">{{ __('adminstaticword.buypackage') }}</button>
									@php
										$count = $count + 1;
										$cartRecord = App\Cart::where(['student_package_id'=>$studentpackage->id])->first();
										
										$transaction_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
										$transaction_fees = number_format(($transaction_fees )  , 2, '.', '');
    
										$bank_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
										$bank_fees = number_format(($bank_fees )  , 2, '.', '');
										//print_r($cartRecord->user_id);
									@endphp
<script type="text/javascript">
$(document).ready(function () {
	$("#buypackage{{$studentpackage->id}}").on("click", function(){
	  makePayment();
	});


     function makePayment() {
					FlutterwaveCheckout({
						public_key: "FLWPUBK-57156c676689b10f896d808c533c33c4-X",
						tx_ref: "{{ base64_encode($cartRecord->id.'-'.$cartRecord->appointment_id.'-'.$cartRecord->user_id.'-'.$studentpackage->tutor_id.'-'.$studentpackage->package_id) }}",
						amount: "{{ $cartRecord->offer_price - $cartRecord->disamount + $transaction_fees - $bank_fees}}",
						currency: "USD",
						country: "US",
						payment_options: " ",
						redirect_url:"https://www.arabie.live/flutterwave/payment/2",
						meta: {
							consumer_id: "{{$user->id}}",
							consumer_mac: "92a3-912ba-1192a",
						},
						customer: {
							email: "{{$user->email}}",
							phone_number: "{{$user->mobile}}",
							name: "{{$user->fname}} {{$user->lname}}",
						},
						callback: function (data) {
							console.log(data);
						},
						onclose: function() {
							// close modal
						},
						customizations: {
							title: "Arabie",
							description: "Payment for items in cart",
							logo: "https://arabie.live/images/logo/logo.png",
						},
					});
	}
});
</script>
									@endif
								@endforeach
							@endif
							
							@if(!$count)<button type="button" class="btn btn-xs btn-success" style="margin:5px;" data-toggle="modal" data-target="#addpackage{{$user->id}}">{{ __('adminstaticword.addpackage') }}</button>@endif
							<div class="modal fade" id="addpackage{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="/partner/addpackage" method="post">
										{{csrf_field()}}
										<input type="hidden" name="user_id" value="{{$user->id}}" />
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">{{ __('adminstaticword.addpackage') }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-6">
													<label for="tutor">{{ __('adminstaticword.Tutors') }}: <sup class="redstar">*</sup></label>
													<br>
													<select class="form-control js-example-basic-single" name="tutor_id" required>
														<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
														@foreach ($tutors as $tutor)
															<option value="{{ $tutor->id }}" >{{ $tutor->user->fname.' '.$tutor->user->lname }}</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-6">
													<label for="package">{{ __('adminstaticword.packages') }}: <sup class="redstar">*</sup></label>
													<br>
													<select class="form-control js-example-basic-single" name="package_id" required>
														<option value="none" selected disabled hidden>{{ __('adminstaticword.SelectanOption') }}</option>
														@foreach ($packages as $package)
															<option value="{{ $package->id }}" >{{ $package->name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-success">{{ __('adminstaticword.addpackage') }}</button>
										</div>
										</form>
									</div>
								</div>
							</div>
                        </td>@endif
                    </tr>
                    @endif
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>-->
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection