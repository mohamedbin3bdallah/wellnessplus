<?php

namespace App\Http\Controllers;

use App\Allcountry;
use App\Appointment;
use App\AppointmentStatus;
use App\Instructor;
use App\Notifications_type;
use App\Packages;
use App\Time_zone;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Country;
use App\State;
use App\City;
use phpDocumentor\Reflection\Types\Object_;
use Session;
use Image;
use Auth;
use Hash;
use Redirect;
use App\Student_notification_setting;
use Validator;

class UserProfileController extends Controller
{
    public function userprofilepage($id)
    {
        if(Auth::check())
        {
            $course = Course::all();
            $countries = Allcountry::all();
            $states = State::all();
            $cities = City::all();
            $orders = User::where('id', Auth::User()->id)->first();
            $timeZones = Time_zone::where('status', '!=', 'Deprecated')->orderBy('time_zone_name', 'asc')->get();
            $studentNotificationsSettings = Student_notification_setting::where('user_id', Auth::user()->id)->get();
            $notificationTypes = Notifications_type::all();

            return view('frontend.user_profile.profile',compact('orders', 'course', 'countries', 'states', 'cities', 'timeZones', 'studentNotificationsSettings', 'notificationTypes'));
        }
        return Redirect::route('login')->withInput()->with('delete', __('backend.please_login_to_access_restricted_area'));
    }

    public function userprofile(Request $request,$id)
    {
        $user = User::findorfail($id);

        $validation=[
            'email' => 'required|unique:users,email,'.$id,
            'mobile' => 'required|digits_between:9,15|unique:users,mobile,'.$id,
            'fname' => 'required|max:50|min:2',
            'lname' => 'required|max:50|min:2',
            'time_zone_id' => 'required',
            'user_img' => 'sometimes|required|mimes:jpeg,jpg,png|required|max:2048',
            'country_id' =>'required'

        ];

        if(isset($request->password) && $request->password !=null) {
            $validation['password'] = ['required', 'string', 'min:6','max:100'];
            $validation['passwordConfirmation'] = ['required','same:password'];

        }

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
			//            dd($validator);
            Session::flash('error',__('backend.update_failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input = $request->all();



        if(isset($request->password)){
            if(Hash::check($request->oldPassword, $user->password)){
                $input['password'] = Hash::make($request->password);
            }else{
                Session::flash('error',__('backend.old_password_is_wrong'));
                return redirect()->back();
            }
        }
        else{
            $input['password'] = $user->password;
        }


        if($file = $request->file('user_img'))
        {
            if($user->user_img != "" && $user->user_img != 'general.png')
            {
                $content = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);

                if ($content) {
                    unlink(public_path().'/images/user_img/'.$user->user_img);
                }
            }

            $name = time().$file->getClientOriginalName();
            $file->move('images/user_img', $name);
            $input['user_img'] = $name;
        }



        if ($request->notification != null) {
            $OldSettings = Student_notification_setting::where('user_id', $user->id)->count();

            if ($OldSettings == 0) {
                foreach ($request->notification as $notificationTypeId) {

                    $tutorNotification = new Student_notification_setting();
                    $tutorNotification->create([
                        'user_id' => $user->id,
                        'type_id' => $notificationTypeId
                    ]);
                }
            } else {
                Student_notification_setting::where('user_id', $user->id)->delete();

                foreach ($request->notification as $notificationTypeId) {

                    $tutorNotification = new Student_notification_setting();
                    $tutorNotification->create([
                        'user_id' => $user->id,
                        'type_id' => $notificationTypeId
                    ]);
                }
            }
        }else{
            Student_notification_setting::where('user_id', $user->id)->delete();

        }



        //dd($input);
        $user->update($input);
        Auth::login($user);

        $ZoneTime = $user->timeZone->time;
        $time_zone_name = $user->timeZone->time_zone_name;

        $timeZone = explode(':', $ZoneTime);

        Session::put(['currentTimeZoneName' => $time_zone_name ? $time_zone_name : "Africa/Cairo"]);
        Session::put(['currentTimeZone' => $ZoneTime]);
        Session::put(['currentTimeZoneHour' => $timeZone[0]]);
        Session::put(['currentTimeMinutes' => $timeZone[1]]);

        Session::flash('success',__('backend.updated_successfully'));
        return back();
    }

    public function facebookDisconnect($id){

        $user = User::where('id', $id)->first();

        $user->update([
            'facebook_id' => null
        ]);

        Session::flash('success',__('backend.updated_successfully'));
        return back();
    }

    public function googleDisconnect($id){

        $user = User::where('id', $id)->first();

        $user->update([
            'google_id' => null
        ]);

        Session::flash('success',__('backend.updated_successfully'));
        return back();
    }

    public function notificationsUnsubscribe(){
        $userId = auth::user()->id;
        Student_notification_setting::where('user_id', $userId)->delete();

        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();

    }

    public function myLessonsPage($id){

        $lessons = Appointment::with('review')->where('appointments.user_id', auth()->id())
            ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->join('instructors', 'instructors.id', '=', 'appointments.instructor_id')
            ->join('users', 'users.id', '=', 'instructors.user_id')
            ->select('appointments.*', 'appointment_status.status', 'instructors.PricePerHour', 'users.fname', 'users.lname', 'users.user_img')
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();
            //dd($lessons);
        $Scheduled_lessons_counter = Appointment::where('appointments.user_id', auth()->id())
            ->where('appointments.status_id', 1)
            ->count();

        $appointments_status = AppointmentStatus::all();

        $request = new Request();
        $request->status_id = "all";
        $nextLesson = Appointment::where('appointments.user_id', auth()->id())
            ->leftJoin('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->leftJoin('instructors', 'instructors.id', '=', 'appointments.instructor_id')
            ->leftJoin('users', 'users.id', '=', 'instructors.user_id')
            ->leftJoin('bigbluemeetings', 'appointments.id', '=', 'bigbluemeetings.appointment_id')
            ->select('appointments.*','bigbluemeetings.is_ended as is_ended', 'bigbluemeetings.id as meetingId', 'appointment_status.status', 'instructors.PricePerHour', 'users.fname', 'users.lname', 'users.user_img')
            ->where('date','>=', date('Y-m-d'))
			->where('is_ended', '=', 0)
            // ->where('appointments.start_time', '>', Carbon::now()->subMinutes(15)->format('H:i:s') )
            ->whereIn('status_id', [1,3,5])
            ->orderBy('date')
            ->get();
            foreach($nextLesson as $key => $lesson ){
                // get tutor time zone
                $time_zone = \App\Time_zone::find($lesson->time_zone_id);
                // get slot time format to conver it
                $slot_time = date("Y-m-d H:i:s", strtotime("$lesson->date . $lesson->start_time "));

                // convert from time zone to time zone saved in session
                $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,  $slot_time , $time_zone->time_zone_name )
                ->setTimezone( session('currentTimeZoneName') );
                $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i:s');

                // get current time in same time zone
                $now = \Carbon\Carbon::now()->format('H:i:s');
                $carbonDate = new Carbon($now);
                $carbonDate->timezone = session('currentTimeZoneName');
                $current_time_before_15_mins = $carbonDate->subMinutes(15)->format('H:i:s');
                $current_time_after_30_mins = $carbonDate->addMinutes(30)->format('H:i:s');
                if( ($correct_time > $current_time_before_15_mins) && ($correct_time < $current_time_after_30_mins ) ){

                }else{
                $nextLesson->forget($key);
                }
            }

        //dd($nextLesson);
        return view('frontend.user_profile.myLessons', compact('lessons', 'appointments_status', 'Scheduled_lessons_counter', 'request', 'nextLesson'));

    }

    public function lessonsFiltering(Request $request){

        if ($request->status_id == "all"){
            $lessons = Appointment::with('review')->where('appointments.user_id', auth()->id())
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('instructors', 'instructors.id', '=', 'appointments.instructor_id')
                ->join('users', 'users.id', '=', 'instructors.user_id');
            if ($request->name != null) {
                $lessons = $lessons->where('users.fname', 'like', '%' . $request->name . '%');
            }
            $lessons = $lessons->select('appointments.*', 'appointment_status.status', 'instructors.PricePerHour', 'users.fname', 'users.lname', 'users.user_img')
                ->get();
        }else {
            $lessons = Appointment::with('review')->where('appointments.user_id', auth()->id())
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('instructors', 'instructors.id', '=', 'appointments.instructor_id')
                ->join('users', 'users.id', '=', 'instructors.user_id')
                ->where('appointments.status_id', $request->status_id);
            if ($request->name != null) {
                $lessons = $lessons->where('users.fname', 'like', '%' . $request->name . '%');
            }
            $lessons = $lessons->select('appointments.*', 'appointment_status.status', 'instructors.PricePerHour', 'users.fname', 'users.lname', 'users.user_img')
                ->get();

        }
        $Scheduled_lessons_counter = Appointment::where('appointments.user_id', auth()->id())
            ->where('appointments.status_id', 1)
            ->count();

        $appointments_status = AppointmentStatus::all();

        $nextLesson = Appointment::where('appointments.user_id', auth()->id())
            ->leftJoin('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->leftJoin('instructors', 'instructors.id', '=', 'appointments.instructor_id')
            ->leftJoin('users', 'users.id', '=', 'instructors.user_id')
            ->leftJoin('bigbluemeetings', 'appointments.id', '=', 'bigbluemeetings.appointment_id')
            ->select('appointments.*','bigbluemeetings.id as meetingId', 'appointment_status.status', 'instructors.PricePerHour', 'users.fname', 'users.lname', 'users.user_img')
            ->where('date','>=', date('Y-m-d'))
            // ->where('appointments.start_time', '>', Carbon::now()->subMinutes(15)->format('H:i:s') )
            ->whereIn('status_id', [1,3,5])
            ->orderBy('date')
            ->get();
        foreach($nextLesson as $key => $lesson ){
//            dd($lesson);
            // get tutor time zone
            $time_zone = \App\Time_zone::find($lesson->time_zone_id);
            // get slot time format to conver it
            $slot_time = date("Y-m-d H:i:s", strtotime("$lesson->date . $lesson->start_time "));

            // convert from time zone to time zone saved in session
            $slot_time_converted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,  $slot_time , $time_zone->time_zone_name )
                ->setTimezone( session('currentTimeZoneName') );
            $correct_time = \Carbon\Carbon::parse($slot_time_converted)->format('H:i:s');

            // get current time in same time zone
            $now = \Carbon\Carbon::now()->format('H:i:s');
            $carbonDate = new Carbon($now);
            $carbonDate->timezone = session('currentTimeZoneName');
            $current_time_before_15_mins = $carbonDate->subMinutes(15)->format('H:i:s');
            $current_time_after_30_mins = $carbonDate->addMinutes(30)->format('H:i:s');
            if( ($correct_time > $current_time_before_15_mins) && ($correct_time < $current_time_after_30_mins ) ){

            }else{
                $nextLesson->forget($key);
            }
        }

        return view('frontend.user_profile.myLessons', compact('lessons', 'appointments_status', 'Scheduled_lessons_counter', 'request', 'nextLesson'));

    }

    public function RescheduleLesson($id){

        $lesson = Appointment::where('id', $id)->first();

        $tutor = Instructor::where('instructors.id', $lesson->instructor_id)->with('user', 'schedule', 'favourite')
            ->leftjoin('prefered_student_age', 'prefered_student_age.id', 'instructors.PreferredStudentAge')
            ->leftjoin('prefered_student_level', 'prefered_student_level.id', 'instructors.preferedStudentLevel')
            ->select('instructors.*', 'prefered_student_age.age', 'prefered_student_level.student_level')
            ->first();

        $bookedSlots = Appointment::where('instructor_id', $tutor->id)->where('status_id','!=', 4)
            ->select('start_time', 'date', 'user_id')
            ->get();

        $packages = Packages::where('active', 1)->get();
//        dd($packages);


        return view('frontend.user_profile.rescheduleLesson', compact('lesson', 'tutor', 'bookedSlots', 'packages'));
    }

    public function myTeachersPage($id){

        $currentTutors = Instructor::with('user')
            ->join('appointments', 'appointments.instructor_id', 'instructors.id')
            ->where('appointments.user_id', auth()->id())
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('instructors.id')
            ->get();

        $favouriteTutors = Instructor::with('user', 'schedule')
            ->join('favourites', 'instructors.id','=', 'favourites.instructor_id')
            ->where('favourites.user_id', $id)
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->get();

        $randomTutors = Instructor::with('user')
            ->join('appointments', 'appointments.instructor_id', 'instructors.id')
            ->where('appointments.user_id', auth()->id())
            ->where('instructors.status', 1)
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.recommendation', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->inRandomOrder()->limit(4)->get();


        $packages = Packages::where(['active'=>1,'organization_flag'=>0])->get();


        return view('frontend.user_profile.myTeachers', compact('currentTutors','favouriteTutors', 'randomTutors', 'packages'));

    }

    public function myTeachersFiltering(Request $request){

        $currentTutors = Instructor::with('user')
            ->join('appointments', 'appointments.instructor_id', 'instructors.id')
            ->where('appointments.user_id', auth()->id())
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->where('users.fname', 'like', '%' . $request->name . '%')
            ->groupBy('instructors.id')
            ->get();

        $favouriteTutors = Instructor::with('user', 'schedule')
            ->join('favourites', 'instructors.id','=', 'favourites.instructor_id')
            ->where('favourites.user_id', auth()->id())
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->where('users.fname', 'like', '%' . $request->name . '%')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->get();

        $randomTutors = Instructor::with('user')
            ->join('appointments', 'appointments.instructor_id', 'instructors.id')
            ->where('appointments.user_id', auth()->id())
            ->join('users', 'users.id', 'instructors.user_id')
            ->join('allcountry', 'allcountry.id', 'users.country_id')
            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
            ->inRandomOrder()->limit(4)->get();

        $packages = Packages::where(['active'=>1,'organization_flag'=>0])->get();

        return view('frontend.user_profile.myTeachers', compact('currentTutors','favouriteTutors', 'randomTutors', 'packages'));

    }







}
