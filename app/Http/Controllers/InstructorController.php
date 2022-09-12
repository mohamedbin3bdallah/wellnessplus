<?php

namespace App\Http\Controllers;

use App\Allcountry;
use App\AllLanguages;
use App\LanguageLevels;
use App\Appointment;
use App\BBL;
use App\AppointmentStatus;
use App\Categories;
use App\UserCategory;
//use App\Events\StatusNotification;
use App\Instructor;
use App\Mail\UserAppointment;
//use App\Notifications;
use App\ReviewRating;
use App\Specialties;
use App\Tutor_payment_info;
use App\tutorCertificate;
use App\tutorEducation;
use App\tutorNotificationSettings;
use App\TutorScheduleTimeBlocks;
use App\TutorTimeOff;
use App\tutorWorkExperience;
use App\User;
use App\UserLanguages;
use App\TutorPreferedStudentAge;
use App\TutorPreferedStudentLevel;
use Carbon\Carbon;
use Carbon\Language;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;
use App\Course;
use Illuminate\Support\Facades\Redirect;
use App\CourseChapter;
use App\PreferredStudentAge;
use App\PreferredStudentLevel;
use App\Organization;
use App\PartnerTutor;
use App\Student_package;
use App\TutorPackage;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\TutorCommission;
use App\TutorCommissionLog;
use App\TutorCountryPricePerHour;
use App\UserDetails;
use App\Setting;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{

    /*
	** View all tutors
	** Return view
	*/
	public function tutors()
    {
		$countries = Allcountry::all();
		$organizations = Organization::all();
		$preferredStudentAges = PreferredStudentAge::all();
		$preferredStudentLevels = PreferredStudentLevel::all();
		$specialties = Specialties::all();
		$languages = AllLanguages::all();
		$languageLevels = LanguageLevels::all();
		
		return view('admin.users.tutors.index')->with(['countries'=>$countries, 'countryOfResidences'=>$countries, 'organizations'=>$organizations, 'preferredStudentAges'=>$preferredStudentAges, 'preferredStudentLevels'=>$preferredStudentLevels, 'specialties'=>$specialties, 'tutorLanguages'=>$languages, 'languageLevels'=>$languageLevels]);
    }
	
	/**
	** Get all tutors with details
	** Return json data
	*/
	public function getTutors(Request $request)
    {
        $columns = array(
            0 => 'instructors.id',
			//1 => 'image',
            2 => 'users.fname',
            3 => 'users.email',
            4 => 'users.mobile',
			//5 => 'organization',
			6 => 'users.country_id',
            7 => 'users.country_residence_id',
			8 => 'instructors.PricePerHour',
			//9 => 'instructors.details',
			10 => 'users.gender',
            11 => 'users.email_verified_at',
			12 => 'users.status',
			13 => 'instructors.status',
			14 => 'instructors.recommendation',
			//15 => 'language',
			//16 => 'preferredStudentAge',
			//17 => 'preferredStudentLevel',
			//18 => 'specialty',
			19 => 'users.created_at',
			//20 => 'edit',
			//21 => 'delete',
        );
		
		$genders = ['m'=>__('adminstaticword.Male'), 'f'=>__('adminstaticword.Female'), 'o'=>__('adminstaticword.Other')];
		
		$query = Instructor::leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('instructors.id as id','instructors.PricePerHour as PricePerHour','instructors.specialty as specialty','instructors.status as tutorStatus','instructors.recommendation as recommendation','users.id as user_id','users.gender as gender','users.email_verified_at as email_verified_at','users.status as status','users.user_img as image','users.fname as fname','users.lname as lname','users.email as email','users.mobile as mobile','users.created_at as created_at')
				->where(['users.role'=>'instructor']);

		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value');
			$query->where(function($q) use ($search) {
				$q->where('users.fname', 'LIKE', "%{$search}%")
				  ->orWhere('users.lname', 'LIKE',"%{$search}%")
				  ->orWhere('users.email', 'LIKE',"%{$search}%")
				  ->orWhere('users.mobile', 'LIKE',"%{$search}%")
				  ->orWhere('instructors.PricePerHour', 'LIKE',"%{$search}%")
				  ->orWhere('instructors.headline', 'LIKE',"%{$search}%")
				  ->orWhere('instructors.detail', 'LIKE',"%{$search}%");
			});
		}
		
		if(!empty($request->input('country')))
		{
			$query->whereIn('users.country_id', $request->input('country'));
		}
		
		if(!empty($request->input('countryOfResidence')))
		{
			$query->whereIn('users.country_residence_id', $request->input('countryOfResidence'));
		}
		
		if(in_array($request->input('recommendation'), [0,1]))
		{
			$query->where('instructors.recommendation', $request->input('recommendation'));
		}
		
		if(!empty($request->input('organization')))
		{
			$organizations = $request->input('organization'); 
			$query->whereHas('tutor', function($q) use ($organizations) {
				$q->whereHas('partner', function($qq) use ($organizations) {
					$qq->whereHas('userorganization', function($qqq) use ($organizations) {
						$qqq->whereIn('organization_id', $organizations);
					});
				});
			});
		}
		
		if(in_array($request->input('status'), [0,1]))
		{
			$query->where('users.status', $request->input('status'));
		}
		
		if(in_array($request->input('tutorStatus'), [0,1]))
		{
			$query->where('instructors.status', $request->input('tutorStatus'));
		}
		
		if(!empty($request->input('gender')))
		{
			$gender = $request->input('gender');
			if(($key = array_search('null', $gender)) !== false)
			{
				unset($gender[$key]);
				if(count($gender) > 0)
				{
					$query->where(function ($q) use ($gender) {
						$q->whereIn('users.gender',$gender)->orWhereNull('users.gender');                  
					});
				}
				else $query->where('users.gender', NULL);
			}
			else $query->whereIn('users.gender', $gender);
		}
		
		if(in_array($request->input('verification'), [0,1]))
		{
			if($request->input('verification') == 1) $query->where('users.email_verified_at', '!=', NULL);
			else $query->where('users.email_verified_at', NULL);
		}
		
		if(!empty($request->input('language')))
		{
			$languages = $request->input('language'); 
			$query->whereHas('languages', function($q) use ($languages) {
				$q->whereIn('language_id', $languages);
			});
		}
		
		if(!empty($request->input('languageLevel')))
		{
			$languageLevels = $request->input('languageLevel'); 
			$query->whereHas('languages', function($q) use ($languageLevels) {
				$q->whereIn('level_id', $languageLevels);
			});
		}
		
		if(!empty($request->input('preferredStudentAge')))
		{
			$preferredStudentAges = $request->input('preferredStudentAge'); 
			$query->whereHas('prefered_student_age', function($q) use ($preferredStudentAges) {
				$q->whereIn('prefered_student_age_id', $preferredStudentAges);
			});
		}
		
		if(!empty($request->input('preferredStudentLevel')))
		{
			$preferredStudentLevels = $request->input('preferredStudentLevel'); 
			$query->whereHas('prefered_student_level', function($q) use ($preferredStudentLevels) {
				$q->whereIn('prefered_student_level_id', $preferredStudentLevels);
			});
		}
		
		if(!empty($request->input('specialty')))
		{
			$query->whereIn('instructors.specialty', $request->input('specialty'));
		}
		
		if(!empty($request->input('date')))
		{
			$query->whereDate('users.created_at', $request->input('date'));
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['image'] = ($single->image and file_exists(public_path().'/images/user_img/'.$single->image))? '<img src="'.asset('images/user_img/'.$single->image).'" class="img-responsive">':'<img src="'.asset('images/user_img/general.png').'" class="img-responsive">';
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				
				$nestedData['organization'] = '';
				if($single->tutor->count())
				{
					$organizations = [];
					foreach($single->tutor as $organization)
					{
						$organizations[] = $organization->partner->userorganization->organization->name;
					}
					$nestedData['organization'] .= implode(', ', $organizations);
				}
				
				$nestedData['country'] = ($single->user->country)? $single->user->country->nicename:'';
				$nestedData['countryOfResidence'] = ($single->user->country_residence)? $single->user->country_residence->nicename:'';
				$nestedData['pricePerHour'] = $single->PricePerHour;
				$nestedData['detail'] = '<a onclick="showDetail('.$single->id.','."'".str_replace('"', '', str_replace("'", '', $single->fname)).' '.str_replace('"', '', str_replace("'", '', $single->lname))."'".','."'".'tutor'."'".','."'".$single->image."'".')"><span class="label label-primary">'.__('adminstaticword.Detail').'</span></a>';
				$nestedData['gender'] = (array_key_exists($single->gender, $genders))? $genders[$single->gender]:__('adminstaticword.not_specified');
				$nestedData['verification'] = ($single->email_verified_at)? date('j M Y h:i a',strtotime($single->email_verified_at)):'';
				$nestedData['status'] = ($single->status)? '<span class="label label-success changData" id="'.$single->user_id.'" type="status" to="0">'.__('adminstaticword.Active').'</span>':'<span class="label label-danger changData" id="'.$single->user_id.'" type="status" to="1">'.__('adminstaticword.notActive').'</span>';
				$nestedData['tutorStatus'] = ($single->tutorStatus)? '<span class="label label-success changData" id="'.$single->id.'" type="tutorStatus" to="0">'.__('adminstaticword.Approved').'</span>':'<span class="label label-danger changData" id="'.$single->id.'" type="tutorStatus" to="1">'.__('adminstaticword.Pending').'</span>';
				$nestedData['recommendation'] = ($single->recommendation)? '<span class="label label-success changData" id="'.$single->id.'" type="recommendation" to="0">'.__('adminstaticword.recommended').'</span>':'<span class="label label-danger changData" id="'.$single->id.'" type="recommendation" to="1">'.__('adminstaticword.notrecommended').'</span>';
				
				$nestedData['language'] = '';
				if($single->languages->count())
				{
					$languages = [];
					foreach($single->languages as $language)
					{
						$languages[] = $language->language->isoName.' - '.$language->level->name;
					}
					$nestedData['language'] .= implode(', ', $languages);
				}
				
				$nestedData['preferredStudentAge'] = '';
				if($single->prefered_student_age->count())
				{
					$prefered_student_ages = [];
					foreach($single->prefered_student_age as $prefered_student_age)
					{
						$prefered_student_ages[] = $prefered_student_age->prefered_student_age->age;
					}
					$nestedData['preferredStudentAge'] .= implode(', ', $prefered_student_ages);
				}
				
				$nestedData['preferredStudentLevel'] = '';
				if($single->prefered_student_level->count())
				{
					$prefered_student_levels = [];
					foreach($single->prefered_student_level as $prefered_student_level)
					{
						$prefered_student_levels[] = $prefered_student_level->prefered_student_level->student_level;
					}
					$nestedData['preferredStudentLevel'] .= implode(', ', $prefered_student_levels);
				}
				
				$nestedData['specialty'] = ($single->specialty)? str_replace('_', ' ', $single->tutor_specialty->specialty):'';
				$nestedData['created_at'] = ($single->created_at)? date('j M Y h:i a',strtotime($single->created_at)):'';
				$nestedData['edit'] = '<a href="'.route('user.edit', $single->user_id).'" target="_blank"><span class="btn btn-success spanBtn"><i class="glyphicon glyphicon-edit"></i></span></a>';
				$nestedData['delete'] = '<span class="btn btn-danger spanBtn changData" id="'.$single->id.'" type="delete" to="0"><i class="glyphicon glyphicon-trash"></i></span>';
				
				$data[] = $nestedData;
            }
        }
		
		$json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data); 
    }
	
	/**
	** Get tutor detail
	** Return json data
	*/
	public function getTutorDetail(Request $request)
    {
		$json_data = [];
		if(!empty($request->input('id')) && $request->input('id') != 0)
		{
			$tutor = Instructor::find($request->input('id'));
			if($tutor)
			{
				$detail = new MessagesController();
				$json_data['data']['headline'] = ($tutor->headline)? $tutor->headline:__('frontstaticword.thereAreNoData');
				$json_data['data']['detail'] = ($tutor->detail)? $detail->textDiv($tutor->detail, 111):__('frontstaticword.thereAreNoData');
				$json_data['data']['file'] = ($tutor->file and file_exists(public_path().'/files/instructor/'.$tutor->file))? '<a href="'.asset('files/instructor/'.$tutor->file).'" download="'.$tutor->file.'">'.__('adminstaticword.Download').' <i class="fa fa-download"></i></a>':__('frontstaticword.thereAreNoData');
				
				$json_data['data']['video'] = '';
				if($tutor->user->youtube_url or ($tutor->video and file_exists(public_path().'/files/instructor/'.$tutor->video)))
				{
					$json_data['data']['video'] .= ($tutor->video and file_exists(public_path().'/files/instructor/'.$tutor->video))? '<video class="tutor-video" height="195" style="max-width:45%;" class="player-course-chapter-list" loop src="'.asset('files/instructor/'.$tutor->video).'" controls></video>':'';
					$json_data['data']['video'] .= ($tutor->user->youtube_url)? '<iframe class="tutor-video" height="183" width="45%" src="'.$tutor->user->youtube_url.'"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>':'';
				}
				else $json_data['data']['video'] .= __('frontstaticword.thereAreNoData');
				
				$json_data['data']['schedule'] = '';
				if($tutor->schedule->count())
				{
					$week = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
					foreach($week as $key => $day)
					{
						if($tutor->schedule->where('day', $day)->count())
						{
							$json_data['data']['schedule'] .= '<div class="row"><div class="col-md-2"><b>'.$day.'</b></div><div class="col-md-10">';
							foreach($tutor->schedule->where('day', $day) as $schedule)
							{
								$json_data['data']['schedule'] .= '<span class="label label-default">'.substr($schedule->start_time, 0, 5).'</span> ';
							}
							$json_data['data']['schedule'] .= '</div></div>';
						}
					}
				}
				else $json_data['data']['schedule'] .= __('frontstaticword.thereAreNoData');
				
				$json_data['data']['education'] = '';
				if($tutor->education->count())
				{
					$json_data['data']['education'] .= '<div class="row"><div class="col-md-1"></div><div class="col-md-2"><b>'.__('adminstaticword.period').'</b></div><div class="col-md-2"><b>'.__('adminstaticword.university').'</b></div><div class="col-md-3"><b>'.__('adminstaticword.degree').'</b></div><div class="col-md-3"><b>'.__('adminstaticword.specialty').'</b></div><div class="col-md-1"><b>'.__('adminstaticword.file').'</b></div></div>';
					foreach($tutor->education as $key => $education)
					{
						$file = ($education->file)? '<a style=" color: #af8b62" href="'.asset('files/instructor/attachs/'.$education->file).'" download="'.$education->file.'"><i class="fa fa-download" style=" color: #af8b62"></i></a>':'';
						$json_data['data']['education'] .= '<div class="row"><div class="col-md-1"><b>'.($key+1).' </b></div><div class="col-md-2">'.$education->from.'-'.$education->to.'</div><div class="col-md-2">'.$education->university.'</div><div class="col-md-3">'.$education->degree.'</div><div class="col-md-3">'.$education->specialty.'</div><div class="col-md-1">'.$file.'</div></div>';
					}
				}
				else $json_data['data']['education'] .= __('frontstaticword.thereAreNoData');
				
				$json_data['data']['certificate'] = '';
				if($tutor->certificate->count())
				{
					$json_data['data']['certificate'] .= '<div class="row"><div class="col-md-1"></div><div class="col-md-2"><b>'.__('adminstaticword.period').'</b></div><div class="col-md-2"><b>'.__('adminstaticword.certificate').'</b></div><div class="col-md-2"><b>'.__('adminstaticword.issued_by').'</b></div><div class="col-md-4"><b>'.__('adminstaticword.Description').'</b></div><div class="col-md-1"><b>'.__('adminstaticword.file').'</b></div></div>';
					foreach($tutor->certificate as $key => $certificate)
					{
						$file = ($certificate->file)? '<a style=" color: #af8b62" href="'.asset('files/instructor/attachs/'.$certificate->file).'" download="'.$certificate->file.'"><i class="fa fa-download" style=" color: #af8b62"></i></a>':'';
						$issued_by = 'Issued by';
						$json_data['data']['certificate'] .= '<div class="row"><div class="col-md-1"><b>'.($key+1).' </b></div><div class="col-md-2">'.$certificate->from.'-'.$certificate->to.'</div><div class="col-md-2">'.$certificate->certificate.'</div><div class="col-md-2">'.$certificate->$issued_by.'</div><div class="col-md-4">'.$certificate->description.'</div><div class="col-md-1">'.$file.'</div></div>';
					}
				}
				else $json_data['data']['certificate'] .= __('frontstaticword.thereAreNoData');
				
				$json_data['data']['work'] = '';
				if($tutor->work_experience->count())
				{
					$json_data['data']['work'] .= '<div class="row"><div class="col-md-1"></div><div class="col-md-2"><b>'.__('adminstaticword.period').'</b></div><div class="col-md-4"><b>'.__('adminstaticword.company').'</b></div><div class="col-md-4"><b>'.__('adminstaticword.Title').'</b></div><div class="col-md-1"><b>'.__('adminstaticword.file').'</b></div></div>';
					foreach($tutor->work_experience as $key => $work)
					{
						$file = ($work->file)? '<a style=" color: #af8b62" href="'.asset('files/instructor/attachs/'.$work->file).'" download="'.$work->file.'"><i class="fa fa-download" style=" color: #af8b62"></i></a>':'';
						$json_data['data']['work'] .= '<div class="row"><div class="col-md-1"><b>'.($key+1).' </b></div><div class="col-md-2">'.$work->from.'-'.$work->to.'</div><div class="col-md-4">'.$work->company.'</div><div class="col-md-4">'.$work->title.'</div><div class="col-md-1">'.$file.'</div></div>';
					}
				}
				else $json_data['data']['work'] .= __('frontstaticword.thereAreNoData');
				
				$json_data['status'] = 1;
				$json_data['message'] = '';
			}
			else
			{
				$json_data['status'] = 0;
				$json_data['message'] = '<h4>'.__('adminstaticword.wrongdata').'</h4>';
			}
		}
		else
		{
			$json_data['status'] = 0;
			$json_data['message'] = '<h4>'.__('adminstaticword.wrongdata').'</h4>';
		}
            
        echo json_encode($json_data); 
    }
	
	/**
	** Change tutor data
	** Return json status and message
	*/
	public function changeTutorData(Request $request)
	{
		$json_data = [];
		$error = 0;
		if(!empty($request->input('id')) && !empty($request->input('type')) && $request->input('id') > 0 && in_array($request->input('to'), [0,1]))
		{
			$type = $request->input('type');
			switch($type)
			{
				case "status":
					$user = User::find($request->input('id'));
					if($user) $update = $user->update(['status'=>$request->input('to')]);
					else $error = 1;
					break;
				case "tutorStatus":
					$tutor = Instructor::find($request->input('id'));
					if($tutor)
					{
						if($tutor->status != $request->input('to'))
						{
							$update = $tutor->update(['status'=>$request->input('to')]);
							$settings = Setting::find(1);
							if(env('MAIL_USERNAME') != Null) {
								$settings->action = 'approved';
								$m = ($request->input('to'))? __('backend.shown'):__('backend.hidden');
								try{
									$x = __('backend.tutor_status_change_message', ['param'=>$m]);
									Mail::to($tutor->user->email)->send(new UserAppointment($x, $settings, 0));
								}catch(\Swift_TransportException $e){
								}
							}
						}
						else $error = 1;
					}
					else $error = 1;
					break;
				case "recommendation":
					$tutor = Instructor::find($request->input('id'));
					if($tutor)
					{
						if($tutor->recommendation != $request->input('to'))
						{
							$update = $tutor->update(['recommendation'=>$request->input('to')]);
							$settings = Setting::find(1);
							if(env('MAIL_USERNAME') != Null) {
								$settings->action = 'recommended';
								$m = ($request->input('to'))? __('backend.recommended'):__('backend.not_recommended');
								try{
									$x = __('backend.tutor_recommendation_change_message', ['param'=>$m]);
									Mail::to($tutor->user->email)->send(new UserAppointment($x, $settings, 0));
								}catch(\Swift_TransportException $e){
								}
							}
						}
						else $error = 1;
					}
					else $error = 1;
					break;
				case "delete":
					$tutor = Instructor::find($request->input('id'));
					if($tutor)
					{
						$user = User::find($tutor->user_id);
						
						PartnerTutor::where('tutor_id',$tutor->id)->delete();
						Student_package::where('tutor_id', $tutor->id)->delete();
						TutorPreferedStudentAge::where('tutor_id', $tutor->id)->delete();
						TutorPreferedStudentLevel::where('tutor_id', $tutor->id)->delete();
						TutorPackage::where('tutor_id', $tutor->id)->delete();
						UserTutorBalance::where('tutor_id', $tutor->id)->delete();
						UserTutorBalanceLog::where('tutor_id', $tutor->id)->delete();
						TutorCommission::where('tutor_id', $tutor->id)->delete();
						TutorCommissionLog::where('tutor_id', $tutor->id)->delete();
						tutorWorkExperience::where('tutor_id', $tutor->id)->delete();
						TutorTimeOff::where('tutor_id', $tutor->id)->delete();
						TutorScheduleTimeBlocks::where('user_id', $tutor->user_id)->delete();
						tutorEducation::where('tutor_id', $tutor->id)->delete();
						Tutor_payment_info::where('tutor_id', $tutor->id)->delete();
						tutorCertificate::where('tutor_id', $tutor->id)->delete();
						UserLanguages::where('user_id', $tutor->id)->delete();
						BBL::where('instructor_id', $tutor->id)->delete();
						Appointment::where('instructor_id', $tutor->id)->delete();
						TutorCountryPricePerHour::where('tutor_id', $tutor->id)->delete();
						UserCategory::where('user_id', $tutor->user_id)->delete();
						UserLanguages::where('user_id', $tutor->user_id)->delete();
					
						$user_details = UserDetails::where('user_id', $tutor->user_id)->first();
						if($user_details)
						{
							$this->delete_file('images/national_id/', $user_details->national_id_image);
							$user_details->delete();
						}
						
						$tutor_certificates = tutorCertificate::where('tutor_id', $tutor->id)->get();
						foreach($tutor_certificates as $tutor_certificate)
						{
							$this->delete_file('files/instructor/attachs/', $tutor_certificate->file);
							$tutor_certificate->delete();
						}
						
						$tutor_educations = tutorEducation::where('tutor_id', $tutor->id)->get();
						foreach($tutor_educations as $tutor_education)
						{
							$this->delete_file('files/instructor/attachs/', $tutor_education->file);
							$tutor_education->delete();
						}
						
						$tutor_work_experiences = tutorWorkExperience::where('tutor_id', $tutor->id)->get();
						foreach($tutor_work_experiences as $tutor_work_experience)
						{
							$this->delete_file('files/instructor/attachs/', $tutor_work_experience->file);
							$tutor_work_experience->delete();
						}
						
						if ($user->user_img != null && $user->user_img != 'general.png')
						{
							$image_file = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);
							if($image_file)
							{
								unlink(public_path().'/images/user_img/'.$user->user_img);
							}
						}
						$user->delete();
						
						$update = $tutor->delete();
					}
					else $error = 1;
					break;
				default:
			}
			
			if($error || !$update)
			{
				$json_data['status'] = 0;
				$json_data['message'] = __('adminstaticword.recordIsNotFound');
			}
			else
			{
				$json_data['status'] = 1;
				$json_data['message'] = __('adminstaticword.recordChangedSuccessfully');
			}
		}
		else
		{
			$json_data['status'] = 0;
			$json_data['message'] = __('adminstaticword.wrongdata');
		}
		echo json_encode($json_data); 
	}
	
	public function delete_file($path, $file)
	{
		if($file and file_exists($path.$file)) unlink($path.$file);
	}
	
	public function index()
    {
        if(Auth::User()->role == "instructor")
        {
            return view('instructor.dashboard');
        }
        else
        {
            return __('backend.youre_not_a_instructor');
        }
    }

    public function getTutorProfile(){
        $userId = Auth::user()->id;
        $tutor = Instructor::with('user')->where('user_id', $userId)->first();
//        $notification = Notifications::where('id', 1)->first();

//        event(new StatusNotification($tutor, $notification));


        if ($tutor == null){
            Session::flash('success',__('backend.please_complete_your_profile_to_be_a_valid_tutor'));
            return redirect('/tutor/registration/steps');
        }
        $countries = Allcountry::all();
        $allLanguages = AllLanguages::all();
        $timeZones = DB::table('time_zones')->where('status', '!=', 'Deprecated')->get();
        $categories = Categories::where(['status'=>1])->get();
        $days = Carbon::getDays();
        $languagesSpoken = DB::table('user_language')
            ->where('user_language.user_id', $userId)
            ->join('all_languages', 'all_languages.id', '=','user_language.language_id')
            ->select('user_language.language_id', 'user_language.level_id', 'all_languages.isoName As language')->get();

//        $tutorSpecialties = Specialties::all();
        $tutorPaymentInfo = Tutor_payment_info::where('tutor_id', $tutor->id)->first();


        $notificationTypes = DB::table('notifications_types')->get();

        $tutorNotificationsSettings = tutorNotificationSettings::where('user_id', $userId)->get();
        $tutorEducations = new tutorEducation();
        $tutorCertificates = new tutorCertificate();
        $tutorExperiences = new tutorWorkExperience();

        if (isset($tutor->id)) {
            $tutorEducations = $tutorEducations->where('tutor_id', $tutor->id)->get();

            $tutorCertificates = $tutorCertificates->where('tutor_id', $tutor->id)->get();

            $tutorExperiences = $tutorExperiences->where('tutor_id', $tutor->id)->get();
        }

        return view('frontend.tutor-profile', compact('tutor', 'countries', 'allLanguages', 'timeZones', 'categories', 'days', 'languagesSpoken', 'tutorPaymentInfo','notificationTypes', 'tutorNotificationsSettings', 'tutorEducations', 'tutorCertificates','tutorExperiences'));

    }

    public function updateTutorProfile(Request $request){
//dd($request->all());
        $validData = $request->validate([]);

        $userId = auth::user()->id;
        $user = User::where('id', $userId)->first();
        $tutor = Instructor::where('user_id', $userId)->first();

        if ($request->page == "about"){
            /*if ($request->mobile == null){
                $validData = [
                    'email' => 'email|max:255|required|unique:users,email,'.$user->id,
                ];
            }else {*/
                $validData = [
                    'email' => 'email|max:255|required|unique:users,email,' . $user->id,
                    'mobile' => 'required|digits_between:9,15|unique:users,mobile,' . $user->id,
					'country_residence' => 'required|integer',
					'categories' => 'required|array',
					'categories.*' => 'required|integer',
					'PricePerHour' => 'required|numeric|min:1|max:9000000000000000000',
                ];
                $validator = Validator::make($request->all(), $validData);
                if ($validator->fails()) {
                    Session::flash('message', __('backend.error'));
                    Session::flash('message-type', "danger");
                    return redirect()->back()->withInput()->withErrors($validator);
                }
            //}

            $user->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country_id,
				'country_residence_id' => $request->country_residence,
                'time_zone_id' => $request->time_zone_id,

            ]);
			
			UserCategory::where(['user_id'=>$userId])->delete();
			foreach($request->categories as $category)
			{
				UserCategory::create([
					'user_id' => $userId,
					'subcategory_id' => $category,
					'created_by' => $userId,
				]);
			}


            $ZoneTime = $user->timeZone->time;
            $time_zone_name = $user->timeZone->time_zone_name;

            $timeZone = explode(':', $ZoneTime);

            Session::put(['currentTimeZoneName' => $time_zone_name ? $time_zone_name : "Africa/Cairo"]);
            Session::put(['currentTimeZone' => $ZoneTime]);
            Session::put(['currentTimeZoneHour' => $timeZone[0]]);
            Session::put(['currentTimeMinutes' => $timeZone[1]]);
			
            if ($tutor == null){
                $tutor = new Instructor();
                $tutor->create([
                    'user_id' => auth()->id(),
                    'PricePerHour' => $request->PricePerHour,
                ]);
				
                $newTutorPaymentInfo = new Tutor_payment_info();
                $newTutorPaymentInfo->create([
                   'tutor_id' => $tutor->id,
                   'account_number' => $request->account_number,
                   'account_name' => $request->account_name,
                   'iban' => $request->iban
                ]);

            }else {
                $tutor->update([
                    'PricePerHour' => $request->PricePerHour,
                ]);
            $tutorPaymentInfo = Tutor_payment_info::where('tutor_id', $tutor->id)->first();
            if ($tutorPaymentInfo == null){
                $newTutorPaymentInfo = new Tutor_payment_info();
                $newTutorPaymentInfo->create([
                    'tutor_id' => $tutor->id,
                    'account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'iban' => $request->iban
                ]);
            }else{
                $tutorPaymentInfo->update([
                    'account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'iban' => $request->iban
                ]);
            }

            }
			
            UserLanguages::where(['user_id'=>$userId])->delete();
			if (isset($request->Languages)) {
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
            session(['pageTab' => 1]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();

        }

        elseif ($request->page == "profile description"){
            $validData = [
                'user_img' => 'max:2048'
            ];
            $validator = Validator::make($request->all(), $validData);
            if ($validator->fails()) {
                Session::flash('message', __('backend.error'));
                Session::flash('message-type', "danger");
                return redirect()->back()->withInput()->withErrors($validator);
            }
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
                $input['user_img'] = $image;
            }

            $tutor->update($input);
            $user->update($input);

            session(['pageTab' => 2]);
            Session::flash('success',__('backend.updated_successfully'));

            return redirect()->back();




        }

        elseif ($request->page == "video") {

            $userId = auth::user()->id;
            $tutor = Instructor::where('user_id', $userId)->first();

            if($file = $request->file('uploadVideo'))
            {
                $validData = [
                    'uploadVideo' => 'max:102400', //100MB

                ];
                $validator = Validator::make($request->all(), $validData);

                if ($validator->fails()) {

                    Session::flash('error',__('backend.max_video_size_is_number_mb', ['number'=>100]));
                    return redirect()->to('tutor/profile');
                }

                $input = $request->uploadVideo;
                $name = time().$file->getClientOriginalName();
                $file->move('files/instructor/',$name);
                $tutor->update(['video' => $name]);
                $user->update(['youtube_url' => null]);

            }else{
            $validData = [
                'url'=> ['regex:/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/'],

            ];
            $validator = Validator::make($request->all(), $validData);
            if ($validator->fails()) {
                Session::flash('error','Invalid Video Url!');
                return redirect()->to('tutor/profile');
            }

            $request->url = str_replace('watch?v=', 'embed/', $request->url);
            $user->update(['youtube_url' => $request->url]);
            $tutor->update(['video' => null]);
            }
            session(['pageTab' => 3]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();
        }

        elseif ($request->page == "password"){

            if(! Hash::check( $request->oldPassword, $user->password ) )
            {
                Session::flash('error',__('backend.current_password_error'));
                return Redirect::to('tutor/profile')->withInput();
            }

            if ($request->password == $request->vPassword){
                $validData =([
                 'password' => ['required','string','min:6'],
                 'vPassword' => ['required','string','min:6'],
                ]);
                $validator = Validator::make($request->all(), $validData);
                if ($validator->fails()) {
                    Session::flash('error', __('backend.error'));
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                $user->update(['password' => Hash::make($request->vPassword)]);
                Auth::login($user);
            }else{
                Session::flash('error',__('backend.password_not_matched'));
                return redirect()->to('tutor/profile');
            }
            session(['pageTab' => 6]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();

        }

        elseif ($request->page == "notification") {

            if ($request->notification != null) {
                $tutorOldSettings = tutorNotificationSettings::where('user_id', $userId)->count();

                if ($tutorOldSettings == 0) {
                    foreach ($request->notification as $notificationTypeId) {

                        $tutorNotification = new tutorNotificationSettings();
                        $tutorNotification->create([
                            'user_id' => $userId,
                            'type_id' => $notificationTypeId
                        ]);
                    }
                } else {
                    $tutorSettingsUpdate = tutorNotificationSettings::where('user_id', $userId)->get();

                    foreach ($tutorSettingsUpdate as $oldNotifications) {
                        $oldNotifications->delete();
                    }
                    foreach ($request->notification as $notificationTypeId) {

                        $tutorNotification = new tutorNotificationSettings();
                        $tutorNotification->create([
                            'user_id' => $userId,
                            'type_id' => $notificationTypeId
                        ]);
                    }
                }
            }
            session(['pageTab' => 7]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();
        }

        elseif ($request->page == "addEducation")
        {
            if ($request->from > $request->to){
                Session::flash('error',__('backend.error_in_dates'));
                return redirect()->back();
            }

			$attach_file_name = NULL;
			if($request->hasFile('attach_file')) $attach_file_name = $this->upload_file($request->file('attach_file'));
			
            $tutor_education = new tutorEducation();
            $tutor_education->create([
               'tutor_id' => $tutor->id,
                'university' => $request->college,
                'degree' => $request->Degree,
                'specialty' => $request->speciality,
				'file' => $attach_file_name,
                'from' => $request->from,
                'to' => $request->to
            ]);
            if(env('MAIL_USERNAME')!=null) {
                try{

                    /*sending email*/
                    $x = __('backend.tutor_add_document', ['number'=>5]);
            //                    dd($request->user);
                    Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
            }
            session(['pageTab' => 5]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();
        }

        elseif ($request->page == "addExperience"){
            if ($request->from > $request->to){
                Session::flash('error',__('backend.error_in_dates'));
                return redirect()->back();
            }
			
			$attach_file_name = NULL;
			if($request->hasFile('attach_file')) $attach_file_name = $this->upload_file($request->file('attach_file'));
			
            $tutor_experience = new tutorWorkExperience();
            $tutor_experience->create([
                'tutor_id' => $tutor->id,
                'company' => $request->company,
                'title' => $request->title,
				'file' => $attach_file_name,
                'from' => $request->from,
                'to' => $request->to
            ]);
            if(env('MAIL_USERNAME')!=null) {
                try{

                    /*sending email*/
                    $x = __('backend.tutor_add_document', ['number'=>5]);
            //                    dd($request->user);
                    Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
            }
            session(['pageTab' => 5]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();
        }

        elseif ($request->page == "addCertificate"){
            if ($request->from > $request->to){
                Session::flash('error',__('backend.error_in_dates'));
                return redirect()->back();
            }
			
			$attach_file_name = NULL;
			if($request->hasFile('attach_file')) $attach_file_name = $this->upload_file($request->file('attach_file'));
			
            $tutor_certificate = new tutorCertificate();
            $tutor_certificate->create([
                'tutor_id' => $tutor->id,
                'certificate' => $request->certificate,
                'description' => $request->description,
                'Issued by' => $request->issuedBy,
				'file' => $attach_file_name,
                'from' => $request->from,
                'to' => $request->to
            ]);

            if(env('MAIL_USERNAME')!=null) {
                try{

                    /*sending email*/
                    $x = __('backend.tutor_add_document', ['number'=>5]);
//                    dd($request->user);
                    Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));


                }catch(\Swift_TransportException $e){
                    return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
                }
            }
            session(['pageTab' => 5]);
            Session::flash('success',__('backend.updated_successfully'));
            return redirect()->back();
        }

        elseif ($request->page == "document"){

            if($file = $request->file('file'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('files/instructor/',$name);
            }
            $tutor->update(['file' => $name]);
        }
        session(['pageTab' => 4]);
        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();
    }

    public function Unsubscribe(){
        $userId = auth::user()->id;
        tutorNotificationSettings::where('user_id', $userId)->delete();

        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();

    }

    public function updateTutorCertificate(Request $request){
        if ($request->from > $request->to){
            Session::flash('error',__('backend.error_in_dates'));
            return redirect()->back();
        }
        $inputs = $request->all();
        $certificate = tutorCertificate::where('id', $request->certificateId)->first();
		
		if($request->hasFile('attach_file')) $inputs['file'] = $this->replace_file($request->file('attach_file'), $certificate->file);
		
        $certificate->update($inputs);

        if(env('MAIL_USERNAME')!=null) {
            try{
                /*sending email*/
                $x = __('backend.tutor_add_document', ['number'=>5]);
                Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));

            }catch(\Swift_TransportException $e){
                return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
            }
        }

        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();
    }

    public function updateTutorExperience(Request $request){
        if ($request->from > $request->to){
            Session::flash('error',__('backend.error_in_dates'));
            return redirect()->back();
        }
        $inputs = $request->all();
        $experience = tutorWorkExperience::where('id', $request->experienceId)->first();
		
		if($request->hasFile('attach_file')) $inputs['file'] = $this->replace_file($request->file('attach_file'), $experience->file);
		
        $experience->update($inputs);
        if(env('MAIL_USERNAME')!=null) {
            try{

                /*sending email*/
                $x = __('backend.tutor_add_document', ['number'=>5]);
//                    dd($request->user);
                Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));


            }catch(\Swift_TransportException $e){
                return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
            }
        }
        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();
    }

    public function updateTutorEducation(Request $request){
        if ($request->from > $request->to){
            Session::flash('error',__('backend.error_in_dates'));
            return redirect()->back();
        }
        $inputs = $request->all();
		$education = tutorEducation::where('id', $request->educationId)->first();
		
		if($request->hasFile('attach_file')) $inputs['file'] = $this->replace_file($request->file('attach_file'), $education->file);
		
        $education->update($inputs);
        if(env('MAIL_USERNAME')!=null) {
            try{

                /*sending email*/
                $x = __('backend.tutor_add_document', ['number'=>5]);
                Mail::to(auth()->user()->email)->send(new UserAppointment($x, $request));

            }catch(\Swift_TransportException $e){
                return back()->with('success',__('backend.appointment_request_sent_successfully').' '.__('backend.but_mail_will_not_sent_because_of_error_in_mail_configuration'));
            }
        }
        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->back();
    }
	
	public function upload_file($file)
	{
		$attach_file_name = time().$file->getClientOriginalName();
        $file->move('files/instructor/attachs/',$attach_file_name);
		return $attach_file_name;
	}
	
	public function replace_file($new, $old)
	{
		if($old and file_exists('files/instructor/attachs/'.$old)) unlink('files/instructor/attachs/'.$old);
		return $this->upload_file($new);
	}

    public function deleteTutorEducation($id){

       $education = tutorEducation::where('id', $id)->first();
	   if($education->file and file_exists('files/instructor/attachs/'.$education->file)) unlink('files/instructor/attachs/'.$education->file);
       $education->delete();
       Session::flash('success',__('backend.deleted_successfully'));
       return redirect()->back();
    }

    public function deleteTutorExperience($id){

        $experience = tutorWorkExperience::where('id', $id)->first();
		if($experience->file and file_exists('files/instructor/attachs/'.$experience->file)) unlink('files/instructor/attachs/'.$experience->file);
        $experience->delete();
        Session::flash('success',__('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function deleteTutorCertificate($id){

        $certificate = tutorCertificate::where('id', $id)->first();
		if($certificate->file and file_exists('files/instructor/attachs/'.$certificate->file)) unlink('files/instructor/attachs/'.$certificate->file);
        $certificate->delete();
        Session::flash('success',__('backend.deleted_successfully'));
        return redirect()->back();

    }

    public function tutorLessons(){

        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

        if ($tutor == null){
            Session::flash('success',__('backend.please_complete_your_profile_to_be_a_valid_tutor'));
            return redirect('/tutor/registration/steps');
        }
        $lessons = Appointment::with('review')->where('appointments.instructor_id', $tutor->id)
            ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->select('appointments.*', 'appointment_status.status', 'users.fname', 'users.lname', 'users.user_img')
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        $Scheduled_lessons_counter = Appointment::where('appointments.instructor_id', $tutor->id)
            ->where('appointments.status_id', 1)
            ->count();

        $appointments_status = AppointmentStatus::all();

        $request = new Request();
        $request->status_id = 'all';

        $nextLesson = Appointment::where('appointments.instructor_id', $tutor->id)
            ->leftJoin('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->leftJoin('users', 'users.id', '=', 'appointments.user_id')
            ->leftJoin('bigbluemeetings', 'appointments.id', '=', 'bigbluemeetings.appointment_id')
            ->select('appointments.*','bigbluemeetings.id as meetingId', 'appointment_status.status', 'users.fname', 'users.lname', 'users.user_img')
            ->where('date','>=', date('Y-m-d'))
            ->whereIn('status_id', [1,3,5])
            // ->where('appointments.start_time', '>', Carbon::now()->subMinutes(15)->format('H:i:s') )
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
            $carbonDate->timezone = $time_zone->time_zone_name;
            $current_time_before_15_mins = $carbonDate->subMinutes(15)->format('H:i:s');
            $current_time_after_30_mins = $carbonDate->addMinutes(30)->format('H:i:s');
           if( ($correct_time > $current_time_before_15_mins) && ($correct_time < $current_time_after_30_mins ) ){

           }else{
            $nextLesson->forget($key);
           }
        }


        return view('frontend.user_profile.tutorLessons', compact('tutor', 'lessons', 'appointments_status', 'Scheduled_lessons_counter', 'nextLesson', 'request'));

    }



    public function tutorLessonsFiltering(Request $request){
        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

        if ($request->status_id == "all") {
            $lessons = Appointment::where('appointments.instructor_id', $tutor->id)
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('users', 'users.id', '=', 'appointments.user_id');
            if ($request->name != null) {
                $lessons = $lessons->where('users.fname', 'like', '%' . $request->name . '%');
            }
            $lessons = $lessons->select('appointments.*', 'appointment_status.status', 'users.fname', 'users.lname', 'users.user_img')
                ->get();
        }
        else{

            $lessons = Appointment::where('appointments.instructor_id', $tutor->id)
                ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->where('appointments.status_id', $request->status_id);
            if ($request->name != null) {
                $lessons = $lessons->where('users.fname', 'like', '%' . $request->name . '%');
            }
            $lessons = $lessons->select('appointments.*', 'appointment_status.status', 'users.fname', 'users.lname', 'users.user_img')
                ->get();
        }
        $Scheduled_lessons_counter = Appointment::where('appointments.instructor_id', $tutor->id)
            ->where('appointments.status_id', 1)
            ->count();

        $appointments_status = AppointmentStatus::all();

        $nextLesson = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('appointment_status', 'appointment_status.id', '=', 'appointments.status_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->select('appointments.*', 'appointment_status.status', 'users.fname', 'users.lname', 'users.user_img')
            ->where('date','>=', Carbon::now())
            // ->where('appointments.start_time', '>', Carbon::now()->subMinutes(15)->format('H:i:s') )
            ->get();
//        dd($nextLesson);

        return view('frontend.user_profile.tutorLessons', compact('lessons', 'appointments_status', 'Scheduled_lessons_counter', 'request', 'nextLesson', 'tutor'));

    }
    public function myStudents($id){

        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

        if ($tutor == null){
            Session::flash('success',__('backend.please_complete_your_profile_to_be_a_valid_tutor'));
            return redirect('/tutor/registration/steps');
        }

        $activeStudents = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('users', 'users.id', 'appointments.user_id')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->leftJoin('allcountry', 'allcountry.id', 'users.country_id')
            ->select('users.id','users.fname', 'users.lname', 'users.user_img','instructors.PricePerHour', 'allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('appointments.user_id')
            ->get();

//        $favouriteTutors = Instructor::with('user', 'schedule')
//            ->join('favourites', 'instructors.id','=', 'favourites.instructor_id')
//            ->where('favourites.user_id', $id)
//            ->join('users', 'users.id', 'instructors.user_id')
//            ->join('allcountry', 'allcountry.id', 'users.country_id')
//            ->select('instructors.id', 'instructors.user_id', 'instructors.PricePerHour', 'instructors.headline', 'instructors.detail', 'instructors.created_at','allcountry.name As country_name', 'allcountry.iso')
//            ->get();

        $randomStudents = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('users', 'users.id', 'appointments.user_id')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->leftJoin('allcountry', 'allcountry.id', 'users.country_id')
            ->select('users.id','users.fname', 'users.lname', 'users.user_img','instructors.PricePerHour', 'allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('appointments.user_id')
            ->inRandomOrder()->limit(4)
            ->get();
        return view('frontend.user_profile.myStudents', compact('activeStudents', 'randomStudents'));

    }


    public function myStudentsFiltering(Request $request){

        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

        $activeStudents = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('users', 'users.id', 'appointments.user_id')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->leftJoin('allcountry', 'allcountry.id', 'users.country_id');
            if ($request->name != null) {
                $activeStudents = $activeStudents->where('users.fname', 'like', '%' . $request->name . '%');
            }
        $activeStudents = $activeStudents->select('users.id','users.fname', 'users.lname', 'users.user_img','instructors.PricePerHour', 'allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('appointments.user_id')
            ->get();

        $randomStudents = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('users', 'users.id', 'appointments.user_id')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->leftJoin('allcountry', 'allcountry.id', 'users.country_id')
            ->select('users.id','users.fname', 'users.lname', 'users.user_img','instructors.PricePerHour', 'allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('appointments.user_id')
            ->inRandomOrder()->limit(4)
            ->get();

        return view('frontend.user_profile.myStudents', compact('activeStudents', 'randomStudents', 'request'));

    }


    public function myCalendar(){

        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

        if ($tutor == null){

            Session::flash('success',__('backend.please_complete_your_profile_to_be_a_valid_tutor'));
            return redirect('/tutor/registration/steps');
        }
        $myStudents = Appointment::where('appointments.instructor_id', $tutor->id)
            ->join('users', 'users.id', 'appointments.user_id')
            ->join('instructors', 'instructors.id', 'appointments.instructor_id')
            ->leftJoin('allcountry', 'allcountry.id', 'users.country_id')
            ->select('users.id','users.fname', 'users.lname', 'users.user_img','instructors.PricePerHour', 'allcountry.name As country_name', 'allcountry.iso')
            ->groupBy('appointments.user_id')
            ->get();

        return view('frontend.user_profile.tutorCalendar', compact('myStudents'));
    }


    public function scheduleNewLesson(Request $request){

        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();

//        dd(date_format($request->date, ''));
        $lesson =  new Appointment();
        $lesson->create([
           'start_time' => $request->from,
            'date' => $request->date,
            'user_id' => $request->student,
            'instructor_id' => $tutor->id,

        ]);
        Session::flash('success','Lesson Added Successfully !');

        return \redirect()->back();
    }

    public function addTimeOff(Request $request){

//        dd($request->allDay);
        $tutor = Instructor::where('instructors.user_id', '=', auth()->id())->first();
//dd($request->title);
        if ($request->allDay == null) {
            $time_off = new TutorTimeOff();
            $time_off->create([
                'tutor_id' => $tutor->id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'title' => $request->title,
                'message' => $request->message
            ]);
        }else{
            $time_off = new TutorTimeOff();
            $time_off->create([
                'tutor_id' => $tutor->id,
                'start_time' => "00:00:00",
                'end_time' => "23:59:59",
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'title' => $request->title,
                'message' => $request->message
            ]);

        }

        Session::flash('success',__('backend.created_successfully'));

        return \redirect()->back();
    }

    public function myAvailabilityTime(){

        $availableTimes = TutorScheduleTimeBlocks::where('user_id', auth()->id())->get();

        return view('frontend.user_profile.availabilityTime', compact('availableTimes'));
    }

    public function updateAvailabilityTime(Request $request){

        $oldAvailableTimes = TutorScheduleTimeBlocks::where('user_id', auth()->id())->get();

        foreach ($oldAvailableTimes as $oldAvailableTime ){

            $oldAvailableTime->delete();
        }




        if ($request->Sunday != null) {
            foreach ($request->Sunday as $slot) {

                $timeBlocks = new TutorScheduleTimeBlocks();
                $timeBlocks->create([
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
                    'start_time' => $slot,
                    'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                    'day' => 'Sunday',
                ]);}
        }
        if ($request->Monday != null) {

            foreach ($request->Monday as $slot) {

                $timeBlocks = new TutorScheduleTimeBlocks();
                $timeBlocks->create([
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
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
                    'user_id' => auth()->id(),
                    'zone' =>auth()->user()->time_zone_id,
                    'start_time' => $slot,
                    'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                    'day' => 'Tuesday',
                ]);}
        }
        if ($request->Wednesday != null){
            foreach ($request->Wednesday as $slot) {

                $timeBlocks = new TutorScheduleTimeBlocks();
                $timeBlocks->create([
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
                    'start_time' => $slot,
                    'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                    'day' => 'Wednesday',
                ]);}
        }
        if ($request->Thursday != null){
            foreach ($request->Thursday as $slot) {

                $timeBlocks = new TutorScheduleTimeBlocks();
                $timeBlocks->create([
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
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
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
                    'start_time' => $slot,
                    'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                    'day' => 'Friday',
                ]);}
        }
        if ($request->Saturday!= null){
            foreach ($request->Saturday as $slot) {

                $timeBlocks = new TutorScheduleTimeBlocks();
                $timeBlocks->create([
                    'user_id' => auth()->id(),
                    'zone' => auth()->user()->time_zone_id,
                    'start_time' => $slot,
                    'end_time' => date("H:i:s", strtotime("$slot +1 hour")),
                    'day' => 'Saturday',
                ]);}
        }

        return \redirect()->back();
    }

    public function myStatistics($id){

        $tutor = Instructor::where('user_id', $id)->first();
        $reviewsCounter = ReviewRating::where('tutor_id',$tutor->id)->count();
        $reviews = ReviewRating::where('tutor_id',$tutor->id)->get();

        $rating = 0;
        foreach ($reviews as $review){
            $rating += $review->value;
        }

        if ($reviewsCounter == 0){
            $averageRating = 0;
        }else {
            $averageRating = $rating / $reviewsCounter / 5;
        }
        $hours = Appointment::where('instructor_id', $tutor->id)->where('status_id', 3)->count();

        $earned = $hours * $tutor->PricePerHour;

        $currentWeekHours = Appointment::where('instructor_id', $tutor->id)->where('status_id', 3)
            ->where('appointments.date', '>=', Carbon::now()->startOfWeek()->format('yy-m-d'))
            ->count();

        $earnedThisWeek = $currentWeekHours * $tutor->PricePerHour;

        $currentMonthHours = Appointment::where('instructor_id', $tutor->id)->where('status_id', 3)
            ->where('appointments.date', '>=', Carbon::now()->startOfMonth()->format('yy-m-d'))
            ->count();

        $earnedThisMonth = $currentMonthHours * $tutor->PricePerHour;




        return view('frontend.user_profile.statistics', compact('tutor', 'reviewsCounter', 'averageRating', 'hours', 'earned', 'currentWeekHours', 'currentMonthHours', 'earnedThisWeek', 'earnedThisMonth'));
    }



}
