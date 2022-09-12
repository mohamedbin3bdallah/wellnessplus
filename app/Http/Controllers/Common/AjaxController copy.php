<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PaymentController;
use App\Appointment;
use App\Favourites;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Mail\UserAppointment;
use App\Notification;
use App\Payment_transaction;
use App\Tutor_payment_info;
use App\TutorScheduleTimeBlocks;
use App\User;
use App\UserLanguages;
use App\Cart;
use App\StudentCoupon;
use App\Coupon;
use App\BBL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;
use Image;
use DB;
use Session;
use Rave;

class AjaxController extends Controller
{
    public function index($apiName, Request $request) {
        
         if ($request->ajax()) {
            $apiResult = "";
            switch ($apiName) {
                case 'registrationSteps':
                    $apiResult = $this->registrationSteps($request);
                    break;
                case 'saveTutorFile':
                    $apiResult = $this->saveTutorFile($request);
                    break;
                case 'findTutorFilters':
                    $apiResult = $this->findTutorFilters($request);
                    break;
                case 'makeFavouriteTutor':
                    $apiResult = $this->makeFavouriteTutor($request);
                    break;
                    case 'removeFavourite':
                    $apiResult = $this->removeFavourite($request);
                    break;
                case 'confirmLesson':
                    $apiResult = $this->confirmLesson($request);
                    break;
                case 'cancelLesson':
                    $apiResult = $this->cancelLesson($request);
                    break;
                case 'checkMobileNumber':
                    $apiResult = $this->checkMobileNumber($request);
                    break;
                case 'getLessonsByDate':
                    $apiResult = $this->getLessonsByDate($request);
                    break;
                case 'calendarData':
                    $apiResult = $this->calendarData($request);
                    break;
                case 'deletePaymentInfo':
                    $apiResult = $this->deletePaymentInfo($request);
                    break;
                default :
                    return response()->json([
                        'message' => 'Faild',
                        'data' => '<p style="color:red">the ' . $apiName . ' Function Not Found</p>'
                    ]);
                    break;
            }

            return $apiResult;
        }
        return response()->json([
            'message' => 'Faild',
            'data' => '<p style="color:red">Not Allowed</p>'
        ]);
    }

    public function registrationSteps(Request $request){

        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        $input = $request->all();

        if ($file = $request->file('user_img')) {

            if($user->user_img != null && $user->user_img != 'general.png') {
                $content = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);
                if ($content) {
                    unlink(public_path().'/images/user_img/'.$user->user_img);
                }
            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $optimizePathT = public_path().'/images/instructor/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePathT.$image, 72);
            $input['user_img'] = $image;

        }



            $input['youtube_url'] = str_replace('watch?v=', 'embed/', $input['youtube_url']);
			
			if($request->country_residence) $input['country_residence_id'] = $request->country_residence;

            $user->update($input);

        if($file = $request->file('uploadVideo'))
        {
            $userId = Auth::user()->id;

            $tutor = Instructor::where('user_id', $userId)->first();
            $input = $request->uploadVideo;

            $name = time().$file->getClientOriginalName();
            $file->move('files/instructor/',$name);
            $tutor->update(['video' => $name]);
        }

            $tutor = Instructor::where('user_id', $userId)->count();
            $tutorUpdate = Instructor::where('user_id', $userId)->first();
            $social_links=implode(';',$request->social_links);
            if ($tutor == 0){
                dd($request);
                $newTutor = new Instructor();
                $newTutor->create([
                    'user_id' => $userId,
                    'PricePerHour' => $request->HourRate,
                    'headline' => $request->headline,
                    'detail' => $request->detail,
                    'file' => 0,
                    'status' => 0,
                    'country_id' => $request->country_id,
                    'work_center'=>$request->work_center,
                    'center'=>$request->center,
                    'work_hospital'=>$request->work_hospital,
                    'hospital'=>$request->hospital,

                    'work_sanatorium'=>$request->work_sanatorium,
                    'sanatorium'=>$request->wsanatorium,
                    'social_links'=>$social_links

                ]);
				$tutor_id = $newTutor->id;

                foreach ($request->Languages as $language) {
                    $userLanguage = new UserLanguages();
                    $userLanguage->create([
                        'user_id' => $userId,
                        'language_id' => $language['language'],
                        'level_id' => 8,
                        'created_by' => $userId,
                    ]);
                }
            }elseif($tutor > 0){
				$tutor_id = $tutorUpdate->id;
				//dd($request);
                $tutorUpdate->update([
                    'user_id' => $userId,
                    'PricePerHour' => $request->HourRate,
                    'headline' => $request->headline,
                    'detail' => $request->detail,
                    'file' => $file,
                    'status' => 0,
                    'country_id' => $request->country_id,
                    'work_center'=>$request->work_center,
                    'center'=>$request->center,
                    'work_hospital'=>$request->work_hospital,
                    'hospital'=>$request->hospital,

                    'work_sanatorium'=>$request->work_sanatorium,
                    'sanatorium'=>$request->wsanatorium,
                    'social_links'=>$social_links
                ]);
				
				 UserLanguages::where(['user_id'=>$userId])->delete();
				 foreach ($request->Languages as $language) {
                    $userLanguage = new UserLanguages();
                    $userLanguage->create([
                        'user_id' => $userId,
                        'language_id' => $language['language'],
                        'level_id' => 8,
                        'created_by' => $userId,
                    ]);
                }
            }
			
            if ($request->time_zone_id != null) {

                if ($request->Sunday != null) {
                    foreach ($request->Sunday as $slot) {

                        $timeBlocks = new TutorScheduleTimeBlocks();
                        $timeBlocks->create([
                            'user_id' => $userId,
                            'zone' => $request->time_zone_id,
                            'start_time' => $slot,
                            'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                            'day' => 'Sunday',
                        ]);}
                }
                if ($request->Monday != null) {

                    foreach ($request->Monday as $slot) {

                        $timeBlocks = new TutorScheduleTimeBlocks();
                        $timeBlocks->create([
                            'user_id' => $userId,
                            'zone' => $request->time_zone_id,
                            'start_time' => $slot,
                            'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                            'day' => 'Monday',
                        ]);
                    }
                }
                 if ($request->Tuesday != null){
                    foreach ($request->Tuesday as $slot) {

                        $timeBlocks = new TutorScheduleTimeBlocks();
                        $timeBlocks->create([
                            'user_id' => $userId,
                            'zone' => $request->time_zone_id,
                            'start_time' => $slot,
                            'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                            'day' => 'Tuesday',
                        ]);}
                 }
                 if ($request->Wednesday != null){
                 foreach ($request->Wednesday as $slot) {

                     $timeBlocks = new TutorScheduleTimeBlocks();
                     $timeBlocks->create([
                         'user_id' => $userId,
                         'zone' => $request->time_zone_id,
                         'start_time' => $slot,
                         'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                         'day' => 'Wednesday',
                     ]);}
                 }
                 if ($request->Thursday != null){
                 foreach ($request->Thursday as $slot) {

                     $timeBlocks = new TutorScheduleTimeBlocks();
                     $timeBlocks->create([
                         'user_id' => $userId,
                         'zone' => $request->time_zone_id,
                         'start_time' => $slot,
                         'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                         'day' => 'Thursday',
                     ]);
                 }
                 }
                 if ($request->Friday != null){
                 foreach ($request->Friday as $slot) {

                     $timeBlocks = new TutorScheduleTimeBlocks();
                     $timeBlocks->create([
                         'user_id' => $userId,
                         'zone' => $request->time_zone_id,
                         'start_time' => $slot,
                         'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                         'day' => 'Friday',
                     ]);}
                 }
                 if ($request->Saturday!= null){
                 foreach ($request->Saturday as $slot) {

                    $timeBlocks = new TutorScheduleTimeBlocks();
                    $timeBlocks->create([
                        'user_id' => $userId,
                        'zone' => $request->time_zone_id,
                        'start_time' => $slot,
                        'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                        'day' => 'Saturday',
                    ]);}
                }
            }


        return [$user, $tutorUpdate];
    }

    public function checkMobileNumber(Request $request){

        $oldMobile = User::where('mobile', $request->number)->count();

        return $oldMobile;
    }

    public function saveTutorFile(Request $request){
        if($file = $request->file('file'))
        {
            $userId = Auth::user()->id;

            $tutor = Instructor::where('user_id', $userId)->first();
            $input = $request->file;

            $name = time().$file->getClientOriginalName();
            $file->move('files/instructor/',$name);
        }
        $tutor->update(['file' => $name]);
        return $tutor;
    }

    public function findTutorFilters(Request $request){

        $tutors = Instructor::with('user','languages', 'schedule', 'reviews', 'bookedSlots')
            ->where('instructors.status', 1)
            ->join('users', 'users.id', '=', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', '=', 'users.country_id');
        if ($request->countries != null){
            $tutors = $tutors->whereIn('users.country_id', $request->countries);

        }

        if ($request->from != null){
            $tutors = $tutors->where('instructors.pricePerHour','>=', str_replace(' USD', '',$request->from));
        }

        if ($request->to != null){
            $tutors = $tutors->where('instructors.pricePerHour','<=', str_replace(' USD', '',$request->to));
        }


        if ($request->specialties != null && !in_array('1', $request->specialties)){
            $tutors = $tutors->whereIn('instructors.specialty', $request->specialties);
        }

        if ($request->languages != null){
            $tutors = $tutors->whereIn('user_language.language_id', $request->languages);

        }
        if ($request->sort != null){
            if ($request->sort == "highestPrice") {
                $tutors = $tutors->orderBy('instructors.PricePerHour', 'desc');
            }elseif($request->sort == "lowestPrice"){
                $tutors = $tutors->orderBy('instructors.PricePerHour', 'asc');

            }
        }
        if ($request->searchWord != null){
            $tutors = $tutors->where('users.fname', 'like','%' . $request->searchWord . '%')
                ->orWhere('instructors.detail', 'like', '%'. $request->searchWord . '%')
                ->orWhere('instructors.headLine', 'like', '%'. $request->searchWord . '%');

        }
        if (isset($request->nativeSpeaker)){
            $tutors = $tutors->where('user_language.level_id', 1);
        }

        if ($request->checkedTimes != null){
            $times = explode('-', $request->checkedTimes);
            $startTime = date("H:i:00", strtotime("$times[0]". Session('currentTimeZoneHour') . ' hour '. Session('currentTimeMinutes') . ' minutes'));
            $endTime = date("H:i:00", strtotime(" end($times)". Session('currentTimeZoneHour') . ' hour '. Session('currentTimeMinutes') . ' minutes'));

            $tutors = $tutors->where('tutor_schedule_time_blocks.start_time','>=', $startTime);
            $tutors = $tutors->where('tutor_schedule_time_blocks.start_time','<=', $endTime);

        }

        if ($request->checkedDays != null){
            $days = explode(',', $request->checkedDays);
            $tutors = $tutors->whereIn('tutor_schedule_time_blocks.day', $days);

        }

        $tutors = $tutors
            ->leftJoin('user_language', 'user_language.user_id', '=', 'instructors.user_id')
            ->leftJoin('all_languages', 'all_languages.id', '=', 'user_language.language_id')
            ->leftJoin('specialties', 'specialties.id', '=', 'instructors.specialty')
            ->leftJoin('tutor_schedule_time_blocks', 'tutor_schedule_time_blocks.user_id', 'instructors.user_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('instructors.id')->get();

        return $tutors;

    }


    public function makeFavouriteTutor(Request $request){
        $user_id = auth()->user()->id;

        if ($user_id != null) {

            $userFavourite = new Favourites();
            $userFavourite->create([
                'user_id' => $user_id,
                'instructor_id' => $request->tutor_id
            ]);
        }
        return true;
    }


    public function removeFavourite(Request $request){

        $favouriteTutor = Favourites::where('instructor_id', $request->tutor_id)
            ->where('user_id', auth()->id())->first();

        $favouriteTutor->delete();
        return true;
        //        dd($favouriteTutor);

    }

    public function confirmLesson(Request $request){
        //        dd($request->all());

        $appointment = Appointment::with('user')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->join('users', 'users.id', 'instructors.user_id')
            ->where('appointments.id', $request->record_id)
            ->select('appointments.*', 'users.fname', 'users.lname', 'users.email')
            ->first();
        $appointment->update(['status_id' => 3]);

        if(env('MAIL_USERNAME')!=null) {
            try{

                /*sending email*/
                $request = $appointment;
                $x = 'Kindly be informed that your student ('.$request->user->fname.' '. $request->user->lname.')  reviewed you';
        //                $y = 'Kindly be informed that your lesson with tutor ('.$request->fname.' '. $request->lname.') at ('.$request->start_time.') on ('.$request->date.') has been confirmed';
        //                    dd($request->user);
                Mail::to($request->email)->send(new UserAppointment($x, $request, 0));
        //                Mail::to($appointment->user->email)->send(new UserAppointment($y, $request));

                $notification2 = new Notification;
                $notification2->type = 6;
                $notification2->notifiable_type  = "Instructor" ;
                $notification2->notifiable_id  = auth()->id();
                $notification2->data  = "You just booked a session";
                $notification2->save();

            }catch(\Swift_TransportException $e){
                return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
            }

        }
        return $appointment;
    }

    public function cancelLesson(Request $request){

        $appointment = Appointment::with('user')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->join('users', 'users.id', 'instructors.user_id')
            ->where('appointments.id', $request->record_id)
            ->select('appointments.*', 'users.fname', 'users.lname', 'users.email')
            ->first();

        $now = \Carbon\Carbon::now();
        $appointmentDate = \Carbon\Carbon::parse($appointment->date);

        $totalDays = $now->diffInDays($appointmentDate, false);


        if($totalDays < 1 && $appointment->status_id !=7){
        //            return "Error: You can't cancel this lesson as the different between today and the lesson date is less than 3 days";
            //return json_encode(['Error'=> "Error: You can't cancel this lesson as the different between today and the lesson date is less than 3 days"]);
			return json_encode(['Error'=> "Error: You can't cancel this lesson as the different between today and the lesson date is less than 1 day"]);

        }

        if($appointment->status_id ==5 || $appointment->status_id ==1){
			$paymentTransaction = Payment_transaction::find($appointment->payment_transaction_id);
			if($paymentTransaction)
            {
				if($paymentTransaction->payment_method == 'flutterwave')
				{
					$request->merge(['ref'=>$appointment->payment_transaction->transaction_ref]);
					$data = Rave::refund($request);
					if($data->status !='success'){
						return json_encode(['Error'=> "Cannot refund this lesson (".$data->data.")"]);
					}
					$paymentTransaction->refund_details=json_decode($data);
				}
				elseif($paymentTransaction && $paymentTransaction->payment_method == 'myfatoora')
				{
					$data = PaymentController::refund($paymentTransaction->vendor_transaction_id, $paymentTransaction->amount);
					if($data->IsSuccess != 1){
						return json_encode(['Error'=> "Cannot refund this lesson (".$data->Message.")"]);
					}
					$paymentTransaction->refund_details = $data->Message;
				}
				$paymentTransaction->refund=1;
				$paymentTransaction->save();
			}
        }

        $appointment->update(['status_id' => 4]);
		$cart = Cart::where(['appointment_id'=>$appointment->id])->delete();
		$bbl = BBL::where(['appointment_id'=>$appointment->id])->delete();
		$studentCoupon = StudentCoupon::where(['appointment_id'=>$appointment->id])->first();
		if($studentCoupon)
		{
			Coupon::where(['id'=>$studentCoupon->coupon_id])->update(['maxusage'=>DB::raw('maxusage+1')]);
			$studentCoupon->delete();
		}
		
		/*
		** Tutor Commission
		*/
		CommissionController::deleteTutorCommission($request->record_id,$request->tutor_id);
        if(env('MAIL_USERNAME')!=null)
		{
			$email = new \App\Http\Controllers\EmailAppointmentController($appointment->id);
			$email->cancel();
        }
        return 1;
    }


    public function getLessonsByDate(Request $request){

        $date = strtotime(substr($request->date, 4, 11));
        $date =date('Y-m-d', $date);
        if(Auth::User()->role == "user") {
            return Appointment::where('appointments.user_id', auth()->id())
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('instructors', 'instructors.id', '=', 'appointments.instructor_id')
                ->join('users', 'users.id', '=', 'instructors.user_id')
                ->where('appointments.status_id', '=',1)
                ->where('appointments.date', '=', $date)
                ->select('users.fname', 'users.lname', 'users.user_img', 'appointments.start_time', 'appointments.date')
                ->get();
        }else{
            $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

            return Appointment::where('appointments.instructor_id', $tutor->id)
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->where('appointments.status_id', '=', 1)
                ->where('appointments.date', '=', $date)
                ->select('users.fname', 'users.lname', 'users.user_img', 'appointments.start_time', 'appointments.date')
                ->get();

        }

    }

    public function calendarData(Request $request){

        if(\auth()->id()) {
            $tutor = Instructor::where('user_id', \auth()->id())->first();
            if ($tutor != null) {

                $data = Appointment::where('instructor_id', $tutor->id)
                    ->join('users', 'users.id', 'appointments.user_id')
                    ->get();

                return $data;
            }
        }

    }

    public function deletePaymentInfo(Request $request){

        $tutorPaymentInfo = Tutor_payment_info::where('id', $request->id)->first();

        $tutorPaymentInfo->delete();

        return true;
    }



}

