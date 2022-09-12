<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAppointment extends Mailable
{
    use Queueable, SerializesModels;
    public $x, $request, $meetingid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($x, $request, $meetingid =null)
    {
        $this->x = $x;
        $this->request = $request;
        $this->meetingid = $meetingid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd($this->request->all());
        if (isset($this->request->page)){

            return $this->markdown('email.resumeVerification')->subject(__('frontend.review').' '.__('frontstaticword.document'));

        }

        if (isset($this->request->tutorId)){
            return $this->markdown('email.reviews')->subject(__('frontend.reviews'));

        }
        if (strstr($this->x, "status")){
//            dd( "Found!");
            return $this->markdown('email.statusChange')->subject(__('frontend.status'));

        }
        if ($this->request->review == 'reviewMail'){

            return $this->markdown('email.newReviews')->subject(__('frontend.review').' '.__('frontend.tutor'));


        }
		
		if(isset($this->request->action))
		{
			if($this->request->action == 'bookAppointment')
			{
				return $this->markdown('email.bookAppointment')->subject(__('frontend.book').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'freeAppointment')
			{
				return $this->markdown('email.freeAppointment')->subject(__('frontend.free').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'balanceAppointment')
			{
				return $this->markdown('email.balanceAppointment')->subject(__('frontend.balance').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'confirmAppointment')
			{
				return $this->markdown('email.confirmAppointment')->subject(__('frontend.confirm').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'rescheduleAppointment')
			{
				return $this->markdown('email.rescheduleAppointment')->subject(__('frontend.reschedule').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'cancelAppointment')
			{
				return $this->markdown('email.cancelAppointment')->subject(__('frontend.cancel').' '.__('frontend.lesson'));
			}
			elseif($this->request->action == 'endMeeting')
			{
				return $this->markdown('email.newReviews')->subject(__('frontend.review').' '.__('frontend.tutor');
			}
			elseif($this->request->action == 'approved')
			{
				return $this->markdown('email.approved')->subject(__('frontend.tutor').' '.__('frontend.status'));
			}
			elseif($this->request->action == 'recommended')
			{
				return $this->markdown('email.approved')->subject(__('frontend.tutor').' '.__('adminstaticword.recommendation'));
			}
        }


        return $this->markdown('email.userAppointment')->subject(__('frontend.lesson'));
    }
}
