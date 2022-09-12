@extends("admin/layouts.master")
@section('title', __('adminstaticword.Add').' '.__('adminstaticword.Coupon'))

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
            {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Coupon') }}
      </div>
    </div>
    <form action="{{ route('coupon.store') }}" method="POST">
    @csrf
      <div class="box-body">
          <div class="form-group">
              <label>{{ __('adminstaticword.Name') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
              <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Description') }}: <span class="redstar">*</span></label>
              <input required="" type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
              <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
          </div>
          <div class="form-group">
            <label>{{ __('adminstaticword.CouponCode') }}: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
              <span class="text-danger">{{ $errors->has('code') ? $errors->first('code') : '' }}</span>

          </div>
          <div class="form-group">
            <label>{{ __('adminstaticword.DiscountType') }}: <span class="redstar">*</span></label>

              <select required="" name="distype" id="distype" class="form-control">

                <option value="fix">{{ __('adminstaticword.FixAmount') }}</option>
                <option value="per">% {{ __('adminstaticword.Percentage') }}</option>

              </select>

          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Status') }}: <span class="redstar">*</span></label>

              <select required="" name="status" id="status" class="form-control">

                  <option value="0">{{ __('adminstaticword.notActive') }}</option>
                  <option value="1">{{ __('adminstaticword.Active') }}</option>

              </select>

          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.Amount') }}: <span class="redstar">*</span></label>
              <input required="" type="text"  class="form-control" name="amount" value="{{old('amount')}}">
              <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>


          </div>
          <div class="form-group">
            <label>{{ __('adminstaticword.Linkedto') }}: <span class="redstar">*</span></label>

              <select required="" name="link_by" id="link_by" class="form-control js-example-basic-single">
                <option value="none" selected disabled hidden>
                   {{ __('adminstaticword.SelectanOption') }}
                </option>
                <option value="course">{{ __('adminstaticword.LinktoCourse') }}</option>
                <option value="cart">{{ __('adminstaticword.LinktoCart') }}</option>
                <option value="category">{{ __('adminstaticword.LinktoCategory') }}</option>
              </select>

          </div>


          <div id="probox" class="form-group display-none">
            <label>{{ __('adminstaticword.SelectCourse') }}: <span class="redstar">*</span> </label>
            <br>
            <select style="width: 100%" id="pro_id" name="course_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden>
                   {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach(App\Course::where('status','1')->get() as $product)
                  @if($product->type == 1)
                    <option value="{{ $product->id }}">{{ $product['title'] }}</option>
                  @endif
                @endforeach
            </select>
          </div>


          <div id="catbox" class="form-group display-none">
            <label>{{ __('adminstaticword.SelectCategories') }}: <span class="required">*</span> </label>
            <br>
            <select style="width: 100%" id="cat_id" name="category_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden>
                   {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach(App\Categories::where('status','1')->get() as $category)
                  <option value="{{ $category->id }}">{{ $category['title'] }}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>{{ __('dashboard.coupon_limitation') }}: <span class="redstar">*</span></label>
            <input required="" type="number" min="1" class="form-control" name="maxusage" value="{{old('maxusage')}}">
              <span class="text-danger">{{ $errors->has('maxusage') ? $errors->first('maxusage') : '' }}</span>

          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.CouponLimitationForSingleUser') }}: <span class="redstar">*</span></label>
              <input required="" type="number" min="1" class="form-control" name="limitationForSingleUser" value="{{old('limitationForSingleUser')}}">
              <span class="text-danger">{{ $errors->has('limitationForSingleUser') ? $errors->first('limitationForSingleUser') : '' }}</span>

          </div>
          <div id="minAmount" class="form-group">
            <label>{{ __('adminstaticword.MinOrderPrice') }}: </label>
            <div class="input-group">
              @php
                $currency = App\Currency::first();
              @endphp
{{--                <span class="input-group-addon"><i class="{{ $currency->icon }}"></i></span>--}}
                <span class="input-group-addon"></span>
              <input type="number" min="0.0" value="0.00" step="0.1" class="form-control" name="minamount" value="{{old('minamount')}}">
                <span class="text-danger">{{ $errors->has('minamount') ? $errors->first('minamount') : '' }}</span>

            </div>
          </div>
          <div class="form-group">
              <label>{{ __('adminstaticword.From') }}: </label>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input required="" id="from" type="text" class="form-control" name="from" value="{{old('from')}}">
                  <span class="text-danger">{{ $errors->has('from') ? $errors->first('from') : '' }}</span>

              </div>
          </div>
           <div class="form-group">
            <label>{{ __('adminstaticword.To') }}: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input required="" id="expirydate" type="text" class="form-control" name="expirydate" value="{{old('expirydate')}}">
                <span class="text-danger">{{ $errors->has('expirydate') ? $errors->first('expirydate') : '' }}</span>
            </div>
          </div>
      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('coupon.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  (function($) {
  "use strict";

      $('#link_by').on('change',function(){
        var opt = $(this).val();

        if(opt == 'course'){
          $('#minAmount').hide();
          $('#probox').show();
          $('#minAmount').hide();
          $('#pro_id').attr('required','required');
        }else{
          $('#minAmount').show();
          $('#probox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $('#link_by').on('change',function(){
        var opt = $(this).val();

        if(opt == 'category'){
          $('#catbox').show();
          $('#pro_id').attr('required','required');
        }else{
          $('#catbox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $( function() {
        $( "#expirydate" ).datepicker({
          dateFormat : 'yy-m-d'
        });
          $( "#from").datepicker({
              dateFormat : 'yy-m-d'
          });
      });

  })(jQuery);

</script>

@endsection
