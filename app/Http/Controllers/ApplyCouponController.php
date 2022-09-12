<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommissionController;
use Illuminate\Http\Request;
use App\Coupon;
use App\Instructor;
use App\UserOrganization;
use App\PartnerStudent;
use App\TutorCommission;
use App\TutorCommissionLog;
use Carbon;
use App\Cart;
use App\StudentCoupon;
use Auth;
use Session;
use DB;

class ApplyCouponController extends Controller
{
	public function applyslotscoupon(Request $request)
    {

    	$coupon = Coupon::where('code', $request->coupon)->first();
    	$mytime = Carbon\Carbon::now();
    	$date = $mytime->toDateTimeString();

    	if(isset($coupon)){
			StudentCoupon::where(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'done'=>0])->delete();
			$usercouponcount = StudentCoupon::where(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'done'=>1])->count();
			if($usercouponcount == $coupon->limitationForSingleUser) return back()->with('error', 'Coupon student max limit reached !');
			else
			{
    		if($coupon->expirydate >= $date)
    		{
    			if($coupon->maxusage != 0)
    			{
					$return = [];
					$appointments = explode('_', $request->appointment);
					foreach($appointments as $appointment)
					{
						$createcoupon = new StudentCoupon();
						$usercoupon = $createcoupon->create(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'appointment_id'=>$appointment, 'created_by'=>Auth::user()->id, 'done'=>0]);
						
						if($coupon->link_by == 'course')
						{

							//return $this->validCouponForCourse($coupon, $usercoupon->id, $appointment, $request->tutor);
							$return[] = $this->validCouponForCourse($coupon, $usercoupon->id, $appointment, $request->tutor);

						}
						elseif($coupon->link_by == 'cart')
						{

							//return $this->validCouponForCart($coupon, $usercoupon->id, $appointment, $request->tutor);
							$return[] = $this->validCouponForCart($coupon, $usercoupon->id, $appointment, $request->tutor);

						}
						elseif($coupon->link_by == 'category')
						{

							//return $this->validCouponForCategory($coupon, $usercoupon->id, $appointment, $request->tutor);
							$return[] = $this->validCouponForCategory($coupon, $usercoupon->id, $appointment, $request->tutor);

						}
					}
					
					if(in_array(1, $return)) return back()->with('success', __('backend.promo_code_has_been_added_successfully'));
					else return back()->with('fail', __('backend.for_apply_this_coupon_your_cart_total_should_be_or_greater', ['number' => $coupon->minamount]));
    			}
    			else
    			{
    				return back()->with('error', __('backend.coupon_max_limit_reached'));
    			}

    		}
    		else
    		{
    			return back()->with('error',__('backend.coupon_expired'));
    		}
			}
    	}else{
    		return back()->with('error',__('backend.invalid_coupon'));
    	}

    }
	
    public function applycoupon(Request $request)
    {

    	$coupon = Coupon::where('code', $request->coupon)->first();
    	$mytime = Carbon\Carbon::now();
    	$date = $mytime->toDateTimeString();

    	if(isset($coupon)){
			StudentCoupon::where(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'done'=>0])->delete();
			$usercouponcount = StudentCoupon::where(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'done'=>1])->count();
			if($usercouponcount == $coupon->limitationForSingleUser) return back()->with('error', __('backend.coupon_student_max_limit_reached'));
			else
			{
			$createcoupon = new StudentCoupon();
			$usercoupon = $createcoupon->create(['user_id'=>Auth::user()->id, 'coupon_id'=>$coupon->id, 'appointment_id'=>$request->appointment, 'created_by'=>Auth::user()->id, 'done'=>0]);
    		if($coupon->expirydate >= $date)
    		{
    			if($coupon->maxusage != 0)
    			{
					$return = 0;
    				if($coupon->link_by == 'course')
                    {

                        //return $this->validCouponForCourse($coupon, $usercoupon->id, $request->appointment, $request->tutor);
						$return = $this->validCouponForCourse($coupon, $usercoupon->id, $request->appointment, $request->tutor);

                    }
                    elseif($coupon->link_by == 'cart')
                    {

                        //return $this->validCouponForCart($coupon, $usercoupon->id, $request->appointment, $request->tutor);
						$return = $this->validCouponForCart($coupon, $usercoupon->id, $request->appointment, $request->tutor);

                    }
                    elseif($coupon->link_by == 'category')
                    {

                        //return $this->validCouponForCategory($coupon, $usercoupon->id, $request->appointment, $request->tutor);
						$return = $this->validCouponForCategory($coupon, $usercoupon->id, $request->appointment, $request->tutor);

                    }
					
					if($return == 1) return back()->with('success', __('backend.promo_code_has_been_added_successfully'));
					else return back()->with('fail', __('backend.for_apply_this_coupon_your_cart_total_should_be_or_greater', ['number' => $coupon->minamount]));
    			}
    			else
    			{
    				return back()->with('error', __('backend.coupon_max_limit_reached'));
    			}

    		}
    		else
    		{
    			return back()->with('error',__('backend.coupon_expired'));
    		}
			}
    	}else{
    		return back()->with('error',__('backend.invalid_coupon'));
    	}

    }

    public function validCouponForCourse($coupon ,$usercoupon, $appointment, $tutor)
    {
    	$cart = Cart::where('course_id', '=', $coupon['course_id'])->where('user_id', '=', Auth::user()->id)->first();

        $carts = Cart::where('user_id', '=', Auth::user()->id)
            ->get();
        $per = 0;

        if (isset($cart))
        {
        	if ($cart->course_id == $coupon->course_id)
            {

                if ($coupon->distype == 'per')
                {
                    $per = $cart->offer_price * $coupon->amount / 100;
                }
                else
                {
                    $per = $coupon->amount;
                }



                // Putting a session//
                Session::put('coupanapplied', ['code' => $coupon->code, 'cpnid' => $coupon->id, 'discount' => $per, 'msg' => "$coupon->code is applied !", 'appliedOn' => 'course']);

                Cart::where('course_id', '=', $coupon['course_id'])->where('user_id', '=', Auth::user()
                    ->id)
                    ->update(['distype' => 'course', 'disamount' => $per]);
                Cart::where('course_id', '!=', $coupon['course_id'])->where('user_id', '=', Auth::user()
                    ->id)
                    ->update(['distype' => NULL, 'disamount' => NULL]);

                DB::table('coupons')->where('code', '=', $coupon['code'])->decrement('maxusage', 1);
				
				StudentCoupon::find($usercoupon)->update(['updated_by'=>Auth::user()->id, 'done'=>1]);

                /*
				** Tutor Commission
				*/
				CommissionController::tutorCommission($appointment,$tutor);
				
				//return back()->with('success', 'Promo Code has been added successfully');
				return 1;


            }
            else
            {
                //return back()->with('fail', 'Sorry no product found in your cart for this coupon !');
				return 0;
            }
        }
        else
        {
            //return back()->with('fail', 'Sorry no product found in your cart for this coupon !');
			return 0;
        }
    }

    public function validCouponForCart($coupon ,$usercoupon, $appointment, $tutor)
    {
    	$cart = Cart::where('user_id', '=', Auth::user()->id)->get();

        $total = 0;

        if (isset($cart))
        {

            foreach ($cart as $key => $c)
            {
                if ($c->offer_price != 0)
                {
                    $total = $total + $c->offer_price;
                }
                else
                {
                    $total = $total + $c->price;
                }
            }
            if ($coupon->minamount != 0)
            {

                if ($total >= $coupon->minamount)
                {
                   	//check cart amount
                  	$totaldiscount = 0;
					$per = 0;

					foreach ($cart as $key => $c)
					{

					    if ($coupon->distype == 'per')
					    {

					        if ($c->offer_price != 0)
					        {
					            $per = $c->offer_price * $coupon->amount / 100;
					            $totaldiscount = $totaldiscount + $per;
					        }
					        else
					        {
					            $per = $c->price * $coupon->amount / 100;
					            $totaldiscount = $totaldiscount + $per;
					        }

					    }
					    else
					    {

					        if ($c->offer_price != 0)
					        {
					            $per = $coupon->amount / count($cart);
					            $totaldiscount = $totaldiscount + $per;
					        }
					        else
					        {
					            $per = $coupon->amount / count($cart);
					            $totaldiscount = $totaldiscount + $per;
					        }

					    }
					    // return $per;

					    Cart::where('id', '=', $c->id)
					        ->update(['distype' => 'cart', 'disamount' => $per]);

					}

					//Putting a session//
					Session::put('coupanapplied', ['code' => $coupon->code, 'cpnid' => $coupon->id, 'discount' => $totaldiscount, 'msg' => "$coupon->code Applied Successfully !", 'appliedOn' => 'cart']);

                    DB::table('coupons')->where('code', '=', $coupon['code'])->decrement('maxusage', 1);
					
					StudentCoupon::find($usercoupon)->update(['updated_by'=>Auth::user()->id, 'done'=>1]);

					/*
					** Tutor Commission
					*/
					CommissionController::tutorCommission($appointment,$tutor);
					
					//end return success with discounted amount
					//return back()->with('success', 'Promo Code has been added successfully');
					return 1;


                }
                else
                {
                    //return back()->with('fail', 'For Apply this coupon your cart total should be ' . $coupon->minamount . ' or greater !');
					return 0;
                }

            }
            else
            {

                //check cart amount
                $totaldiscount = 0;
                $per = 0;

                foreach ($cart as $key => $c)
                {

                    if ($coupon->distype == 'per')
                    {

                        if ($c->offer_price != 0)
                        {
                            $per = $c->offer_price * $coupon->amount / 100;
                            $totaldiscount = $totaldiscount + $per;
                        }
                        else
                        {
                            $per = $c->price * $coupon->amount / 100;
                            $totaldiscount = $totaldiscount + $per;
                        }

                    }
                    else
                    {

                        if ($c->offer_price != 0)
                        {
                            $per = $coupon->amount / count($cart);
                            $totaldiscount = $totaldiscount + $per;
                        }
                        else
                        {
                            $per = $coupon->amount / count($cart);
                            $totaldiscount = $totaldiscount + $per;
                        }

                    }

                    Cart::where('id', '=', $c->id)
                        ->update(['distype' => 'cart', 'disamount' => $per]);

                }

                //Putting a session//
                Session::put('coupanapplied', ['code' => $coupon->code, 'cpnid' => $coupon->id, 'discount' => $totaldiscount, 'msg' => "$coupon->code Applied Successfully !", 'appliedOn' => 'cart']);


                DB::table('coupons')->where('code', '=', $coupon['code'])->decrement('maxusage', 1);
				
				StudentCoupon::find($usercoupon)->update(['updated_by'=>Auth::user()->id, 'done'=>1]);
                
				/*
				** Tutor Commission
				*/
				CommissionController::tutorCommission($appointment,$tutor);
				
				//end return success with discounted amount
                //return back()->with('success', 'Promo Code has been added successfully');
				return 1;

            }

        }
    }

    public function validCouponForCategory($coupon ,$usercoupon, $appointment, $tutor)
    {

        $cart = Cart::where('user_id', '=', Auth::user()->id)
        ->get();
        $catcart = collect();

        foreach ($cart as $row)
        {

            if ($row
                ->courses
                ->category->id == $coupon->category_id)
            {
                $catcart->push($row);

            }

        }

        if (count($catcart) > 0)
        {

            $total = 0;
            $totaldiscount = 0;
            $distotal = 0;

            foreach ($catcart as $key => $row)
            {
                if ($row->offer_price != 0)
                {
                    $total = $total + $row->offer_price;
                }
                else
                {
                    $total = $total + $row->price;
                }
            }



            foreach ($catcart as $key => $c)
            {

                $per = 0;

                if ($coupon->distype == 'per')
                {

                    if ($c->offer_price != 0)
                    {

                        $per = $c->offer_price * $coupon->amount / 100;
                        $totaldiscount = $totaldiscount + $per;

                    }
                    else
                    {
                        $per = $c->price * $coupon->amount / 100;
                        $totaldiscount = $totaldiscount + $per;
                    }

                }
                else
                {

                    if ($c->offer_price != 0)
                    {
                        $per = $coupon->amount / count($catcart);
                        $totaldiscount = $totaldiscount + $per;
                    }
                    else
                    {
                        $per = $coupon->amount / count($catcart);
                        $totaldiscount = $totaldiscount + $per;
                    }

                }

                Cart::where('id', '=', $c->id)
                    ->where('user_id', Auth::user()
                    ->id)
                    ->update(['distype' => 'category', 'disamount' => $per]);

                Cart::where('category_id', '!=', $c->courses->category['id'])->where('user_id', '=', Auth::user()
            	    ->id)
            	    ->update(['distype' => NULL, 'disamount' => NULL]);


            }


            if ($coupon->minamount != 0)
            {

                if ($total >= $coupon->minamount)
                {

                    //Putting a session//
                    Session::put('coupanapplied', ['code' => $coupon->code, 'cpnid' => $coupon->id, 'discount' => $totaldiscount, 'msg' => "$coupon->code Applied Successfully !", 'appliedOn' => 'category']);

                     DB::table('coupons')->where('code', '=', $coupon['code'])->decrement('maxusage', 1);
					 
					 StudentCoupon::find($usercoupon)->update(['updated_by'=>Auth::user()->id, 'done'=>1]);

                    /*
					** Tutor Commission
					*/
					CommissionController::tutorCommission($appointment,$tutor);
					
					//return back();
					return 1;

                }
                else
                {
                    Cart::where('user_id', Auth::user()
                        ->id)
                        ->update(['distype' => NULL, 'disamount' => NULL]);
                    //return back()->with('fail', 'For Apply this coupon your cart total should be ' . $coupon->minamount . ' or greater !');
					return 0;
                }

            }
            else
            {
                //Putting a session//
                Session::put('coupanapplied', ['code' => $coupon->code, 'cpnid' => $coupon->id, 'discount' => $totaldiscount, 'msg' => __('backend.applied_successfully', ['attribute' => $coupon->code]), 'appliedOn' => 'category']);

                DB::table('coupons')->where('code', '=', $coupon['code'])->decrement('maxusage', 1);
				
				StudentCoupon::find($usercoupon)->update(['updated_by'=>Auth::user()->id, 'done'=>1]);

                /*
				** Tutor Commission
				*/
				CommissionController::tutorCommission($appointment,$tutor);
				
				//return back();
				return 1;
            }

        }
        else
        {
            //return back()->with('fail', 'Sorry no matching product found in your cart for this coupon !');
			return 0;
        }


    }


    public function remove($cpnid)
    {

        Session::forget('coupanapplied');

        DB::table('coupons')->where('id', $cpnid)->increment('maxusage', 1);

        Cart::where('user_id', '=', Auth::user()->id)
            ->update(['distype' => NULL, 'disamount' => NULL]);
        return back()
            ->with('fail', __('backend.coupon_removed'));

    }
	
	/*
	** Tutor Commission
	*/
	public function tutorCommission($appointment,$tutor)
    {
		$instructor = Instructor::find($tutor);
        $user = PartnerStudent::where(['student_id'=>Auth::user()->id])->first();
		if($user) {
			$userorganization = UserOrganization::with('organization')->where(['user_id'=>$user->partner_id])->first();
			$org['id'] = $userorganization->organization->id;
			$org['commission'] = $userorganization->organization->commission;
		}
		else
		{
			$org['id'] = NULL;
			$org['commission'] = 10;
		}
		$tutorcommission = TutorCommission::create([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
			'organization_id' => $org['id'],
			'originalvalue' => $instructor->PricePerHour,
			'commissionrate' => $org['commission'],
			'commissionvalue' => number_format((($instructor->PricePerHour)*($org['commission'])/100),2),
			'created_by' => Auth::user()->id,
		]);
		$tutorcommissionlog = TutorCommissionLog::create([
			'user_id' => Auth::user()->id,
			'tutor_id' => $tutor,
			'appointment_id' => $appointment,
			'action' => 'add',
			'value' => number_format((($instructor->PricePerHour)*($org['commission'])/100),2),
			'created_by' => Auth::user()->id,
		]);
    }


}
