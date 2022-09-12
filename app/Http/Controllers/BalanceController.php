<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommissionController;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\Appointment;
use App\UserOrganization;
use App\PartnerStudent;
use App\TutorCommission;
use App\TutorCommissionLog;
use App\BBL;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\UserAppointment;
use Session;
use DB;
class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($package,$tutor)
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
    public function update(Request $request)
    {
		$usertutorbalance = UserTutorBalance::where(['user_id'=>Auth::user()->id,'tutor_id'=>$request->tutor])->first();
		if($usertutorbalance && $usertutorbalance->balance > 0)
		{
			$usertutorbalance->update([
				'balance' => $usertutorbalance->balance - 1,
				'updated_by' => Auth::user()->id,
			]);
			
			$usertutorbalancelog = new UserTutorBalanceLog();
			$usertutorbalancelog->create([
				'user_id' => Auth::user()->id,
				'tutor_id' => $request->tutor,
				'balance' => -1,
				'action' => 'appointment',
				'created_by' => Auth::user()->id,
			]);
			
			$appointment = Appointment::find($request->appointment);
			$appointment->update([
				'status_id' => 1,
			]);
			
			// create bbb meeting record

            $meetingid = random_int(1000000, 1000000000000);

            $bigBlueController = new BigBlueController();
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
			
            if(env('MAIL_USERNAME')!=null)
			{
                $email = new EmailAppointmentController($appointmentRecord->id);
				$email->confirm($meetingRecord->id);
            }
			
			/*
			** Tutor Commission
			*/
			CommissionController::tutorCommission($request->appointment,$appointment->instructor->id);
			
			Session::flash('success',__('backend.action_done_successfully'));
			return redirect('/mylessons/'.\Auth::user()->id);
		}
		else
		{
			Session::flash('error',__('backend.you_dont_have_balance'));
            return redirect('/mylessons/'.\Auth::user()->id);
		}
	}
	
	/*
	* Update Slots Balance
	*/
	public function updateSlots(Request $request)
    {
		$appointment_ids = explode('_', $request->appointment);
		$usertutorbalance = UserTutorBalance::where(['user_id'=>Auth::user()->id,'tutor_id'=>$request->tutor])->first();
		if($usertutorbalance && $usertutorbalance->balance >= count($appointment_ids))
		{
			$usertutorbalance->update([
				'balance' => $usertutorbalance->balance - count($appointment_ids),
				'updated_by' => Auth::user()->id,
			]);
			
			foreach($appointment_ids as $appointment_id)
			{
			$usertutorbalancelog = new UserTutorBalanceLog();
			$usertutorbalancelog->create([
				'user_id' => Auth::user()->id,
				'tutor_id' => $usertutorbalance->tutor_id,
				'balance' => -1,
				'action' => 'appointment',
				'created_by' => Auth::user()->id,
			]);
			
			$appointment = Appointment::find($appointment_id);
			$appointment->update([
				'status_id' => 1,
			]);
			

            $meetingid = random_int(1000000, 1000000000000);

            $bigBlueController = new BigBlueController();
			$bbbRequest = new Request();
            $bbbRequest->merge(['presen_name' =>$appointment->instructor->user->fname.' '. $appointment->instructor->user->lname]);
            $bbbRequest->merge(['meetingid' =>$meetingid]);
            $bbbRequest->merge(['meetingname' =>__('backend.meeting_meetingname', ['tutor_fname'=>$appointment->instructor->user->fname, 'tutor_lname'=>$appointment->instructor->user->lname, 'student_fname'=>$appointment->user->fname, 'student_lname'=>$appointment->user->lname])]);
            $bbbRequest->merge(['detail' =>'<b>'.__('backend.meeting_detail', ['tutor_fname'=>$appointment->instructor->user->fname, 'tutor_lname'=>$appointment->instructor->user->lname, 'student_fname'=>$appointment->user->fname, 'student_lname'=>$appointment->user->lname]).'</b>']);
            $bbbRequest->merge(['duration' =>60]);
            $bbbRequest->merge(['start_time' =>$appointment->date. ' '. $appointment->start_time]);
            $bbbRequest->merge(['modpw' =>random_int(100000, 999999)]);
            $bbbRequest->merge(['attendeepw' =>random_int(100000, 999999)]);
            $bbbRequest->merge(['welcomemsg' =>'Welcome to WellnessPlus Class Room']);
            $bbbRequest->merge(['setMaxParticipants' =>2]);
            $bbbRequest->merge(['setMuteOnStart' =>0]);
            $bbbRequest->merge(['appointment_id' =>$appointment->id]);


            $meetingCreation = $bigBlueController->store($bbbRequest);
            $meetingRecord  = BBL::where('meetingid', $meetingid)->first();
			
			if(env('MAIL_USERNAME')!=null)
			{
				$email = new EmailAppointmentController($appointment->id);
				$email->balance($meetingRecord->id);
			}
			
			CommissionController::tutorCommission($appointment_id,$appointment->instructor->id);
			}
			
			Session::flash('success',__('backend.action_done_successfully'));
			return redirect('/mylessons/'.\Auth::user()->id);
		}
		else
		{
            return back()->with('error', __('backend.you_dont_have_balance'));
		}
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
