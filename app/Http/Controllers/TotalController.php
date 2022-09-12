<?php

namespace App\Http\Controllers;

use App\User;
use App\Instructor;
use App\Appointment;
use App\BBL;
use App\Favourites;
use App\Messenger_message;
use App\Student_package;
use App\StudentCoupon;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\Time_zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;


class TotalController extends Controller
{
    /**
     * @var Pusher
     */

    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Show all of count of students.
     *
     * @return mixed
     */
    public function studentsTotal()
    {
		return view('admin.totals.students');		
    }
	
	/**
     * Show all of count of tutors.
     *
     * @return mixed
     */
    public function tutorsTotal()
    {
		return view('admin.totals.tutors');
    }
	
	/**
	* Get all of count of students
	*/
	public function getStudentsTotal(Request $request)
    {
        $columns = array(
            0 => 'users.id', 
            1 => 'users.fname',
            2 => 'users.email',
            3 => 'users.mobile',
			4 => 'allcountry.nicename',
			5 => '',
			6 => '',
			7 => '',
			8 => '',
			9 => '',
			10 => '',
			11 => '',
			12 => '',
			13 => 'users.created_at',
        );
		
		$query = User::leftJoin('allcountry', 'users.country_id', '=', 'allcountry.id')
				->select('users.id as id','users.user_img as image','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','allcountry.nicename as country','users.created_at as created_at')
				->where(['users.role'=>'user']);

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
					$q->where('users.id', 'LIKE', "%{$search}%")
					  ->orWhere('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE',"%{$search}%")
					  ->orWhere('users.email', 'LIKE',"%{$search}%")
					  ->orWhere('users.mobile', 'LIKE',"%{$search}%")
					  ->orWhere('allcountry.nicename', 'LIKE',"%{$search}%")
					  ->orWhereDate('users.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
				$appointment_ids = Appointment::where(['user_id'=>$single->id])->pluck('id')->toArray();
				$bbls = BBL::whereIn('appointment_id', $appointment_ids)->get();
				$user_balance = UserTutorBalance::select(DB::raw('SUM(balance) AS balance'))->where(['user_id'=>$single->id])->first();
				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['country'] = $single->country;
				$nestedData['appointments'] = '';
				if($single->appointment->count())
				{
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 1)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',1)"><span class="label scheduled">'.$single->appointment->where('status_id', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 2)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',2)"><span class="label waitingConfirm">'.$single->appointment->where('status_id', 2)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 3)->count())? '<a class="total-links-black" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',3)"><span class="label confirmed">'.$single->appointment->where('status_id', 3)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 4)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',4)"><span class="label cancelled">'.$single->appointment->where('status_id', 4)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 5)->count())? '<a class="total-links-black" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',5)"><span class="label reserved">'.$single->appointment->where('status_id', 5)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 6)->count())? '<a class="total-links-black" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',6)"><span class="label waitingResolution">'.$single->appointment->where('status_id', 6)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 7)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',7)"><span class="label pendingPayment">'.$single->appointment->where('status_id', 7)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= '/&nbsp;<a class="total-links-black" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',0)"><span class="label label-default">'.$single->appointment->count().'</span></a>';
				}
				
				$nestedData['meetings'] = '';
				if($bbls->count())
				{
					$nestedData['meetings'] .= ($bbls->where('is_ended', 1)->count())? '<a class="total-links-white" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$bbls->where('is_ended', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['meetings'] .= ($bbls->where('is_ended', 0)->count())? '<a class="total-links-white" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$bbls->where('is_ended', 0)->count().'</span></a>&nbsp;':'';
					$nestedData['meetings'] .= '/&nbsp;<a class="total-links-black" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$bbls->count().'</span></a>';
				}
				
				$nestedData['tutors'] = ($single->appointment->groupBy('instructor_id')->count())? '<a class="total-links-black" onclick="dealwithTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".')"><span class="label label-default">'.$single->appointment->groupBy('instructor_id')->count().'</span></a>':'';
				$nestedData['favourites'] = ($single->favourite->count())? '<a class="total-links-black" onclick="favouriteTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".')"><span class="label label-default">'.$single->favourite->count().'</span></a>':'';
				
				$nestedData['messages'] = ($single->messages_sender->count())? '<span class="label label-default">'.$single->messages_sender->count().'</span>':'';
				$nestedData['messages'] = '';
				if($single->messages_sender->count())
				{
					$nestedData['messages'] .= ($single->messages_sender->where('is_read', 1)->count())? '<a class="total-links-white" onclick="messageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->messages_sender->where('is_read', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['messages'] .= ($single->messages_sender->where('is_read', 0)->count())? '<a class="total-links-white" onclick="messageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->messages_sender->where('is_read', 0)->count().'</span></a>&nbsp;':'';
					$nestedData['messages'] .= '/&nbsp;<a class="total-links-black" onclick="messageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->messages_sender->count().'</span></a>';
				}
				
				$nestedData['packages'] = '';
				if($single->studentpackage->count())
				{
					$nestedData['packages'] .= ($single->studentpackage->where('paid' ,1)->count())? '<a class="total-links-white" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->studentpackage->where('paid' ,1)->count().'</span></a>&nbsp;':'';
					$nestedData['packages'] .= ($single->studentpackage->where('paid' ,0)->count())? '<a class="total-links-white" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->studentpackage->where('paid' ,0)->count().'</span></a>&nbsp;':'';
					$nestedData['packages'] .= '/&nbsp;<a class="total-links-black" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'student'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->studentpackage->count().'</span></a>';
				}
				
				$nestedData['coupons'] = '';
				if($single->coupon->count())
				{
					$nestedData['coupons'] .= ($single->coupon->where('done' ,1)->count())? '<a class="total-links-white" onclick="couponTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->coupon->where('done' ,1)->count().'</span></a>&nbsp;':'';
					$nestedData['coupons'] .= ($single->coupon->where('done' ,0)->count())? '<a class="total-links-white" onclick="couponTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->coupon->where('done' ,0)->count().'</span></a>&nbsp;':'';
					$nestedData['coupons'] .= '/&nbsp;<a class="total-links-black" onclick="couponTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->coupon->count().'</span></a>';
				}
				
				$nestedData['balance'] = ($user_balance->balance)? '<a class="total-links-black" onclick="balanceLogsTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".$single->image."'".')"><span class="label label-default">'.$user_balance->balance.' Hours'.'</span></a>':'';
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of count of tutors
	*/
	public function getTutorsTotal(Request $request)
    {
        $columns = array(
            0 => 'users.id', 
            1 => 'users.fname',
            2 => 'users.email',
            3 => 'users.mobile',
			4 => 'allcountry.nicename',
			5 => '',
			6 => '',
			7 => '',
			8 => '',
			9 => '',
			10 => '',
			11 => 'users.created_at',
        );
		
		$query = Instructor::leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->leftJoin('allcountry', 'users.country_id', '=', 'allcountry.id')
				->select('instructors.id as id','users.id as user_id','users.user_img as image','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','allcountry.nicename as country','users.created_at as created_at')
				->where(['users.role'=>'instructor']);

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
					$q->where('users.id', 'LIKE', "%{$search}%")
					  ->orWhere('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE',"%{$search}%")
					  ->orWhere('users.email', 'LIKE',"%{$search}%")
					  ->orWhere('users.mobile', 'LIKE',"%{$search}%")
					  ->orWhere('allcountry.nicename', 'LIKE',"%{$search}%")
					  ->orWhereDate('users.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
				$appointment_ids = Appointment::where(['instructor_id'=>$single->id])->pluck('id')->toArray();
				$bbls = BBL::whereIn('appointment_id', $appointment_ids)->get();
				$user_balance = UserTutorBalance::select(DB::raw('SUM(balance) AS balance'))->where(['user_id'=>$single->id])->first();
				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['country'] = $single->country;
				
				$nestedData['appointments'] = '';
				if($single->appointment->count())
				{
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 1)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',1)"><span class="label scheduled">'.$single->appointment->where('status_id', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 2)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',2)"><span class="label waitingConfirm">'.$single->appointment->where('status_id', 2)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 3)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',3)"><span class="label confirmed">'.$single->appointment->where('status_id', 3)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 4)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',4)"><span class="label cancelled">'.$single->appointment->where('status_id', 4)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 5)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',5)"><span class="label reserved">'.$single->appointment->where('status_id', 5)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 6)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',6)"><span class="label waitingResolution">'.$single->appointment->where('status_id', 6)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= ($single->appointment->where('status_id', 7)->count())? '<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',7)"><span class="label pendingPayment">'.$single->appointment->where('status_id', 7)->count().'</span></a>&nbsp;':'';
					$nestedData['appointments'] .= '/&nbsp;<a class="total-links-white" onclick="appointmentTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',0)"><span class="label label-default">'.$single->appointment->count().'</span></a>';
				}
				
				$nestedData['meetings'] = '';
				if($single->meeting->count())
				{
					$nestedData['meetings'] .= ($single->meeting->where('is_ended', 1)->count())? '<a class="total-links-white" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->meeting->where('is_ended', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['meetings'] .= ($single->meeting->where('is_ended', 0)->count())? '<a class="total-links-white" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->meeting->where('is_ended', 0)->count().'</span></a>&nbsp;':'';
					$nestedData['meetings'] .= '/&nbsp;<a class="total-links-black" onclick="meetingTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->meeting->count().'</span></a>';
				}
				
				$nestedData['students'] = ($single->appointment->groupBy('user_id')->count())? '<a class="total-links-black" onclick="dealwithTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".')"><span class="label label-default">'.$single->appointment->groupBy('user_id')->count().'</span></a>':'';
				$nestedData['favourites'] = ($single->favourite->count())? '<a class="total-links-black" onclick="favouriteTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".')"><span class="label label-default">'.$single->favourite->count().'</span></a>':'';
				
				$nestedData['messages'] = '';
				if($single->user && $single->user->messages_sender->count())
				{
					$nestedData['messages'] .= ($single->user->messages_sender->where('is_read', 1)->count())? '<a class="total-links-white" onclick="messageTotal('.$single->user_id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->user->messages_sender->where('is_read', 1)->count().'</span></a>&nbsp;':'';
					$nestedData['messages'] .= ($single->user->messages_sender->where('is_read', 0)->count())? '<a class="total-links-white" onclick="messageTotal('.$single->user_id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->user->messages_sender->where('is_read', 0)->count().'</span></a>&nbsp;':'';
					$nestedData['messages'] .= '/&nbsp;<a class="total-links-black" onclick="messageTotal('.$single->user_id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->user->messages_sender->count().'</span></a>';
				}
				
				$nestedData['packages'] = '';
				if($single->studentpackage->count())
				{
					$nestedData['packages'] .= ($single->studentpackage->where('paid' ,1)->count())? '<a class="total-links-white" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',1)"><span class="label cancelled">'.$single->studentpackage->where('paid' ,1)->count().'</span></a>&nbsp;':'';
					$nestedData['packages'] .= ($single->studentpackage->where('paid' ,0)->count())? '<a class="total-links-white" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',0)"><span class="label pendingPayment">'.$single->studentpackage->where('paid' ,0)->count().'</span></a>&nbsp;':'';
					$nestedData['packages'] .= '/&nbsp;<a class="total-links-black" onclick="packageTotal('.$single->id.','."'".$single->fname.' '.$single->lname."'".','."'".'tutor'."'".','."'".$single->image."'".',100)"><span class="label label-default">'.$single->studentpackage->count().'</span></a>';
				}
				
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of appointments details
	*/
	public function getAppointmentsDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'appointments.id', 
            1 => 'users.fname',
            2 => 'appointments.date',
            3 => 'appointments.start_time',
			4 => 'appointments.created_at',
        );
		
		$where = [];
		if(!empty($request->input('status')) && $request->input('status') != 0) $where['appointments.status_id'] = $request->input('status');
		if(!empty($request->input('type')) && $request->input('type') == 'tutor')
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['appointments.instructor_id'] = $request->input('userId');
			$query = Appointment::leftJoin('users', 'appointments.user_id', '=', 'users.id')
				->select('appointments.id as id','appointments.start_time as time','appointments.date as date','appointments.created_at as created_at','users.fname as fname','users.lname as lname','users.time_zone_id as time_zone')
				->where($where);
		}
		else
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['appointments.user_id'] = $request->input('userId');
			$query = Appointment::leftJoin('instructors', 'appointments.instructor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('appointments.id as id','appointments.start_time as time','appointments.date as date','appointments.created_at as created_at','users.fname as fname','users.lname as lname','users.time_zone_id as time_zone')
				->where($where);
		}

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
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('appointments.date', 'LIKE',"%{$search}%")
					  ->orWhere('appointments.start_time', 'LIKE',"%{$search}%")
					  ->orWhereDate('appointments.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
				if($single->time_zone)
				{
					$time_zone = Time_zone::find($single->time_zone);
					$slot_time_converted = Carbon::createFromFormat('Y-m-d H:i:s' , $single->date.$single->time, $time_zone->time_zone_name)->setTimezone(session('currentTimeZoneName'));
					$date = Carbon::parse($slot_time_converted)->format('Y-m-d');
					$time = Carbon::parse($slot_time_converted)->format('H:i');
				}
				else
				{
					$date = $single->date;
					$time = date('H:i', strtotime($single->time));
				}
				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['date'] = $date;
				$nestedData['time'] = $time;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of meetings details
	*/
	public function getMeetingsDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'bigbluemeetings.id', 
            1 => 'users.fname',
            2 => 'bigbluemeetings.start_time',
            3 => 'bigbluemeetings.meetingid',
			4 => 'bigbluemeetings.meetingname',
			//5 => '',
			6 => 'bigbluemeetings.created_at',
        );
		
		$where = [];
		if($request->input('status') != 100) $where['bigbluemeetings.is_ended'] = $request->input('status');
		if(!empty($request->input('type')) && $request->input('type') == 'tutor')
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['bigbluemeetings.instructor_id'] = $request->input('userId');
			$query = BBL::leftJoin('appointments', 'bigbluemeetings.appointment_id', '=', 'appointments.id')
				->leftJoin('users', 'appointments.user_id', '=', 'users.id')
				->select('bigbluemeetings.id as id','bigbluemeetings.start_time as time','bigbluemeetings.meetingid as meetingid','bigbluemeetings.meetingname as meetingname','bigbluemeetings.attendeepw as password','bigbluemeetings.created_at as created_at','users.fname as fname','users.lname as lname')
				->where($where);
		}
		else
		{
			$appointment_ids = Appointment::where(['user_id'=>$request->input('userId')])->pluck('id')->toArray();
			$query = BBL::leftJoin('instructors', 'bigbluemeetings.instructor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('bigbluemeetings.id as id','bigbluemeetings.start_time as time','bigbluemeetings.meetingid as meetingid','bigbluemeetings.meetingname as meetingname','bigbluemeetings.modpw as password','bigbluemeetings.created_at as created_at','users.fname as fname','users.lname as lname')
				->whereIn('bigbluemeetings.appointment_id', $appointment_ids)
				->where($where);
		}

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
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('bigbluemeetings.start_time', 'LIKE',"%{$search}%")
					  ->orWhere('bigbluemeetings.meetingid', 'LIKE',"%{$search}%")
					  ->orWhere('bigbluemeetings.meetingname', 'LIKE',"%{$search}%")
					  ->orWhereDate('bigbluemeetings.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['time'] = $single->time;
				$nestedData['meetingId'] = $single->meetingid;
				$nestedData['meetingName'] = $single->meetingname;
				$nestedData['password'] = $single->password;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of dealwiths details
	*/
	public function getDealwithsDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'users.id', 
            1 => 'users.fname',
            2 => 'users.email',
            3 => 'users.mobile',
			4 => 'users.created_at',
        );
		
		$where = [];
		if(!empty($request->input('type')) && $request->input('type') == 'tutor')
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['appointments.instructor_id'] = $request->input('userId');
			$query = Appointment::leftJoin('users', 'appointments.user_id', '=', 'users.id')
				->select('users.id as id','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','users.created_at as created_at')
				->groupBy('appointments.user_id')
				->where($where);
		}
		else
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['appointments.user_id'] = $request->input('userId');
			$query = Appointment::leftJoin('instructors', 'appointments.instructor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('users.id as id','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','users.created_at as created_at')
				->groupBy('appointments.instructor_id')
				->where($where);
		}

		$totalData = $query->get()->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where(function($q) use ($search) {
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('users.email', 'LIKE',"%{$search}%")
					  ->orWhere('users.mobile', 'LIKE',"%{$search}%")
					  ->orWhereDate('users.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->get()->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of favourites details
	*/
	public function getFavouritesDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'users.id', 
            1 => 'users.fname',
            2 => 'users.email',
            3 => 'users.mobile',
			4 => 'users.created_at',
        );
		
		$where = [];
		if(!empty($request->input('type')) && $request->input('type') == 'tutor')
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['favourites.instructor_id'] = $request->input('userId');
			$query = Favourites::leftJoin('users', 'favourites.user_id', '=', 'users.id')
				->select('users.id as id','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','users.created_at as created_at')
				->where($where);
		}
		else
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['favourites.user_id'] = $request->input('userId');
			$query = Favourites::leftJoin('instructors', 'favourites.instructor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('users.id as id','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','users.created_at as created_at')
				->where($where);
		}

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
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('users.email', 'LIKE',"%{$search}%")
					  ->orWhere('users.mobile', 'LIKE',"%{$search}%")
					  ->orWhereDate('users.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of messages details
	*/
	public function getMessagesDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'messenger_messages.id', 
            1 => 'users.fname',
            2 => 'messenger_threads.subject',
            3 => 'messenger_messages.body',
			4 => 'messenger_messages.created_at',
        );
		
		$where = [];
		if($request->input('status') != 100) $where['messenger_messages.is_read'] = $request->input('status');
		if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['messenger_messages.sender_id'] = $request->input('userId');
		$query = Messenger_message::leftJoin('messenger_threads', 'messenger_messages.thread_id', '=', 'messenger_threads.id')
				->leftJoin('users', 'messenger_messages.user_id', '=', 'users.id')
				->select('messenger_messages.id as id','messenger_messages.body as body','messenger_messages.created_at as created_at','messenger_threads.subject as subject','users.fname as fname','users.lname as lname')
				->where($where);

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
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('messenger_threads.subject', 'LIKE',"%{$search}%")
					  ->orWhere('messenger_messages.body', 'LIKE',"%{$search}%")
					  ->orWhereDate('messenger_messages.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
				$message = new MessagesController();
				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['subject'] = $single->subject;
				$nestedData['content'] = $message->textDiv($single->body, 55);
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of packages details
	*/
	public function getPackagesDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'student_packages.id', 
            1 => 'users.fname',
            2 => 'packages.name',
            3 => 'student_packages.numOfHours',
			4 => 'student_packages.discountPercentage',
			5 => 'student_packages.originalPricePerHour',
			6 => 'student_packages.netPrice',
			7 => 'student_packages.created_at',
        );
		
		$where = [];
		if($request->input('status') != 100) $where['student_packages.paid'] = $request->input('status');
		if(!empty($request->input('type')) && $request->input('type') == 'tutor')
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['student_packages.tutor_id'] = $request->input('userId');
			$query = Student_package::leftJoin('packages', 'student_packages.package_id', '=', 'packages.id')
				->leftJoin('users', 'student_packages.user_id', '=', 'users.id')
				->select('student_packages.id as id','packages.name as name','student_packages.numOfHours as numOfHours','student_packages.originalPricePerHour as originalPricePerHour','student_packages.discountPercentage as discountPercentage','student_packages.netPrice as netPrice','student_packages.created_at as created_at','users.fname as fname','users.lname as lname')
				->where($where);
		}
		else
		{
			if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['student_packages.user_id'] = $request->input('userId');
			$query = Student_package::leftJoin('instructors', 'student_packages.tutor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->leftJoin('packages', 'student_packages.package_id', '=', 'packages.id')
				->select('student_packages.id as id','packages.name as name','student_packages.numOfHours as numOfHours','student_packages.originalPricePerHour as originalPricePerHour','student_packages.discountPercentage as discountPercentage','student_packages.netPrice as netPrice','student_packages.created_at as created_at','users.fname as fname','users.lname as lname')
				->where($where);
		}

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
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('packages.name', 'LIKE',"%{$search}%")
					  ->orWhere('student_packages.numOfHours', 'LIKE',"%{$search}%")
					  ->orWhere('student_packages.originalPricePerHour', 'LIKE',"%{$search}%")
					  ->orWhere('student_packages.discountPercentage', 'LIKE',"%{$search}%")
					  ->orWhere('student_packages.netPrice', 'LIKE',"%{$search}%")
					  ->orWhereDate('student_packages.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['package'] = $single->name;
				$nestedData['numOfHours'] = $single->numOfHours;
				$nestedData['discountPerHour'] = $single->discountPercentage;
				$nestedData['origenalPrice'] = $single->originalPricePerHour;
				$nestedData['totalPrice'] = $single->netPrice;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of coupons details
	*/
	public function getCouponsDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'student_coupons.id', 
            1 => 'coupons.code',
            2 => 'coupons.name',
            3 => 'coupons.limitationForSingleUser',
			4 => 'coupons.distype',
			5 => 'coupons.amount',
			6 => 'student_coupons.created_at',
        );
		
		$where = [];
		if($request->input('status') != 100) $where['student_coupons.done'] = $request->input('status');
		if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['student_coupons.user_id'] = $request->input('userId');
		$query = StudentCoupon::leftJoin('coupons', 'student_coupons.coupon_id', '=', 'coupons.id')
				->select('student_coupons.id as id','student_coupons.created_at as created_at','coupons.code as code','coupons.name as name','coupons.limitationForSingleUser as limit','coupons.distype as type','coupons.amount as amount')
				->where($where);

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
					$q->where('coupons.code', 'LIKE', "%{$search}%")
					  ->orWhere('coupons.name', 'LIKE', "%{$search}%")
					  ->orWhere('coupons.limitationForSingleUser', 'LIKE',"%{$search}%")
					  ->orWhere('coupons.distype', 'LIKE',"%{$search}%")
					  ->orWhere('coupons.amount', 'LIKE',"%{$search}%")
					  ->orWhereDate('student_coupons.created_at', 'LIKE', "%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['code'] = $single->code;
				$nestedData['name'] = $single->name;
				$nestedData['limit'] = $single->limit;
				$nestedData['type'] = ($single->type == 'fix')? __('adminstaticword.fix').' '.__('adminstaticword.Amount'):__('adminstaticword.percentage');
				$nestedData['amount'] = $single->amount;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* Get all of balance logs details
	*/
	public function getBalanceLogsDetailsTotal(Request $request)
    {
        $columns = array(
            0 => 'id', 
            1 => 'balance',
            2 => 'action',
			3 => 'created_at',
        );
		
		$where = [];
		if(!empty($request->input('userId')) && $request->input('userId') != 0) $where['user_id'] = $request->input('userId');
		$query = UserTutorBalanceLog::where($where);
		
		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where('id', 'LIKE', "%{$search}%")
				->orWhere('balance', 'LIKE', "%{$search}%")
				->orWhere('action', 'LIKE',"%{$search}%")
				->orWhereDate('created_at', 'LIKE', "%{$search}%");
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['amount'] = $single->balance;
				$nestedData['action'] = $single->action;
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
}
