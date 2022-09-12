<?php

namespace App\Http\Controllers;

use App\admin;
use App\User;
use App\Instructor;
use App\Appointment;
use App\AppointmentStatus;
use App\Organization;
use App\BBL;
use Illuminate\Http\Request;
use Auth;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::User()->role == "admin")
        {
			$allUsers = User::all();
			$tutors = Instructor::wherehas('user', function($q) { $q->where('role', 'instructor'); })->get();
			
			$appointments = Appointment::all();
			$appointmentStatus = AppointmentStatus::pluck('status','id');
			
			$bigbluemeetings = BBL::all();
			$organizations = Organization::all();
			
			$tutorsPreferredStudentAgeArray = DB::table('instructors')
					->join('users', 'instructors.user_id', '=', 'users.id')
					->join('tutor_prefered_student_ages', 'instructors.id', '=', 'tutor_prefered_student_ages.tutor_id')
					->join('prefered_student_age', 'tutor_prefered_student_ages.prefered_student_age_id', '=', 'prefered_student_age.id')
					->select(DB::raw('COUNT(tutor_prefered_student_ages.id) as value'),'prefered_student_age.age as label')
					->where(['users.role'=>'instructor'])
					->groupBy('tutor_prefered_student_ages.prefered_student_age_id')
					->get()
					->toArray();
			$tutorsPreferredStudentLevelArray = DB::table('instructors')
					->join('users', 'instructors.user_id', '=', 'users.id')
					->join('tutor_prefered_student_levels', 'instructors.id', '=', 'tutor_prefered_student_levels.tutor_id')
					->join('prefered_student_level', 'tutor_prefered_student_levels.prefered_student_level_id', '=', 'prefered_student_level.id')
					->select(DB::raw('COUNT(tutor_prefered_student_levels.id) as value'),'prefered_student_level.student_level as label')
					->where(['users.role'=>'instructor'])
					->groupBy('tutor_prefered_student_levels.prefered_student_level_id')
					->get()
					->toArray();
			$tutorsSpecialtyArray = DB::table('instructors')
					->join('users', 'instructors.user_id', '=', 'users.id')
					->join('specialties', 'instructors.specialty', '=', 'specialties.id')
					->select(DB::raw('COUNT(instructors.id) as value'),'specialties.specialty as label')
					->where(['users.role'=>'instructor'])
					->groupBy('instructors.specialty')
					->get()
					->toArray();
			
			$studentsCountryDataArray = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->select(DB::raw('COUNT(users.id) as count'),'allcountry.iso as name')
					->where(['users.role'=>'user'])
					->groupBy('users.country_id')
					->pluck('count','name')
					->toArray();
			$tutorsCountryDataArray = DB::table('instructors')
					->join('users', 'instructors.user_id', '=', 'users.id')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->select(DB::raw('COUNT(users.id) as count'),'allcountry.iso as name')
					->where(['users.role'=>'instructor'])
					->groupBy('users.country_id')
					->pluck('count','name')
					->toArray();
			
            return view('admin.dashboard')->with(['allUsers'=>$allUsers, 'tutors'=>$tutors, 'appointments'=>$appointments, 'appointmentStatus'=>$appointmentStatus, 'bigbluemeetings'=>$bigbluemeetings, 'organizations'=>$organizations, 'studentsCountryData'=>json_encode((object) $studentsCountryDataArray), 'tutorsCountryData'=>json_encode((object) $tutorsCountryDataArray), 'tutorsPreferredStudentAge'=>json_encode($tutorsPreferredStudentAgeArray), 'tutorsPreferredStudentLevel'=>json_encode($tutorsPreferredStudentLevelArray), 'tutorsSpecialty'=>json_encode($tutorsSpecialtyArray)]);
        }
        else
        {
            abort(404, __('backend.page_not_found'));
        }

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
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
