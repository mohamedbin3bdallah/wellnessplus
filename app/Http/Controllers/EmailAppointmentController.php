<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Time_zone;
use App\Setting;
use Carbon\Carbon;
use App\Mail\UserAppointment;
use Mail;
use Illuminate\Http\Request;
use Auth;

class EmailAppointmentController extends Controller
{
	protected $appointment;
	protected $correct_time_student;
	protected $correct_date_student;
	protected $correct_time_tutor;
	protected $correct_date_tutor;
	
    public function __construct($appointmentId)
    {
        //return $this->middleware('auth');
		$this->appointment->settings = Setting::find(1);
		
		$this->appointment = Appointment::find($appointmentId);
		$slot_time = date(" H:i:s", strtotime($this->appointment->start_time));
		
		$time_zone_id_student = ($this->appointment->user->time_zone_id)? $this->appointment->user->time_zone_id:387;
		$time_zone_id_tutor = ($this->appointment->instructor->user->time_zone_id)? $this->appointment->instructor->user->time_zone_id:387;
		
		$time_zone_student = Time_zone::find($time_zone_id_student);
		$slot_time_converted_student = Carbon::createFromFormat('Y-m-d H:i:s' , $this->appointment->date.$slot_time, $time_zone_student->time_zone_name)->setTimezone(session('currentTimeZoneName'));
		$this->correct_time_student = Carbon::parse($slot_time_converted_student)->format('H:i');
		$this->correct_date_student = Carbon::parse($slot_time_converted_student)->format('Y-m-d');
		
		$time_zone_tutor = Time_zone::find($time_zone_id_tutor);
		$slot_time_converted_tutor = Carbon::createFromFormat('Y-m-d H:i:s' , $this->appointment->date.$slot_time, $time_zone_tutor->time_zone_name)->setTimezone(session('currentTimeZoneName'));
		$this->correct_time_tutor = Carbon::parse($slot_time_converted_tutor)->format('H:i');
		$this->correct_date_tutor = Carbon::parse($slot_time_converted_tutor)->format('Y-m-d');
    }
    
	/**
     * Book Appointment Email
     */
    public function book()
    {
		$this->appointment->action = 'bookAppointment';
			
		try
		{
			$x = __('backend.bookAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.bookAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
               
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, 0));
            Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, 0));
        }
		catch(\Swift_TransportException $e)
		{
            //return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
        }
    }
	
	/**
     * Free Appointment Email
     */
    public function free($meetingId)
    {
		$this->appointment->action = 'freeAppointment';
            
		try
		{
			$x = __('backend.freeAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.freeAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
				
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, $meetingId));
			Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, $meetingId));
		}
		catch(\Swift_TransportException $e)
		{
			return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
		}
    }
	
	/**
     * Balance Appointment Email
     */
    public function balance($meetingId)
    {
		$this->appointment->action = 'balanceAppointment';
            
		try
		{
			$x = __('backend.balanceAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.balanceAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
				
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, $meetingId));
			Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, $meetingId));
		}
		catch(\Swift_TransportException $e)
		{
			//return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
		}
    }
	
	/**
     * Confirm Appointment Email
     */
    public function confirm($meetingId)
    {
		$this->appointment->action = 'confirmAppointment';
            
		try
		{			
			$x = __('backend.confirmAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.confirmAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
				
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, $meetingId));
			Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, $meetingId));
		}
		catch(\Swift_TransportException $e)
		{
			//return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
		}
    }

    /**
     * Reschedule Appointment Email
     */
    public function reschedule($meetingId)
    {
		$this->appointment->action = 'rescheduleAppointment';
			
		try
		{
            $x = __('backend.rescheduleAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.rescheduleAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
            
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, $meetingId));
			Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, $meetingId));
        }
		catch(\Swift_TransportException $e)
		{
			return redirect()->to('/mylessons/'.auth()->id())->with('success',__('backend.rescheduled').' '.__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
		}
    }
	
	/**
     * Cancel Appointment Email
     */
    public function cancel()
    {
		$this->appointment->action = 'cancelAppointment';
			
		try
		{
			$x = __('backend.cancelAppointment_tutor', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'correct_time_tutor'=>$this->correct_time_tutor, 'correct_date_tutor'=>$this->correct_date_tutor]);
			$y = __('backend.cancelAppointment_student', ['tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname, 'correct_time_student'=>$this->correct_time_student, 'correct_date_student'=>$this->correct_date_student]);
               
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, 0));
            Mail::to($this->appointment->instructor->user->email)->send(new UserAppointment($x, $this->appointment, 0));
        }
		catch(\Swift_TransportException $e)
		{
            //return back()->with('success','Appointment canceled Successfully ! but Mail will not sent because of error in mail configuration !');
        }
    }
	
	/**
     * End Meeting Email
     */
    public function endMeeting($tutorId)
    {
		$this->appointment->action = 'endMeeting';
			
		try
		{			
			$y = __('backend.endMeeting_student', ['student_fname'=>$this->appointment->user->fname, 'student_lname'=>$this->appointment->user->lname, 'tutor_fname'=>$this->appointment->instructor->user->fname, 'tutor_lname'=>$this->appointment->instructor->user->lname]);
            
			Mail::to($this->appointment->user->email)->send(new UserAppointment($y, $this->appointment, $tutorId));
        }
		catch(\Swift_TransportException $e)
		{
			return back()->with('success', __('backend.lesson_ended_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
		}
    }
}