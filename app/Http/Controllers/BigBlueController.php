<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Mail\UserAppointment;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\BBL;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use Auth;
use Crypt;
use App\Course;
use App\StudentCoupon;
use App\Payment_transaction;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\Coupon;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Mail;
use DB;

class BigBlueController extends Controller
{


    public function index(){
        $meetings = (Auth::user()->role == 'partner')? BBL::with('tutor', 'appointment', 'partnertutor')->orderBy('id','DESC')->wherehas('partnertutor', function($query) { $query->where('partner_id', Auth::user()->id); })->get():BBL::with('tutor', 'appointment')->orderBy('id','DESC')->get();
//    	dd($meetings);
        return view('bbl.index',compact('meetings'));
    }

    public function create(){
        return view('bbl.create');
    }

    public function edit($meetingid){
        $meeting = BBL::findorfail($meetingid);
        return view('bbl.edit',compact('meeting'));
    }

    public function store(Request $request){

        $newmeeting = new BBL;
        $input = $request->all();

        $appointment = Appointment::where('appointments.id', $request->appointment_id)->select('appointments.instructor_id')->first();


        $allmeeting = BBL::where('is_ended','!=',1)->get();

        foreach ($allmeeting as $key => $met) {
            if($request->meetingid == $met->meetingid){
                return back()->with('delete',__('backend.meeting_is_already_active_with_this_name'))->withInput();
            }
        }

        if($request->modpw == $request->attendeepw){
            return back()->with('delete',__('backend.attandee_password_and_moderator_password_cannot_be_same'))->withInput();
        }

        if(isset($request->setMuteOnStart)){
            $input['setMuteOnStart'] = 1;
        }else{
            $input['setMuteOnStart'] = 0;
        }

        if(isset($appointment->instructor_id)){
            $input['status'] = 1;
        }else{
            if(isset($request->status)){
                $input['status'] = 1;
            }else{
                $input['status'] = 0;
            }
        }


        if(isset($request->allow_record)){
            $input['allow_record'] = 1;
        }else{
            $input['allow_record'] = 0;
        }

        if($request->setMaxParticipants == ''){
            $input['setMaxParticipants'] = '-1';
        }

        if(isset($request->disable_chat)){
            $input['disable_chat'] = 1;
        }else{
            $input['disable_chat'] = 0;
        }

        if(isset($request->link_by))
        {
            $input['link_by'] = 'course';
            $input['course_id'] = $request['course_id'];
        }
        else
        {
            $input['link_by'] = NULL;
            $input['course_id'] = NULL;
        }

        $input['instructor_id']	= $appointment->instructor_id ?? 0;


        $newmeeting->create($input);
        if($appointment){
            $appointment->update(["status_id" => 3]);
        }

        return redirect()->route('bbl.all.meeting')->with('success',__('backend.created_successfully'));
    }

    public function update(Request $request,$id){
        $newmeeting = BBL::findorfail($id);
        $input = $request->all();

        if($request->modpw == $request->attendeepw){
            return back()->with('delete',__('backend.attandee_password_and_moderator_password_cannot_be_same'))->withInput();
        }

        if(isset($request->setMuteOnStart)){
            $input['setMuteOnStart'] = 1;
        }else{
            $input['setMuteOnStart'] = 0;
        }

        if(isset($request->allow_record)){
            $input['allow_record'] = 1;
        }else{
            $input['allow_record'] = 0;
        }

        if($request->setMaxParticipants == ''){
            $input['setMaxParticipants'] = '-1';
        }

        if(isset($request->disable_chat)){
            $input['disable_chat'] = 1;
        }else{
            $input['disable_chat'] = 0;
        }

        if(isset($request->link_by))
        {
            $input['link_by'] = 'course';
            $input['course_id'] = $request['course_id'];
        }
        else
        {
            $input['link_by'] = NULL;
            $input['course_id'] = NULL;
        }

        if(isset($appointment->instructor_id)){
            $input['status'] = 1;
        }else{
            if(isset($request->status)){
                $input['status'] = 1;
            }else{
                $input['status'] = 0;
            }
        }

        $newmeeting->update($input);
        return redirect()->route('bbl.all.meeting')->with('success',__('backend.updated_successfully'));
    }

    public function delete($meetingid){
        $meeting = BBL::find($meetingid);

        if(isset($meeting)){
			$appointment = Appointment::find($meeting->appointment_id);
			if(isset($appointment))
			{
				if($appointment->payment_transaction_id)
				{
					Payment_transaction::where(['id'=>$appointment->payment_transaction_id])->delete();
				}
				else
				{
					$student_coupon = StudentCoupon::where('appointment_id', $appointment->id)->first();
					if(isset($student_coupon))
					{
						Coupon::where(['id'=>$student_coupon->coupon_id])->update(['maxusage'=>DB::raw('maxusage+1')]);
						$student_coupon->delete();
					}
					else
					{
						UserTutorBalanceLog::where(['user_id'=>$appointment->user_id, 'tutor_id'=>$appointment->instructor_id, 'balance'=>'-1', 'action'=>'appointment'])->orderBy('id', 'DESC')->first()->delete();
						UserTutorBalance::where(['user_id'=>$appointment->user_id, 'tutor_id'=>$appointment->instructor_id])->update(['balance'=>DB::raw('balance+1')]);
					}
				}
				$appointment->delete();
			}
			$meeting->delete();
            return back()->with('deleted',__('backend.deleted_successfully'));
        }else{
            return back()->with('deleted',__('backend.record_not_found'));
        }
    }

    public function setting(Request $request){

        $env_update = $this->changeEnv([

            'BBB_SECURITY_SALT' => $request->BBB_SECURITY_SALT,
            'BBB_SERVER_BASE_URL' => $request->BBB_SERVER_BASE_URL

        ]);

        if($env_update){
            return back()->with('success',__('backend.updated_successfully'));
        }else{
            return back()->with('deleted',__('backend.please_try_again'));
        }
    }

    public function apiCreate($id){


        $bbb = new BigBlueButton();
        $m = BBL::find($id);
        if(!$m){
            return back()->with('error', __('backend.record_not_found'));

        }

        if($m->status == 0){
            return back()->with('error', __('backend.record_not_enabled'));

        }


        $appointment = Appointment::with('instructor', 'user')->where('id', $m->appointment_id)->first();


        $sessionPassed = 0;
        if($m->instructor_id != 0) {

            if(!$appointment){
                return back()->with('error', __('backend.record_not_valid'));

            }

            $instructorId = Auth::user()->instructor->id ?? '';
            if( $instructorId != $appointment->instructor_id && Auth::user()->id  != $appointment->user_id){
                //dd("Meeting Not Enabled");

                return back()->with('error', __('backend.you_are_not_a_part_of_this_meeting'));

            }

            // get tutor time zone
            $time_zone = \App\Time_zone::find($appointment->time_zone_id);
            // get slot time format to conver it

            $slot_time = date(" H:i:s", strtotime("$appointment->start_time"));
            // convert from time zone to time zone saved in session
            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . $slot_time, $time_zone->time_zone_name)
                ->setTimezone(session('currentTimeZoneName'));
            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i:s');


            $min15 = Carbon::now(session('currentTimeZoneName'))->subMinutes(30)->format('Y-m-d H:i:s');
//        dd($min15);
            $plus15 = Carbon::now(session('currentTimeZoneName'))->addMinutes(15)->format('Y-m-d H:i:s');


            if($appointment->date < date('Y-m-d')){
                $sessionPassed = 1;
                return view('frontend.lessonHasnotStarted', compact('appointment', 'sessionPassed'));

            }
            if ($plus15 < $appointment->date . ' ' . $correct_time || $appointment->date . ' ' . $correct_time < $min15) {
                if($appointment->date . ' ' . $correct_time < $min15){
                    $sessionPassed = 1;
                }else{
                    $sessionPassed = 0;
                }

                return view('frontend.lessonHasnotStarted', compact('appointment', 'sessionPassed'));

            }


            $appointment->update(["status_id" => 3]);

            /*try {

                $appointment = Appointment::with('instructor', 'user')->where('id', $m->appointment_id)->first();

                $request = $appointment;
                $request['review'] = 'reviewMail';
                $y = 'Hello (' . $request->user->fname . ' ' . $request->user->lname . ') Kindly be informed that your lesson with Tutor (' . $request->instructor->user->fname . ' ' . $request->instructor->user->lname . ')is Done If you Need anything else , please just let us Know..';

                Mail::to($appointment->user->email)->send(new UserAppointment($y, $request, $request->instructor_id));

                $notification2 = new Notification;
                $notification2->type = 6;
                $notification2->notifiable_type = "student";
                $notification2->notifiable_id = $appointment->user->id;
                $notification2->data = "Lesson ended";
                $notification2->save();

            } catch (\Swift_TransportException $e) {
                return back()->with('success', 'Lesson ended  Successfully ! but Mail will not sent because of error in mail configuration !');
            }*/

        }
        $minutes_to_add = $m->duration;

        $time = new DateTime($m->start_time);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

        $stamp = $time->format('Y-m-d H:i:00');

        $currentDate = date('Y-m-d H:i:00');

        // if($stamp < $currentDate){
        //     return back()->with('delete','Meeting is already ended !');
        // }


        $userid = Crypt::encrypt(Auth::user()->id ?? 0);
        $meetingid = Crypt::encrypt($m->meetingid);
        $urlLogout = url('/bigblue/api/callback?meetingID='.$meetingid.'&user='.$userid);
        $createMeetingParams = new CreateMeetingParameters($m->meetingid, $m->meetingname);
        $createMeetingParams->setAttendeePassword($m->attendeepw);
        $createMeetingParams->setModeratorPassword($m->modpw);
        $createMeetingParams->setDuration($m->duration);
        $createMeetingParams->setMaxParticipants($m->setMaxParticipants);
        $createMeetingParams->setMuteOnStart($m->setMuteOnStart == 0 ? false : true);
        $createMeetingParams->setCopyright(date('Y').' | '.config('app.name'));

        if($m->welcomemsg != ''){
            $createMeetingParams->setWelcomeMessage($m->welcomemsg);
        }

        $createMeetingParams->setWebcamsOnlyForModerator(true);

        $createMeetingParams->setRecord($m->allow_record == 0 ? false : true);
        $createMeetingParams->setAllowStartStopRecording($m->allow_record == 0 ? false : true);
        $createMeetingParams->setAutoStartRecording($m->allow_record == 0 ? false : true);
        $createMeetingParams->setLogoutUrl($urlLogout);
        $createMeetingParams->joinViaHtml5(true);

        $response = $bbb->createMeeting($createMeetingParams);

        if ($response->getReturnCode() == 'FAILED') {
            //dd($response);
            return __('backend.cant_create_room_please_contact_our_administrator');

        } else {

            $joinMeetingParams = new JoinMeetingParameters($m->meetingid, $m->meetingname, $m->modpw);
            $joinMeetingParams->setUsername(Auth::user()->fname ?? 'WellnessPlus Guest' . ' ' . isset(Auth::user()->lname) ?? '');
            $joinMeetingParams->setRedirect(true);
            $joinMeetingParams->setJoinViaHtml5(true);
            $url = $bbb->getJoinMeetingURL($joinMeetingParams);
            return redirect($url);
        }


    }

    public function logout(Request $request){

        $userid = Crypt::decrypt($request->user);
        $meetingid = Crypt::decrypt($request->meetingID);
        $findmeeting = BBL::where('meetingid','=',$meetingid)->first();
        $appointment = Appointment::where('id', $findmeeting->appointment_id)->first();
        if(isset($findmeeting)){

            if($findmeeting->instructor_id == Auth::user()->id){
                $findmeeting->is_ended = 1;
                $findmeeting->save();

                $bbb = new BigBlueButton();

                $endMeetingParams = new EndMeetingParameters($meetingid, $findmeeting->modpw);
                $response = $bbb->endMeeting($endMeetingParams);
//                if(env('MAIL_USERNAME')!=null) {
//                     try{
//
//                        /*sending email*/
//                        $request = $appointment;
//                        $y = 'Kindly be informed that your lesson with tutor ('.$request->fname.' '. $request->lname.') has been ended, please rate the tutor here'. 'https://arabie.live/tutor/page/'.$appointment->instructor_id;
////                    dd($request->user);
//                        Mail::to($appointment->user->email)->send(new UserAppointment($y, $request, 0));
//
//                        $notification2 = new Notification;
//                        $notification2->type = 6;
//                        $notification2->notifiable_type  = "student" ;
//                        $notification2->notifiable_id  = $appointment->user->id;
//                        $notification2->data  = "Lesson ended";
//                        $notification2->save();
//
//                    }catch(\Swift_TransportException $e){
//                        return back()->with('success','Lesson ended  Successfully ! but Mail will not sent because of error in mail configuration !');
//                    }

//                }
                return redirect('/')->with('success',__('backend.meeting_ended_successfully'));
            }else{
                return redirect('/')->with('success',__('backend.you_logout_from_meeting_successfully'));
            }

        }else{
            return redirect()->with('delete',__('backend.no_meeting_exist_with_this_id'));
        }


    }
	
	/*
	** End Meeting
	*/
	public function endMeeting(Request $request){

        $userid = Crypt::decrypt($request->user);
        $meetingid = Crypt::decrypt($request->meetingID);
        $findmeeting = BBL::where('meetingid','=',$meetingid)->first();
		$appointment = Appointment::where('id', $findmeeting->appointment_id)->first();
		
		$bbb = new BigBlueButton();
        $endMeetingParams = new EndMeetingParameters($meetingid, $findmeeting->modpw);
        $response = $bbb->endMeeting($endMeetingParams);
		//echo '<pre>'; print_r($response); echo '</pre>';
		
		if ($response->getReturnCode() != 'SUCCESS')
		{
			return redirect('/')->with('delete',__('backend.cant_end_this_meeting'));
        }
		
        if(isset($findmeeting))
		{
            $findmeeting->is_ended = 1;
            $findmeeting->save();

			if(env('MAIL_USERNAME')!=null)
			{
				$email = new EmailAppointmentController($appointment->id);
				$email->endMeeting($appointment->instructor_id);
            }
			
			$notification2 = new Notification;
			$notification2->type = 6;
			$notification2->notifiable_type = "student";
			$notification2->notifiable_id = $appointment->user->id;
			$notification2->data = __('backend.lesson_ended');
			$notification2->save();
			
            return redirect('/')->with('success',__('backend.meeting_ended_successfully'));
        }
		else
		{
            return redirect()->with('delete',__('backend.no_meeting_exist_with_this_id'));
        }
    }

    public function joinview($meetingid){
        $m = BBL::where('meetingid',$meetingid)->first();
        if($m){
            return view('bbl.joinmeeting',compact('m'));
        }else{
            return back()->with('deleted',__('backend.record_not_found'));
        }
    }

    public function apiJoin(Request $request){

        $bbb = new BigBlueButton();
        $m = BBL::where('meetingid',$request->meetingid)->first();

        if($m){

            $minutes_to_add = $m->duration;

            $time = new DateTime($m->start_time);
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

            $stamp = $time->format('Y-m-d H:i:00');

            $currentDate = date('Y-m-d H:i:00');

            if($stamp < $currentDate){
                return back()->with('delete',__('backend.meeting_is_already_ended'))->withInput($request->except('password'));
            }

            if($request->password != $m->attendeepw){
                return back()->with('delete',__('backend.invalid_password_please_try_again'))->withInput($request->except('password'));
            }

            if($m->is_ended == 1){
                return back()->with('delete',__('backend.meeting_is_already_ended'))->withInput($request->except('password'));
            }


            $joinMeetingParams = new JoinMeetingParameters($m->meetingid, $m->meetingname, $request->password);
            $joinMeetingParams->setUsername(Auth::user()->fname . ' ' . Auth::user()->lname);
            $joinMeetingParams->setRedirect(true);
            $url = $bbb->getJoinMeetingURL($joinMeetingParams);
            return redirect($url);
        }else{
            return back()->with('delete','Meeting not found !');
        }

    }

    public function detailpage(Request $request, $id)
    {
        $bbl = BBL::where('id', $id)->where('is_ended','!=',1)->first();
        if(!$bbl){
            return redirect('/')->with('delete',__('backend.meeting_is_ended'));
        }
        return view('front.bbl_detail', compact('bbl'));
    }




    protected function changeEnv($data = array())
    {
        if ( count($data) > 0 ) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){
                // Loop through .env-data
                foreach($env as $env_key => $env_value){
                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;

        } else {

            return false;
        }
    }


    public function getRecordingsAnchor (){
        $recordingParams = new GetRecordingsParameters();
        $bbb = new BigBlueButton();
        $response = $bbb->getRecordings($recordingParams);
        dd($response);
        if ($response->getReturnCode() == 'SUCCESS') {
            foreach ($response->getRawXml()->recordings->recording as $recording) {
                // process all recording
            }
        }
    }
}
