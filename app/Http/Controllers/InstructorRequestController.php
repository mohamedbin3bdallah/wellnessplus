<?php

namespace App\Http\Controllers;

use App\Mail\UserAppointment;
//use App\Notifications;
use App\Tutor_payment_info;
use Illuminate\Http\Request;
use App\Instructor;
use App\PartnerTutor;
use DB;
use App\User;
use App\TutorPackage;
use App\TutorCommission;
use App\TutorCommissionLog;
use App\Student_package;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\TutorPreferedStudentAge;
use App\TutorPreferedStudentLevel;
use Illuminate\Support\Facades\Mail;
use Auth;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $items = Instructor::where('instructors.status', '0')
            ->join('users', 'users.id', '=', 'instructors.user_id')
            ->leftjoin('allcountry', 'allcountry.id', '=', 'users.country_id')
            ->select('instructors.*','users.fname','users.email', 'users.mobile', 'users.lname', 'users.user_img', 'allcountry.name As country_name')
			->orderBy('instructors.created_at', 'DESC')
            ->get();
//dd($items);
        return view('admin.instructor.instructor_request.index',compact('items'));
    }

    public function create()
    {
        $data = Instructor::all();
        return view('admin.instructor.instructor_request.create',compact('data'));
    }

    public function edit($page,$id)
    {
        $show = Instructor::where('instructors.id', $id)
            ->join('users', 'users.id', '=', 'instructors.user_id')
            ->leftjoin('allcountry', 'allcountry.id', '=', 'users.country_id')
            ->select('instructors.*','users.fname', 'users.lname', 'users.email', 'users.dob', 'users.gender','users.role', 'users.mobile', 'users.detail As userDetail', 'users.user_img As image', 'users.youtube_url', 'users.created_at', 'allcountry.name As country_name')
            ->first();
//        dd($show);
        return view('admin.instructor.instructor_request.view',compact('show','page'));
    }

    public function update(Request $request, $page, $id)
    {

        $data = Instructor::with('user')->findorfail($id);
		
        Instructor::where('user_id', $request->user_id)
                ->update(['status' => $request->status, 'recommendation' => $request->recommendation]);
//            $notification = new Notifications();
//            $notification->create([
//                'type' => 'status',
//                'notifiable_type' => 'tutor',
//                'notifiable_id' => $data->user->id,
//                'data' => 'Your profile status has been changed to Hidden'
//            ]);
        if(env('MAIL_USERNAME')!=null && $data->status != $request->status) {
			$m = ($request->status)? __('backend.shown'):__('backend.hidden');
            try{
                $request = $data;
                /*sending email*/
                $x = __('backend.tutor_status_change_message', ['param'=>$m]);

                Mail::to($data->user->email)->send(new UserAppointment($x, $data, 0));


            }catch(\Swift_TransportException $e){
//                    return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
            }
        }
		
		if(env('MAIL_USERNAME')!=null && $data->recommendation != $request->recommendation) {
			$m = ($request->status)? __('backend.recommended'):__('backend.not_recommended');
            try{
                $request = $data;
                /*sending email*/
                $x = __('backend.tutor_recommendation_change_message', ['param'=>$m]);

                Mail::to($data->user->email)->send(new UserAppointment($x, $data, 0));


            }catch(\Swift_TransportException $e){
//                    return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
            }
        }

        $show = User::where('id', $request->user_id)->first();
        $input['detail'] = $request->detail;
        $input['mobile'] = $request->mobile;
        $input['gender'] = $request->gender;
        $input['dob'] = $request->dob;

        User::where('id', $request->user_id)
                    ->update(['detail' => $request->detail, 'mobile' => $request->mobile, 'gender' => $request->gender, 'dob' => $request->dob ]);

        
		if($page == 'requestInstrutors') return redirect()->route('requestinstructor.index');
		else  return redirect()->route('all.instructor');
    }

    public function destroy($id)
    {
		/**
		** Delete all tutor records from relationship with partners
		**/
		$tutor = Instructor::find($id);
		PartnerTutor::where('tutor_id',$tutor->id)->delete();
		Student_package::where('tutor_id', $tutor->id)->delete();
		TutorPreferedStudentAge::where('tutor_id', $tutor->id)->delete();
		TutorPreferedStudentLevel::where('tutor_id', $tutor->id)->delete();
		TutorPackage::where('tutor_id', $tutor->id)->delete();
		UserTutorBalance::where('tutor_id', $tutor->id)->delete();
		UserTutorBalanceLog::where('tutor_id', $tutor->id)->delete();
		TutorCommission::where('tutor_id', $tutor->id)->delete();
		TutorCommissionLog::where('tutor_id', $tutor->id)->delete();
		
        DB::table('instructors')->where('id',$id)->delete();
        return back()->with('success',__('backend.deleted_successfully'));
    }

    public function allinstructor()
    {
		/**
		** get anly partner tutors if the logged in user role is partner
		** get all tutors otherwise
		**/
        if(Auth::user()->role == 'partner')
		{
			$items = Instructor::join('users', 'users.id', 'instructors.user_id')
				->join('partner_tutors', 'instructors.id', 'partner_tutors.tutor_id')
				->select('instructors.*', 'users.fname', 'users.lname', 'users.email', 'instructors.id', 'instructors.PricePerHour', 'instructors.detail', 'users.user_img', 'instructors.status')
				->where(['partner_tutors.partner_id'=>Auth::user()->id])
				->get();
		}
		else
		{
			$items = Instructor::join('users', 'users.id', 'instructors.user_id')
				->select('instructors.*', 'users.fname', 'users.lname', 'users.email', 'instructors.id', 'instructors.PricePerHour', 'instructors.detail', 'users.user_img', 'instructors.status')
				->get();
		}
        return view('admin.instructor.all_instructor.index',compact('items'));
    }

    public function instructorpage()
    {
        return view('front.instructor');
    }


    public function instructor(Request $request)
    {
        $users = Instructor::where('user_id', $request->user_id)->get();

        if(!$users->isEmpty()){
            return back()->with('delete',__('backend.record_already_exist'));
        }
        else{

            $input = $request->all();

            if ($file = $request->file('image'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/instructor', $name);
                $input['image'] = $name;
            }


            if($file = $request->file('file'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('files/instructor/',$name);
                $input['file'] = $name;
            }


            $data = Instructor::create($input);
            $data->save();
        }

        return back()->with('success',__('backend.created_successfully'));

    }

    public function getPaymentInfo(){

        $tutorsPaymentInfo = Tutor_payment_info::join('instructors', 'instructors.id', 'tutor_payment_info.tutor_id')
            ->join('users', 'users.id', 'instructors.user_id')
            ->select('tutor_payment_info.*', 'users.fname', 'users.lname', 'users.user_img')
            ->get();
//        dd($tutorsPaymentInfo);

        return view('admin.instructor.tutorsPaymentInfo.index', compact('tutorsPaymentInfo'));
    }
}
