<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Cart;
use App\Mail\UserAppointment;
use App\Payment_transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BigBlueController;
use Illuminate\Support\Facades\Mail;
use Rave;
use Session;
use App\EmailTemplate;
use App\Notification;
use App\BBL;
use DB;

class RaveController extends Controller
{

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        $txID = base64_decode(request()->ref);
        $txIDArr = explode('-', $txID);

        $cartRecord= Cart::find($txIDArr[0]);

        if(!$cartRecord){
            Session::flash('error',__('backend.record_not_found'));
            return redirect()->back()->with('error', __('backend.record_not_found'));
        }

        $transactionRecord = Payment_transaction::where('transaction_ref', request()->ref)->first();

        if(!$transactionRecord){
            $transactionRecord = new Payment_transaction();
        }

        $transactionRecord->transaction_ref =request()->ref;
        $transactionRecord->user_id =$cartRecord->user_id;
        $transactionRecord->amount =$cartRecord->offer_price;
        $transactionRecord->discount =$cartRecord->disamount;
        $transactionRecord->net_amount =$cartRecord->offer_price - $cartRecord->disamount;

        $transaction_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
        $bank_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
        $bank_fees = number_format(($bank_fees )  , 2, '.', '');

        $transactionRecord->total_amount =$cartRecord->offer_price - $cartRecord->disamount+ $transaction_fees - $bank_fees;
        $transactionRecord->status =0;
        $transactionRecord->payment_method ='flutterwave';
        $transactionRecord->save();


        //This initializes payment and return redirects to the payment gateway
        //The initialize method takes the parameter of the return redirect URL
        Rave::initialize(route('callback'));
    }


	public function flutterwaveCallback(){
		dd(request());
		
	}
    /**
     * Obtain Rave callback information
     * @return void
     */
	 

    public function callback()
    {
		dd(request());
        $bigBlueController = new BigBlueController();

        $txRefOrig = json_decode(request()->resp)->tx->txRef;
        $data = Rave::verifyTransaction($txRefOrig);

        //dd($data);

        // Comfirm that the transaction is successful
        if(isset($data->status) && $data->status =='success'){
            $txRef = base64_decode($txRefOrig);

            $txRef = explode( '-', $txRef);
            //dd($txRef);

            // Get the transaction from your DB using the transaction reference (txref)

            $transactionRecord = Payment_transaction::where('transaction_ref', $txRefOrig)->where('status', 0)->first();
            //dd($transactionRecord);
            if(!$transactionRecord || $transactionRecord == null){
                Session::flash('error',__('backend.transaction_success_but_transaction_record_not_found'));
                return redirect('/mylessons/'.$txRef[2]);

            }

            $cartRecord= Cart::find($txRef[0]);

            if(!$cartRecord){
                Session::flash('error',__('backend.transaction_success_but_transaction_record_not_found'));
                return redirect('/mylessons/'.$txRef[2]);
            }

            // Check if you have previously given value for the transaction. If you have, return redirect to your successpage else, continue


            // Confirm that the chargecode is 00 or 0
            if($data->data->chargecode !='00' || $data->data->chargecode !='0'){
                Session::flash('error',__('backend.error_in_charge_code'));
                return redirect('/mylessons/'.$txRef[2]);
            }

            // Confirm that the currency on your db transaction is equal to the returned currency
            if($data->data->currency !='USD'){
                Session::flash('error',__('backend.error_in_received_currency'));
                return redirect('/mylessons/'.$txRef[2]);
            }

            // Confirm that the db transaction amount is equal to the returned amount
            if($data->data->amount != $transactionRecord->total_amount){
                Session::flash('error',__('backend.error_in_received_amount'));
                return redirect('/mylessons/'.$txRef[2]);
            }

            // Comfirm that the transaction is successful

            $transactionRecord->vendor_transaction_id=$data->data->txid;
            $transactionRecord->vendor_transaction_reference=$data->data->flwref;
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


            // get tutor time zone
            $time_zone = \App\Time_zone::find($appointmentRecord->time_zone_id);
            // get slot time format to conver it
            $slot_time = date(" H:i:s", strtotime("$appointmentRecord->start_time"));

            // convert from time zone to time zone saved in session
            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time ,  $time_zone->time_zone_name)
            ->setTimezone(session('currentTimeZoneName'));

            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

            if(env('MAIL_USERNAME')!=null) {
                try{

                    /*sending email*/
                    $request = $appointmentRecord;
					$x = __('backend.confirmAppointment_tutor', ['student_fname'=>$request->user->fname, 'student_lname'=>$request->user->lname, 'correct_time_tutor'=>$request->start_time, 'correct_date_tutor'=>$request->date]);
                    $y = __('backend.confirmAppointment_student', ['tutor_fname'=>$request->fname, 'tutor_lname'=>$request->lname, 'correct_time_student'=>$request->start_time, 'correct_date_student'=>$request->date]);
//                    dd($request->user);
                    Mail::to($appointmentRecord->instructor->user->email)->send(new UserAppointment($x, $request, $meetingRecord->id));
                    Mail::to($appointmentRecord->user->email)->send(new UserAppointment($y, $request, $meetingRecord->id));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
            }

            try{
                $notification = new Notification;
                $notification->type = 6;
                $notification->notifiable_type  = "Instructor" ;
                $notification->notifiable_id  = $appointmentRecord->instructor->user ? $appointmentRecord->instructor->user->id : "";
                $notification->data  = __('backend.studnet_just_booked_a_session_with_you');
                $notification->save();
                $notification2 = new Notification;
                $notification2->type = 6;
                $notification2->notifiable_type  = "Instructor" ;
                $notification2->notifiable_id  = auth()->id();
                $notification2->data  = __('backend.you_just_booked_a_session');
                $notification2->save();
            } catch (\Exception $e) {
                return false;
            }
            Session::flash('success',__('backend.payment_received_successfully'));

            return redirect('/mylessons/'.$txRef[2]);

        }else{
            Session::flash('error',__('backend.transaction_failed'));
            return redirect('/mylessons/'.auth()->id);
        }


    }

    public function freeCallback(Request $request)
    {
        $bigBlueController = new BigBlueController();

        $cart_record = $request->ref;
        // Comfirm that the transaction is successful
        if(true){


            $cartRecord= Cart::find($cart_record);

            if(!$cartRecord){
                Session::flash('error',__('backend.transaction_success_but_cart_record_not_found'));
                return redirect('/mylessons/'.\Auth::user()->id);
            }

            // Check if you have previously given value for the transaction. If you have, return redirect to your successpage else, continue


            $appointmentRecord = Appointment::with('user', 'instructor')->where('id',$cartRecord->appointment_id)->first();
            $appointmentRecord->payment_transaction_id="free";
            $appointmentRecord->status_id=1; // Schedualed
            $appointmentRecord->save();

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
//dd($meetingid);
//            dd('MAIL_USERNAME');
//            if(env('MAIL_USERNAME')!=null) {
                try{

                    // get tutor time zone
                    $time_zone = \App\Time_zone::find($appointmentRecord->time_zone_id);
                    // get slot time format to conver it
                    $slot_time = date(" H:i:s", strtotime("$appointmentRecord->start_time"));

                    // convert from time zone to time zone saved in session
                    $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d'). $slot_time ,  $time_zone->time_zone_name)
                    ->setTimezone(session('currentTimeZoneName'));

                    $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i');

                    $request = $appointmentRecord;
                    $email_templates = EmailTemplate::first();
                    if($email_templates != null){
                        $student_name = auth()->user()->fname.' '. auth()->user()->lname ;
                        // email to tutor
                        $x = str_replace("%student%", $student_name, $email_templates->booked_successfully_tutor_email . ' will start at ('.$appointmentRecord->start_time.') on ('.$appointmentRecord->date.')' );
                        // email to student
                        $tutor_name = $appointmentRecord->instructor->user->fname.' '. $appointmentRecord->instructor->user->lname;
                        $y = str_replace("%tutor%", $tutor_name, $email_templates->booked_successfully_studnet_email .' will start at ('.$correct_time.') on ('.$appointmentRecord->date.')' );

                    }else{
						$x = __('backend.rescheduleAppointment_tutor', ['student_fname'=>auth()->user()->fname, 'student_lname'=>auth()->user()->lname, 'correct_time_tutor'=>$appointmentRecord->start_time, 'correct_date_tutor'=>$appointmentRecord->date]);
						$y = __('backend.rescheduleAppointment_student', ['tutor_fname'=>$appointmentRecord->instructor->user->fname, 'tutor_lname'=>$appointmentRecord->instructor->user->lname, 'correct_time_student'=>$correct_time, 'correct_date_student'=>$appointmentRecord->date]);
                    }
//                    dd($request->user);
                    Mail::to($appointmentRecord->instructor->user->email)->send(new UserAppointment($x, $request, $meetingRecord->id));
                    Mail::to($appointmentRecord->user->email)->send(new UserAppointment($y, $request, $meetingRecord->id));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
//            }

            try{
                $notification = new Notification;
                $notification->type = 6;
                $notification->notifiable_type  = "Instructor" ;
                $notification->notifiable_id  = $appointmentRecord->instructor->user ? $appointmentRecord->instructor->user->id : "";
                $notification->data  = __('backend.studnet_just_booked_a_session_with_you');
                $notification->save();
                $notification2 = new Notification;
                $notification2->type = 6;
                $notification2->notifiable_type  = "Instructor" ;
                $notification2->notifiable_id  = auth()->id();
                $notification2->data  = __('backend.you_just_booked_a_session');
                $notification2->save();


            } catch (\Exception $e) {
                return false;
            }
			
			//delete cart record
            $cartRecord->delete();
			
            Session::flash('success',__('backend.payment_received_successfully'));
            return redirect('/mylessons/'.\Auth::user()->id);

        }else{
            Session::flash('error',__('backend.transaction_failed'));
            return redirect('/mylessons/'.\Auth::user()->id);
        }

    }
	
	public function freeSlots(Request $request)
    {
        $bigBlueController = new BigBlueController();

		$cart_ids = explode('_', $request->ref);
        // Comfirm that the transaction is successful
        if(!empty($cart_ids)){
			foreach($cart_ids as $cart_record)
			{

            $cartRecord= Cart::find($cart_record);

            if(!$cartRecord){
                Session::flash('error',__('backend.transaction_success_but_cart_record_not_found'));
                return redirect('/mylessons/'.\Auth::user()->id);
            }

            // Check if you have previously given value for the transaction. If you have, return redirect to your successpage else, continue


            $appointmentRecord = Appointment::with('user', 'instructor')->where('id',$cartRecord->appointment_id)->first();
            $appointmentRecord->payment_transaction_id="free";
            $appointmentRecord->status_id=1; // Schedualed
            $appointmentRecord->save();

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
				$email->free($meetingRecord->id);
			}

            try{
                $notification = new Notification;
                $notification->type = 6;
                $notification->notifiable_type  = "Instructor" ;
                $notification->notifiable_id  = $appointmentRecord->instructor->user ? $appointmentRecord->instructor->user->id : "";
                $notification->data  = __('backend.studnet_just_booked_a_session_with_you');
                $notification->save();
                $notification2 = new Notification;
                $notification2->type = 6;
                $notification2->notifiable_type  = "Instructor" ;
                $notification2->notifiable_id  = auth()->id();
                $notification2->data  = __('backend.you_just_booked_a_session');
                $notification2->save();


            } catch (\Exception $e) {
                return false;
            }
			//delete cart record
            $cartRecord->delete();
			}
            Session::flash('success',__('backend.payment_received_successfully'));

            return redirect('/mylessons/'.\Auth::user()->id);

        }else{
            Session::flash('error',__('backend.transaction_failed'));
            return redirect('/mylessons/'.\Auth::user()->id);
        }

    }


}
