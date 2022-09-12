<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommissionController;
use App\Appointment;
use App\AppointmentStatus;
use App\BBL;
use App\Cart;
use App\Instructor;
use App\Notification;
use App\Payment_transaction;
use App\Packages;
use App\Student_package;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\Setting;
use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\User;
use App\StudentCoupon;
use App\IP\IP;
use Mail;
use App\Mail\UserAppointment;
use Session;
use DB;

class AppointmentController extends Controller
{
	/**
    * Student Tutor Country Price Per Hour.
    *
	* @return PricePerHour
    */
	public function getStudentTutorCountryPricePerHour($tutor_id)
	{
		// Get user info from ip
		$userIP = new IP();
		$user_ip_country_info = $userIP->getUserCountryInfo();
		
		// Get tutor country price per hour
		$tutor = Instructor::find($tutor_id);
		$tutor_country_price_per_hour = $tutor->tutor_country_price_per_hour()->where(['country_id'=>$user_ip_country_info['country_id'],'status'=>1])->first();
		
		// Return country pricePerHour if exist or tutor defualt pricePerHour
		if($tutor_country_price_per_hour) return $tutor_country_price_per_hour->pricePerHour;
		else return $tutor->PricePerHour;
	}
	
    /*
	** View all Appointments
	** Return view
	*/
	public function appointments()
    {
		$students = User::select('id','fname','lname','email')->where(['role'=>'user'])->orderBy('fname', 'ASC')->get();
		$tutors = Instructor::with(['user'=>function($q) { $q->select('id','fname','lname','email')->where('role', 'instructor'); }])->get();
		$dates = Appointment::select('date')->groupBy('date')->orderBy('date', 'DESC')->get();
		$times = Appointment::select('start_time')->groupBy('start_time')->orderBy('start_time', 'ASC')->get();
		$statuses = AppointmentStatus::all();
		
		return view('admin.appointments.index')->with(['students'=>$students, 'tutors'=>$tutors, 'dates'=>$dates, 'times'=>$times, 'statuses'=>$statuses]);
    }
	
	/**
	** Get all tutors with details
	** Return json data
	*/
	public function getAppointments(Request $request)
    {
        $columns = array(
            0 => 'appointments.id',
            1 => 'student.fname',
			2 => 'tutor.fname',
            3 => 'appointments.date',
            4 => 'appointments.start_time',
			5 => 'appointment_status.status',
        );
		
		$statuses = [1=>'scheduled', 2=>'waitingConfirm', 3=>'confirmed', 4=>'cancelled', 5=>'reserved', 6=>'waitingResolution', 7=>'pendingPayment'];
		
		$query = Appointment::leftJoin('appointment_status', 'appointments.status_id', '=', 'appointment_status.id')
				->leftJoin('instructors', 'appointments.instructor_id', '=', 'instructors.id')
				->leftJoin('users as tutor', 'instructors.user_id', '=', 'tutor.id')
				->leftJoin('users as student', 'appointments.user_id', '=', 'student.id')
				->select('appointment_status.id as status_id','appointment_status.status as status','appointments.date as date','appointments.start_time as time','tutor.fname as tutorFname','tutor.lname as tutorLname','student.fname as studentFname','student.lname as studentLname');

		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where(function($q) use ($search) {
					$q->where('student.fname', 'LIKE', "%{$search}%")
					  ->orWhere('student.lname', 'LIKE', "%{$search}%")
					  ->orWhereRaw("concat(student.fname, ' ', student.lname) like '%" .$search. "%' ")
					  ->orWhere('student.email', 'LIKE', "%{$search}%")
					  ->orWhere('student.mobile', 'LIKE',"%{$search}%")
					  ->orWhere('tutor.fname', 'LIKE',"%{$search}%")
					  ->orWhere('tutor.lname', 'LIKE', "%{$search}%")
					  ->orWhereRaw("concat(tutor.fname, ' ', tutor.lname) like '%" .$search. "%' ")
					  ->orWhere('tutor.email', 'LIKE', "%{$search}%")
					  ->orWhere('tutor.mobile', 'LIKE',"%{$search}%")
					  ->orWhere('appointments.date', 'LIKE',"%{$search}%")
					  ->orWhere('appointments.start_time', 'LIKE',"%{$search}%")
					  ->orWhere('appointment_status.status', 'LIKE',"%{$search}%");
			});
		}
		
		if(!empty($request->input('student')))
		{
			$query->whereIn('appointments.user_id', $request->input('student'));
		}
		
		if(!empty($request->input('tutor')))
		{
			$query->whereIn('appointments.instructor_id', $request->input('tutor'));
		}
		
		if(!empty($request->input('date')))
		{
			$query->whereIn('appointments.date', $request->input('date'));
		}
		
		if(!empty($request->input('time')))
		{
			$query->whereIn('appointments.start_time', $request->input('time'));
		}
		
		if(!empty($request->input('status')))
		{
			$query->whereIn('appointments.status_id', $request->input('status'));
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['student'] = $single->studentFname.' '.$single->studentLname;
				$nestedData['tutor'] = $single->tutorFname.' '.$single->tutorLname;
				$nestedData['date'] = $single->date;
				$nestedData['time'] = $single->time;
				$nestedData['status'] = '<span class="label '.$statuses[$single->status_id].'">'.$single->status.'</span>';
				
				$data[] = $nestedData;
            }
        }
		
		$json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data); 
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appoint = Appointment::find($id);
        return view('admin.course.appointment.view', compact('appoint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $data = Appointment::findorfail($id);
        $maincourse = Course::findorfail($request->course_id);
        $input['accept'] = $request->accept;


        if(isset($request->accept))
        {

            Appointment::where('id', $id)
                    ->update(['reply' => $request->reply, 'accept' => 1]);

        }
        else
        {

            Appointment::where('id', $id)
                    ->update(['reply' => NULL, 'accept' => 0]);

        }



        return redirect()->route('course.show',$maincourse->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::where('id', $id)->delete();
        return back()->with('delete',__('backend.deleted_successfully'));
    }

    public function delete($id)
    {
        Appointment::where('id', $id)->delete();
        return back()->with('delete',__('backend.deleted_successfully'));
    }
	
	/*
	* Book Slots
	*/
	public function bookSlots(Request $request)
    {
		$payment = 'cart';
		
		if (auth()->id() == null){
            return redirect('/login');
        }
		
		$appointment_array = [];
		$cartRecord_array = [];
		$appointment_exist_count = 0;
        foreach($request->query('slots') as $slot)
		{
		$slot_data = explode(',',$slot);
		$id = $slot_data[0];
		$time = $slot_data[2];
		$date = $slot_data[1];
		
		$pricePerHour = $this->getStudentTutorCountryPricePerHour($id);
		
		$appointment = Appointment::where('user_id', Auth::User()->id)
                                    ->where('instructor_id', $id)
                                    ->where('start_time', $time)
                                    ->where('date', $date)
                                    ->first();
		
		$appointments_count = Appointment::where('user_id', Auth::User()->id)
									->where('start_time', $time)
                                    ->where('date', $date)
									->where('status_id', '!=', 4)
                                    ->count();
		if($appointments_count)
		{
			if(isset($appointment->id))
			{
				if($appointment->instructor_id != $id)
				{
					$usercouponcount = StudentCoupon::where(['user_id'=>Auth::user()->id, 'appointment_id'=>$appointment->id, 'done'=>1])->count();
					if(!$usercouponcount)
					{
						$appointment_exist_count = $appointment_exist_count + 1;
						continue;
					}
				}
			}
			else
			{
				$appointment_exist_count = $appointment_exist_count + 1;
				continue;
			}
		}
		
        DB::beginTransaction();

        try{
            if(!isset($appointment)){
                $instructor= Instructor::find($id);
                if(!$instructor){
                    $errorMsg = __('backend.tutor_not_found');
                    throw new \Exception($errorMsg);
                }
				
                $appointment = new Appointment();
                $appointment->user_id = Auth::User()->id;
                $appointment->instructor_id = $id;
                $appointment->course_id = null;
                $appointment->title = null;
                $appointment->detail = null;
                $appointment->accept = 0;
                $appointment->status_id = 7;
                $appointment->date = $date;
                $appointment->time_zone_id = $instructor->user->time_zone_id;
                $appointment->start_time = $time;
                $appointment->save();
            }
			
			$appointment->update(['status_id'=>7]);

            // add to Cart

            $user = Instructor::where('instructors.id', $id)->with('user')
                ->join('users', 'instructors.user_id', 'users.id')
                ->join('allcountry', 'allcountry.id', 'users.country_id')
                ->first();

            // added for marketing purposes
            Instructor::find($id)->increment('active_students');

            if($payment == 'cart') {
                $cartRecord = Cart::where('user_id', Auth::User()->id)->where('appointment_id', $appointment->id)->first();

                if (empty($cartRecord)) {

                    $cartRecord = new Cart();
                    $cartRecord->user_id = Auth::User()->id;
                    $cartRecord->course_id = null;
                    $cartRecord->appointment_id = $appointment->id;
                    $cartRecord->category_id = null;
                    $cartRecord->offer_price = $pricePerHour;
                    $cartRecord->save();

                }


                $coupanapplieds = Session::get('coupanapplied');
                if (empty($coupanapplieds) == true) {

                    Cart::where('user_id', Auth::user()
                        ->id)
                        ->update(['distype' => NULL, 'disamount' => NULL]);

                }
            }

            DB::commit();
            $success = true;

        } catch (\Exception $e) {

            $success = false;
            DB::rollback();
            return redirect()->back()->with('error', __('backend.error'));
        }
		
		if(env('MAIL_USERNAME')!=null)
		{
			$email = new EmailAppointmentController($appointment->id);
			$email->book();
        }

		$appointment_array[] = $appointment;
		$cartRecord_array[] = $cartRecord;
		}
		
		if($appointment_exist_count == count($request->query('slots'))) return redirect()->to('/mylessons/'.auth()->id())->with('error', __('backend.you_have_another_appointments_at_these_times'));
		
		$setting = Setting::first();
		$tutor = $id;
		$package = 0;
        return view('frontend.payNow_slots',compact('user', 'appointment_array', 'cartRecord_array', 'tutor', 'package', 'setting'));
    }

    /*
     *
     * $payment = balance or cart
     */
    public function request(Request $request, $id, $date, $time, $payment='cart')
    {
		if (auth()->id() == null){
            $url = '/course/appointment/'.$id.'/'.$request->date.'/'.$request->time;
            session(['page' => $url]);

            return redirect('/login');
        }
		
		$pricePerHour = $this->getStudentTutorCountryPricePerHour($id);
		
        $appointment = Appointment::where('user_id', Auth::User()->id)
                                    ->where('instructor_id', $id)
                                    ->where('start_time', $time)
                                    ->where('date', $date)
                                    ->first();
		
		if (isset($request->old_lesson_id))
		{
			$appointments_count = Appointment::where('user_id', Auth::User()->id)
                                    ->where('start_time', $time)
                                    ->where('date', $date)
									->where('status_id', '!=', 4)
                                    ->count();
			if($appointments_count) return redirect()->to('/mylessons/'.auth()->id())->with('error', __('backend.you_have_another_appointment_at_this_time'));
		}
		
        DB::beginTransaction();

        try{

            if(!isset($appointment)){

                $instructor= Instructor::find($id);
                if(!$instructor){
                    $errorMsg = __('backend.tutor_not_found');
                    throw new \Exception($errorMsg);
                }


                $appointment = new Appointment();
                $appointment->user_id = Auth::User()->id;
                $appointment->instructor_id = $id;
                $appointment->course_id = null;
                $appointment->title = null;
                $appointment->detail = null;
                $appointment->accept = 0;
				$appointment->status_id = 7;
                $appointment->date = $date;
                $appointment->time_zone_id = $instructor->user->time_zone_id;
                $appointment->start_time = $time;
                //$appointment->save();
            }
			
			
			if (isset($request->old_lesson_id)) {

                $old_lesson = Appointment::where('id', $request->old_lesson_id)->first();
                $appointment->status_id = $old_lesson->status_id;

            }
			$appointment->save();
			

            $user = Instructor::where('instructors.id', $id)->with('user')
                ->join('users', 'instructors.user_id', 'users.id')
                ->join('allcountry', 'allcountry.id', 'users.country_id')
                ->first();

            Instructor::find($id)->increment('active_students');

            if($payment == 'cart') {




                $cartRecord = Cart::where('user_id', Auth::User()->id)->where('appointment_id', $appointment->id)->first();

                if (empty($cartRecord)) {

                    $cartRecord = new Cart();
                    $cartRecord->user_id = Auth::User()->id;
                    $cartRecord->course_id = null;
                    $cartRecord->appointment_id = $appointment->id;
                    $cartRecord->category_id = null;
                    $cartRecord->offer_price = $pricePerHour;
                    $cartRecord->save();

                }


                $coupanapplieds = Session::get('coupanapplied');
                if (empty($coupanapplieds) == true) {

                    Cart::where('user_id', Auth::user()
                        ->id)
                        ->update(['distype' => NULL, 'disamount' => NULL]);

                }

            }





            DB::commit();
            $success = true;

        } catch (\Exception $e) {

            $success = false;
            DB::rollback();
            return redirect()->back()->with('error', __('backend.error'));
        }

        if (isset($request->old_lesson_id)){
			// create bbb meeting record
			$bigBlueController = new BigBlueController();
            $meetingid = random_int(1000000, 1000000000000);

            $bbbRequest = new Request();
            $bbbRequest->merge(['presen_name' =>$appointment->instructor->user->fname.' '. $appointment->instructor->user->lname]);
            $bbbRequest->merge(['meetingid' =>$meetingid]);
            $bbbRequest->merge(['meetingname' =>__('backend.meeting_meetingname', ['tutor_fname'=>$appointment->instructor->user->fname, 'tutor_lname'=>$appointment->instructor->user->lname, 'student_fname'=>$appointment->user->fname, 'student_lname'=>$appointment->user->lname])]);
            $bbbRequest->merge(['detail' =>'<b>'.__('backend.meeting_detail', ['tutor_fname'=>$appointment->instructor->user->fname, 'tutor_lname'=>$appointment->instructor->user->lname, 'student_fname'=>$appointment->user->fname, 'student_lname'=>$appointment->user->lname]).'</b>']);
            $bbbRequest->merge(['duration' =>60]);
            $bbbRequest->merge(['start_time' =>$appointment->date. ' '. $appointment->start_time]);
            $bbbRequest->merge(['modpw' =>random_int(100000, 999999)]);
            $bbbRequest->merge(['attendeepw' =>random_int(100000, 999999)]);
            $bbbRequest->merge(['welcomemsg' =>__('backend.meeting_welcomemsg')]);
            $bbbRequest->merge(['setMaxParticipants' =>2]);
            $bbbRequest->merge(['setMuteOnStart' =>0]);
            $bbbRequest->merge(['appointment_id' =>$appointment->id]);

            $meetingCreation = $bigBlueController->store($bbbRequest);
            $meetingRecord  = BBL::where('meetingid', $meetingid)->first();
			
			$studentCoupon = StudentCoupon::where(['appointment_id'=>$request->old_lesson_id])->first();
			if($studentCoupon) $studentCoupon->update(['appointment_id'=>$appointment->id]);
			
			$old_lesson = Appointment::where('id', $request->old_lesson_id)->first();
            $old_lesson->delete();
			$old_meeting = BBL::where('appointment_id', $request->old_lesson_id)->delete();
            
			if(env('MAIL_USERNAME')!=null)
			{
				$email = new EmailAppointmentController($appointment->id);
				$email->reschedule($meetingRecord->id);
			}
			
            return redirect()->to('/mylessons/'.auth()->id());
        }
        if($appointment){
            /*if(env('MAIL_USERNAME')!=null) {
                try{
                $request = $appointment;
                $x = 'Kindly be informed that your lesson with student ('.auth()->user()->fname.' '. auth()->user()->lname.') will start at ('.$correct_time.') on ('.$request->date.')';
                $y = 'Kindly be informed that your lesson with tutor ('.$user->user->fname.' '. $user->user->lname.') will start at ('.$correct_time.') on ('.$request->date.')';
                    Mail::to($user->user->email)->send(new UserAppointment($x, $request));
                    Mail::to(auth()->user()->email)->send(new UserAppointment($y, $request));


                }catch(\Swift_TransportException $e){
                    return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
                }
            }*/
        }
		
		/**
		** Get User Balance
		**/
		$setting = Setting::first();
		$tutor = $id;
		$package = 0;
        return view('frontend.payNow',compact('user', 'appointment', 'request', 'cartRecord', 'tutor', 'package', 'setting'));
    }
	
	
	public function paymentSlotsCallback(Request $request) {

        DB::beginTransaction();

        try{    

            $bigBlueController = new BigBlueController();
            $txRefOrig = $request->tx_ref;

            // Comfirm that the transaction is successful
            if(isset($request->status) && $request->status =='successful' && isset($request->transaction_id) && $request->transaction_id > 0 ){
                $txRef = base64_decode($txRefOrig);
                $txRef = explode( '-', $txRef);
				$cart_ids = explode( '_', $txRef[0]);
				$appointment_ids = explode( '_', $txRef[1]);

                // Get the transaction from your DB using the transaction reference (txref)
                $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();
                $cartSum = Cart::selectRaw('sum(offer_price) as offer_price, sum(disamount) as disamount')->whereIn('id', $cart_ids)->get()->toArray();

                
                if((!$transactionRecord || $transactionRecord == null) && array_filter($cartSum)){

                    $transactionRecord = new Payment_transaction();
                    $transactionRecord->transaction_ref =$request->tx_ref;
                    $transactionRecord->user_id =Auth::user()->id;
                    $transactionRecord->amount =$cartSum[0]['offer_price'];
                    $transactionRecord->discount =$cartSum[0]['disamount'];
                    $transactionRecord->net_amount =$cartSum[0]['offer_price'] - $cartSum[0]['disamount'];

                    $transaction_fees = ((($cartSum[0]['offer_price'] - $cartSum[0]['disamount']) * 3.8 ) / 100);
                    $bank_fees = ((($cartSum[0]['offer_price'] - $cartSum[0]['disamount']) * 1.4 ) / 100);
                    $bank_fees = number_format(($bank_fees )  , 2, '.', '');

                    $transactionRecord->total_amount =$cartSum[0]['offer_price'] - $cartSum[0]['disamount']+ $transaction_fees - $bank_fees;
                    $transactionRecord->status =0;
                    $transactionRecord->payment_method =$txRef[5];
                    $transactionRecord->save();


                    

                }



                if(!$cartSum){
                    // Session::flash('error',' Transaction Success but Cart Record Not found !');
                    // return redirect('/mylessons/'.$txRef[2]);

                    $errorMsg = __('backend.transaction_success_but_cart_record_not_found');
                    throw new \Exception($errorMsg);
                }

                // Comfirm that the transaction is successful              
                $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();

                $transactionRecord->vendor_transaction_id=$request->transaction_id;
                $transactionRecord->vendor_transaction_reference=$request->transaction_id;
                $transactionRecord->status=1;
                $transactionRecord->save();

                foreach($appointment_ids as $key => $appointment_id)
				{
				$appointmentRecord = Appointment::find($appointment_id);
                $appointmentRecord->payment_transaction_id=$transactionRecord->id;
                $appointmentRecord->status_id=1; // Schedualed
                $appointmentRecord->save();

                //delete cart record
                Cart::find($cart_ids[$key])->delete();

                // create bbb meeting record
                $meetingid = random_int(1000000, 1000000000000);

                

                $bbbRequest = new Request();
                $bbbRequest->merge(['presen_name' =>$appointmentRecord->instructor->user->fname.' '. $appointmentRecord->instructor->user->lname]);
                $bbbRequest->merge(['meetingid' =>$meetingid]);
				$bbbRequest->merge(['meetingname' =>__('backend.meeting_meetingname', ['tutor_fname'=>$appointmentRecord->instructor->user->fname, 'tutor_lname'=>$appointmentRecord->instructor->user->lname, 'student_fname'=>$appointmentRecord->user->fname, 'student_lname'=>$appointmentRecord->user->lname])]);
				$bbbRequest->merge(['detail' =>'<b>'.__('backend.meeting_detail', ['tutor_fname'=>$appointmentRecord->instructor->user->fname, 'tutor_lname'=>$appointmentRecord->instructor->user->lname, 'student_fname'=>$appointmentRecord->user->fname, 'student_lname'=>$appointmentRecord->user->lname]).'</b>']);
				$bbbRequest->merge(['duration' =>60]);
                $bbbRequest->merge(['start_time' =>$appointmentRecord->date. ' '. $appointmentRecord->start_time]);
                $bbbRequest->merge(['modpw' =>random_int(100000, 999999)]);
                $bbbRequest->merge(['attendeepw' =>random_int(100000, 999999)]);
				$bbbRequest->merge(['welcomemsg' =>__('backend.meeting_welcomemsg')]);
                $bbbRequest->merge(['setMaxParticipants' =>2]);
                $bbbRequest->merge(['setMuteOnStart' =>0]);
                $bbbRequest->merge(['appointment_id' =>$appointmentRecord->id]);



                $meetingCreation = $bigBlueController->store($bbbRequest);
                $meetingRecord  = BBL::where('meetingid', $meetingid)->first();

                if(env('MAIL_USERNAME')!=null)
				{
					$email = new EmailAppointmentController($appointmentRecord->id);
					$email->confirm($meetingRecord->id);
                }

                    $notification = new Notification;
                    $notification->type = 6;
                    $notification->notifiable_type  = "Instructor" ;
                    //$notification->notifiable_id  = $appointmentRecord->instructor->user ? $appointmentRecord->instructor->user->id : "";
                    $notification->data  = __('backend.studnet_just_booked_a_session_with_you');
                    $notification->save();
                    $notification2 = new Notification;
                    $notification2->type = 6;
                    $notification2->notifiable_type  = "Instructor" ;
                    $notification2->notifiable_id  = Auth::user()->id;
                    $notification2->data  = __('backend.you_just_booked_a_session');
                    $notification2->save();
					
					/*
					** Tutor Commission
					*/
					CommissionController::tutorCommission($appointmentRecord->id,$appointmentRecord->instructor->id);
				}
             

                /*if($txRef[4] > 0)
                {
                    $package = Packages::find($txRef[4]);
                    if($package)
                    {
                        $oldusertutorbalance = UserTutorBalance::where(['user_id'=>$txRef[2],'tutor_id'=>$txRef[3]])->first();
                        if(!$oldusertutorbalance)
                        {
                            $usertutorbalance = new UserTutorBalance();
                            $usertutorbalance->create([
                                'user_id' => $txRef[2],
                                'tutor_id' => $txRef[3],
                                'balance' => $package->numOfHours,
                                'created_by' => Auth::user()->id,
                            ]);
                        }
                        else
                        {
                            $oldusertutorbalance->update([
                                'user_id' => $txRef[2],
                                'tutor_id' => $txRef[3],
                                'balance' => $oldusertutorbalance->balance + $package->numOfHours,
                                'updated_by' => Auth::user()->id,
                            ]);
                        }
                    }
                }*/
                
                Session::flash('success',__('backend.payment_received_successfully'));

                


            }else{
                
                $errorMsg = __('backend.transaction_failed');
                throw new \Exception($errorMsg);
            }

            DB::commit();
            $success = true;

        } catch (\Exception $e) {

            $success = false;
            DB::rollback();
            dd($e);
            Session::flash('error', $e->message);
            return redirect('/mylessons/'.auth()->id);
        }

        return redirect('/mylessons/'.$txRef[2]);

    }


    public function paymentCallback(Request $request) {
        //dd($request);

        DB::beginTransaction();

        try{    

            $bigBlueController = new BigBlueController();
            $txRefOrig = $request->tx_ref;
    //        $txRefOrig = json_decode(request()->resp)->tx->txRef;
    //        $data = Rave::verifyTransaction($txRefOrig);

            //dd($data);

            // Comfirm that the transaction is successful
            if(isset($request->status) && $request->status =='successful' && isset($request->transaction_id) && $request->transaction_id > 0 ){
                $txRef = base64_decode($txRefOrig);

                $txRef = explode( '-', $txRef);
                //dd($txRef); 

                // Get the transaction from your DB using the transaction reference (txref)

                $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();
                $cartRecord= Cart::find($txRef[0]);

                
                if(!$transactionRecord || $transactionRecord == null){

                    $transactionRecord = new Payment_transaction();
                    $transactionRecord->transaction_ref =$request->tx_ref;
                    $transactionRecord->user_id =$cartRecord->user_id;
                    $transactionRecord->amount =$cartRecord->offer_price;
                    $transactionRecord->discount =$cartRecord->disamount;
                    $transactionRecord->net_amount =$cartRecord->offer_price - $cartRecord->disamount;

                    $transaction_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
                    $bank_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
                    $bank_fees = number_format(($bank_fees )  , 2, '.', '');

                    $transactionRecord->total_amount =$cartRecord->offer_price - $cartRecord->disamount+ $transaction_fees - $bank_fees;
                    $transactionRecord->status =0;
                    $transactionRecord->payment_method =$txRef[5];
                    $transactionRecord->save();


                    

                }



                if(!$cartRecord){
                    // Session::flash('error',' Transaction Success but Cart Record Not found !');
                    // return redirect('/mylessons/'.$txRef[2]);

                    $errorMsg = __('backend.transaction_success_but_cart_record_not_found');
                    throw new \Exception($errorMsg);
                }

                // Check if you have previously given value for the transaction. If you have, return redirect to your successpage else, continue


    //            // Confirm that the chargecode is 00 or 0
    //            if($data->data->chargecode !='00' || $data->data->chargecode !='0'){
    //                Session::flash('error',' Error in Charge Code !');
    //                return redirect('/mylessons/'.$txRef[2]);
    //            }
    //
    //            // Confirm that the currency on your db transaction is equal to the returned currency
    //            if($data->data->currency !='USD'){
    //                Session::flash('error',' Error in Received Currency !');
    //                return redirect('/mylessons/'.$txRef[2]);
    //            }
    //
    //            // Confirm that the db transaction amount is equal to the returned amount
    //            if($data->data->amount != $transactionRecord->total_amount){
    //                Session::flash('error',' Error in Received Amount !');
    //                return redirect('/mylessons/'.$txRef[2]);
    //            }

                // Comfirm that the transaction is successful

              
                $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();

                $transactionRecord->vendor_transaction_id=$request->transaction_id;
                $transactionRecord->vendor_transaction_reference=$request->transaction_id;
                $transactionRecord->status=1;
                $transactionRecord->save();

                $appointmentRecord = Appointment::find($cartRecord->appointment_id);
                $appointmentRecord->payment_transaction_id=$transactionRecord->id;
                $appointmentRecord->status_id=1; // Schedualed
                $appointmentRecord->save();

                //delete cart record
                $cartRecord->delete();

                // create bbb meeting record
 
                $meetingid = random_int(1000000, 1000000000000);

                

                $bbbRequest = new Request();
                $bbbRequest->merge(['presen_name' =>$appointmentRecord->instructor->user->fname.' '. $appointmentRecord->instructor->user->lname]);
                $bbbRequest->merge(['meetingid' =>$meetingid]);
                $bbbRequest->merge(['meetingname' =>__('backend.meeting_meetingname', ['tutor_fname'=>$appointmentRecord->instructor->user->fname, 'tutor_lname'=>$appointmentRecord->instructor->user->lname, 'student_fname'=>$appointmentRecord->user->fname, 'student_lname'=>$appointmentRecord->user->lname])]);
				$bbbRequest->merge(['detail' =>'<b>'.__('backend.meeting_detail', ['tutor_fname'=>$appointmentRecord->instructor->user->fname, 'tutor_lname'=>$appointmentRecord->instructor->user->lname, 'student_fname'=>$appointmentRecord->user->fname, 'student_lname'=>$appointmentRecord->user->lname]).'</b>']);
				$bbbRequest->merge(['duration' =>60]);
                $bbbRequest->merge(['start_time' =>$appointmentRecord->date. ' '. $appointmentRecord->start_time]);
                $bbbRequest->merge(['modpw' =>random_int(100000, 999999)]);
                $bbbRequest->merge(['attendeepw' =>random_int(100000, 999999)]);
                $bbbRequest->merge(['welcomemsg' =>__('backend.meeting_welcomemsg')]);
                $bbbRequest->merge(['setMaxParticipants' =>2]);
                $bbbRequest->merge(['setMuteOnStart' =>0]);
                $bbbRequest->merge(['appointment_id' =>$appointmentRecord->id]);



                $meetingCreation = $bigBlueController->store($bbbRequest);
                $meetingRecord  = BBL::where('meetingid', $meetingid)->first();

                if(env('MAIL_USERNAME')!=null)
				{
					$email = new EmailAppointmentController($appointmentRecord->id);
					$email->confirm($meetingRecord->id);
                }

                    $notification = new Notification;
                    $notification->type = 6;
                    $notification->notifiable_type  = "Instructor" ;
                    //$notification->notifiable_id  = $appointmentRecord->instructor->user ? $appointmentRecord->instructor->user->id : "";
                    $notification->data  = __('backend.studnet_just_booked_a_session_with_you');
                    $notification->save();
                    $notification2 = new Notification;
                    $notification2->type = 6;
                    $notification2->notifiable_type  = "Instructor" ;
                    $notification2->notifiable_id  = Auth::user()->id;
                    $notification2->data  = __('backend.you_just_booked_a_session');
                    $notification2->save();
             

                /*if($txRef[4] > 0)
                {
                    $package = Packages::find($txRef[4]);
                    if($package)
                    {
                        $oldusertutorbalance = UserTutorBalance::where(['user_id'=>$txRef[2],'tutor_id'=>$txRef[3]])->first();
                        if(!$oldusertutorbalance)
                        {
                            $usertutorbalance = new UserTutorBalance();
                            $usertutorbalance->create([
                                'user_id' => $txRef[2],
                                'tutor_id' => $txRef[3],
                                'balance' => $package->numOfHours,
                                'created_by' => Auth::user()->id,
                            ]);
                        }
                        else
                        {
                            $oldusertutorbalance->update([
                                'user_id' => $txRef[2],
                                'tutor_id' => $txRef[3],
                                'balance' => $oldusertutorbalance->balance + $package->numOfHours,
                                'updated_by' => Auth::user()->id,
                            ]);
                        }
                    }
                }*/


                
                /*
                ** Tutor Commission
                */
                CommissionController::tutorCommission($appointmentRecord->id,$appointmentRecord->instructor->id);
                
                Session::flash('success',__('backend.payment_received_successfully'));

                


            }else{
                
                $errorMsg = __('backend.transaction_failed');
                throw new \Exception($errorMsg);
            }

            DB::commit();
            $success = true;

        } catch (\Exception $e) {

            $success = false;
            DB::rollback();
            dd($e);
            Session::flash('error', $e->message);
            return redirect('/mylessons/'.auth()->id);
        }

        return redirect('/mylessons/'.$txRef[2]);

    }
	
	public function paymentCallbackdashboard(Request $request) {
        $txRefOrig = $request->tx_ref;

        // Comfirm that the transaction is successful
        if(isset($request->status) && $request->status =='successful' && isset($request->transaction_id) && $request->transaction_id > 0 ){
            $txRef = base64_decode($txRefOrig);

            $txRef = explode( '-', $txRef);

            // Get the transaction from your DB using the transaction reference (txref)

            $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();
            $cartRecord= Cart::find($txRef[0]);

            if(!$transactionRecord || $transactionRecord == null){

                $transactionRecord = new Payment_transaction();
                $transactionRecord->transaction_ref =$request->tx_ref;
                $transactionRecord->user_id =$cartRecord->user_id;
                $transactionRecord->amount =$cartRecord->offer_price;
                $transactionRecord->discount =$cartRecord->disamount;
                $transactionRecord->net_amount =$cartRecord->offer_price - $cartRecord->disamount;

                $transaction_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
                $bank_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
                $bank_fees = number_format(($bank_fees )  , 2, '.', '');

                $transactionRecord->total_amount =$cartRecord->offer_price - $cartRecord->disamount+ $transaction_fees - $bank_fees;
                $transactionRecord->status =0;
                $transactionRecord->payment_method =$txRef[5];
                $transactionRecord->save();
            }

            if(!$cartRecord){
                Session::flash('error',__('backend.transaction_success_but_cart_record_not_found'));
                return redirect('/user');
            }

            // Comfirm that the transaction is successful

            $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();

            $transactionRecord->vendor_transaction_id=$request->transaction_id;
            $transactionRecord->vendor_transaction_reference=$request->transaction_id;
            $transactionRecord->status=1;
            $transactionRecord->save();

            /*$appointmentRecord = Appointment::find($cartRecord->appointment_id);
            $appointmentRecord->payment_transaction_id=$transactionRecord->id;
            $appointmentRecord->status_id=1;
            $appointmentRecord->save();*/

            //update student package to paid
			$studentpackage = Student_package::find($cartRecord->student_package_id);
			$studentpackage->update(['paid'=>1]);
			
			//delete cart record
            $cartRecord->delete();

			if($txRef[4] > 0)
			{
				$package = Packages::find($txRef[4]);
				if($package)
				{
					$usertutorbalancelog = new UserTutorBalanceLog();
					$usertutorbalancelog->create([
						'user_id' => $txRef[2],
						'tutor_id' => $txRef[3],
						'balance' => $package->numOfHours,
						'action' => 'package',
						'created_by' => Auth::user()->id,
					]);
					
					$oldusertutorbalance = UserTutorBalance::where(['user_id'=>$txRef[2],'tutor_id'=>$txRef[3]])->first();
					if(!$oldusertutorbalance)
					{
						$usertutorbalance = new UserTutorBalance();
						$usertutorbalance->create([
							'user_id' => $txRef[2],
							'tutor_id' => $txRef[3],
							'balance' => $package->numOfHours,
							'created_by' => Auth::user()->id,
						]);
					}
					else
					{
						$oldusertutorbalance->update([
							'user_id' => $txRef[2],
							'tutor_id' => $txRef[3],
							'balance' => $oldusertutorbalance->balance + $package->numOfHours,
							'updated_by' => Auth::user()->id,
						]);
					}
				}
			}
			
            Session::flash('success',__('backend.payment_received_successfully'));
            return redirect('/user');

        }else{
            Session::flash('error',__('backend.transaction_failed'));
            return redirect('/user');
        }
    }
}
