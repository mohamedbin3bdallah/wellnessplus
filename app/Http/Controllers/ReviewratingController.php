<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Instructor;
use App\Mail\UserAppointment;
use App\ReviewRating;
use Illuminate\Http\Request;
use App\User;
use App\Course;
use DB;
use Auth;
use App\Order;
use Illuminate\Support\Facades\Mail;

class ReviewratingController extends Controller
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
//dd($request->all());
        if (isset($request->userId))
        {
            $tutor = Instructor::with('user')->where('instructors.id', $request->tutorId)->first();
            DB::table('review_ratings')->insert(
                array(
                    'course_id' => $request->course,
                    'user_id' => $request->userId,
                    'tutor_id' => $request->tutorId,
                    'review' => $request->review,
                    'value' =>$request->starsValue,
                    'status' => $request->status,
                    'approved' => $request->approved,
                    'featured' => $request->featured,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                )
            );
            if(env('MAIL_USERNAME')!=null) {
                try{

                    /*sending email*/
                    $x = __('backend.review_tutor');
                    $y = __('backend.review_student');
//                    dd($request->user);
                    Mail::to($tutor->user->email)->send(new UserAppointment($x, $request, 0));
                    Mail::to(auth()->user()->email)->send(new UserAppointment($y, $request, 0));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
            }

            return redirect()->back();

        }elseif (isset($request->onStar)){
            $appointment = Appointment::where('id', $request->record_id)->first();
            $appointment->update(['status_id' => 3]);


            $tutor = Instructor::with('user')->where('instructors.id', $appointment->instructor_id)->first();
        DB::table('review_ratings')->insert(
            array(
                'course_id' => $request->record_id,
                'user_id' => $appointment->user_id,
                'tutor_id' => $tutor->id,
                'review' => " ",
                'value' =>$request->onStar,
                'status' => 1,
                'approved' => 1,
                'featured' => null,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            )
        );
//        if(env('MAIL_USERNAME')!=null) {
            try{

                /*sending email*/
                $x = __('backend.review_tutor');
//                $y = 'Kindly be informed that your review has been added to your tutor lessons page';
//                    dd($request->user);
                Mail::to($tutor->user->email)->send(new UserAppointment($x, $request, 0));
//                Mail::to(auth()->user()->email)->send(new UserAppointment($y, $request, 0));


            }catch(\Swift_TransportException $e){
                return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
            }
//        }

        return redirect()->back();


        }
        else{
            DB::table('review_ratings')->insert(
                array(
                    'course_id' => $request->course,
                    'user_id' => $request->user_id,
                    'review' => $request->review,
                    'status' => $request->status,
                    'approved' => $request->approved,
                    'featured' => $request->featured,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                )
            );
            return redirect()->route('course.show', $request->course);

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $jp = ReviewRating::find($id);
        $users = User::all();
        $courses = Course::all();
        return view('admin.course.reviewrating.edit',compact('jp','courses','users'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function edit(reviewrating $reviewrating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $data = ReviewRating::findorfail($id);
        $input = $request->all();
        $data ->update($input);

        return redirect()->route('course.show',$request->course);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('review_ratings')->where('id',$id)->delete();
        return back();
    }


    public function rating(Request $request,$id)
    {

        $orders = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();
        $review = ReviewRating::where('user_id', Auth::User()->id)->where('course_id', $id)->first();

        if(!empty($orders)){
            if(!empty($review))
            {
                return back()->with('delete',__('backend.you_already_reviewed_this_course'));
            }
            else{

                $input = $request->all();
                $input['course_id'] = $id;
                $input['user_id'] = Auth::User()->id;
                $data = ReviewRating::create($input);
                $data->save();

                return back()->with('success',__('backend.review_successfully'));
            }
            return back()->with('success',__('backend.review_successfully'));
        }
        else{
            return back()->with('delete',__('backend.purchase_to_review_this_course'));

        }

    }


}
