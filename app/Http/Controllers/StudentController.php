<?php

namespace App\Http\Controllers;

use App\User;
use App\Allcountry;
use App\Organization;
use App\Packages;
use App\PartnerStudent;
use App\Student_package;
use App\StudentCoupon;
use App\UserOrganization;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\TutorCommission;
use App\TutorCommissionLog;
use App\Appointment;
use App\BBL;
use App\Cart;
use App\Payment_transaction;
use Carbon\Carbon;
use Carbon\Language;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    /*
	** View all students
	** Return view
	*/
	public function students()
    {
		$countries = Allcountry::all();
		$organizations = Organization::all();
		$packages = Packages::all();
		
		return view('admin.users.students.index')->with(['countries'=>$countries, 'organizations'=>$organizations, 'packages'=>$packages]);
    }
	
	/**
	** Get all tutors with details
	** Return json data
	*/
	public function getStudents(Request $request)
    {
        $columns = array(
            0 => 'users.id',
			//1 => 'image',
            2 => 'users.fname',
			3 => 'users.gender',
            4 => 'users.email',
            5 => 'users.mobile',
			6 => 'users.country_id',
			//7 => 'organization',
			//8 => 'package',
			9 => 'users.email_verified_at',
			10 => 'users.status',
			11 => 'users.created_at',
			//12 => 'edit',
			//13 => 'delete',
        );
		
		$genders = ['m'=>__('adminstaticword.Male'), 'f'=>__('adminstaticword.Female'), 'o'=>__('adminstaticword.Other')];
		
		$query = User::where(['role'=>'user']);

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
				$q->where('fname', 'LIKE', "%{$search}%")
				  ->orWhere('lname', 'LIKE',"%{$search}%")
				  ->orWhere('email', 'LIKE',"%{$search}%")
				  ->orWhere('mobile', 'LIKE',"%{$search}%");
			});
		}
		
		if(!empty($request->input('country')))
		{
			$query->whereIn('country_id', $request->input('country'));
		}
		
		if(!empty($request->input('organization')))
		{
			$organizations = $request->input('organization'); 
			$query->whereHas('student', function($q) use ($organizations) {
				$q->whereHas('partner', function($qq) use ($organizations) {
					$qq->whereHas('userorganization', function($qqq) use ($organizations) {
						$qqq->whereIn('organization_id', $organizations);
					});
				});
			});
		}
		
		if(!empty($request->input('package')))
		{
			$packages = $request->input('package'); 
			$query->whereHas('studentpackage', function($q) use ($packages) {
				$q->where('paid', 1)->whereIn('package_id', $packages);
			});
		}
		
		if(in_array($request->input('status'), [0,1]))
		{
			$query->where('status', $request->input('status'));
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
						$q->whereIn('gender',$gender)->orWhereNull('gender');                  
					});
				}
				else $query->whereNull('gender');
			}
			else $query->whereIn('gender', $gender);
		}
		
		if(in_array($request->input('verification'), [0,1]))
		{
			if($request->input('verification') == 1) $query->where('email_verified_at', '!=', NULL);
			else $query->where('email_verified_at', NULL);
		}
		
		if(!empty($request->input('date')))
		{
			$query->whereDate('created_at', $request->input('date'));
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {				
                $nestedData['id'] = ++$start;
				$nestedData['image'] = ($single->user_img and file_exists(public_path().'/images/user_img/'.$single->user_img))? '<img src="'.asset('images/user_img/'.$single->user_img).'" class="img-responsive">':'<img src="'.asset('images/user_img/general.png').'" class="img-responsive">';
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['gender'] = (array_key_exists($single->gender, $genders))? $genders[$single->gender]:__('adminstaticword.not_specified');
				$nestedData['email'] = $single->email;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['country'] = ($single->country)? $single->country->nicename:'';
				
				$nestedData['organization'] = '';
				if($single->student->count())
				{
					$organizations = [];
					foreach($single->student as $organization)
					{
						$organizations[] = $organization->partner->userorganization->organization->name;
					}
					$nestedData['organization'] .= implode(', ', $organizations);
				}
				
				$nestedData['package'] = '';
				if($single->studentpackage->where('paid', 1)->count())
				{
					$packages = [];
					foreach($single->studentpackage->where('paid', 1) as $package)
					{
						$packages[] = $package->package->name;
					}
					$nestedData['package'] .= implode(', ', $packages);
				}
				
				$nestedData['verification'] = ($single->email_verified_at)? date('j M Y h:i a',strtotime($single->email_verified_at)):'';
				$nestedData['status'] = ($single->status)? '<span class="label label-success changData" id="'.$single->id.'" type="status" to="0">'.__('adminstaticword.Active').'</span>':'<span class="label label-danger changData" id="'.$single->id.'" type="status" to="1">'.__('adminstaticword.notActive').'</span>';
				$nestedData['created_at'] = ($single->created_at)? date('j M Y h:i a',strtotime($single->created_at)):'';
				$nestedData['edit'] = '<a href="'.route('user.edit', $single->id).'" target="_blank"><span class="btn btn-success spanBtn"><i class="glyphicon glyphicon-edit"></i></span></a>';
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
	** Change student data
	** Return json status and message
	*/
	public function changeStudentData(Request $request)
	{
		$json_data = [];
		$error = 0;
		if(!empty($request->input('id')) && !empty($request->input('type')) && $request->input('id') > 0 && in_array($request->input('to'), [0,1]))
		{
			$type = $request->input('type');
			switch($type)
			{
				case "status":
					$student = User::find($request->input('id'));
					if($student) $update = $student->update(['status'=>$request->input('to')]);
					else $error = 1;
					break;
				case "delete":
					$student = User::find($request->input('id'));
					if($student)
					{
						PartnerStudent::where('student_id', $student->id)->delete();
						Student_package::where('user_id', $student->id)->delete();
						StudentCoupon::where('user_id', $student->id)->delete();
						UserOrganization::where('user_id', $student->id)->delete();
						UserTutorBalance::where('user_id', $student->id)->delete();
						UserTutorBalanceLog::where('user_id', $student->id)->delete();
						TutorCommission::where('user_id', $student->id)->delete();
						TutorCommissionLog::where('user_id', $student->id)->delete();
						BBL::whereHas('appointment', function ($q) use ($student){
							$q->where('user_id', $student->id);                  
						})->delete();
						Appointment::where('user_id', $student->id)->delete();
						Cart::where('user_id', $student->id)->delete();
						Payment_transaction::where('user_id', $student->id)->delete();
						
						if ($student->user_img != null && $student->user_img != 'general.png')
						{
							$image_file = @file_get_contents(public_path().'/images/user_img/'.$student->user_img);
							if($image_file)
							{
								unlink(public_path().'/images/user_img/'.$student->user_img);
							}
						}
						
						$update = $student->delete();
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
}
