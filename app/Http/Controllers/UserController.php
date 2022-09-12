<?php

namespace App\Http\Controllers;

//use App\Notifications;
use App\User;
use App\Allstate;
use App\Allcity;
use App\Allcountry;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Carbon\Language;
use Faker\Provider\zh_CN\DateTime;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;
use Image;
use Auth;
use App\Wishlist;
use App\Cart;
use App\Order;
use App\ReviewRating;
use App\Question;
use App\Answer;
use App\State;
use App\City;
use App\Country;
use App\Course;
use App\Meeting;
use App\BundleCourse;
use App\BBL;
use App\Instructor;
use App\CourseProgress;
use App\PartnerTutor;
use App\PartnerStudent;
use App\Packages;
use App\Organization;
use App\UserOrganization;
use App\Setting;
use App\TutorPackage;
use App\TutorCommission;
use App\TutorCommissionLog;
use App\Student_package;
use App\StudentCoupon;
use App\UserTutorBalance;
use App\UserTutorBalanceLog;
use App\TutorPreferedStudentAge;
use App\TutorPreferedStudentLevel;
use App\TutorCountryPricePerHour;
use App\UserCategory;
use App\UserDetails;
use App\tutorCertificate;
use App\tutorEducation;
use App\tutorWorkExperience;
use App\UserLanguages;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    
	/**
    * @return EmailVerify View
    */
	public function emailVerifyPage()
    {
		return view('admin.users.emailVerify');
	}
	
	/**
	* @param  Illuminate\Http\Request  $request
	* @get EmailVerify Users
	*/
	public function emailVerifyPageData(Request $request)
    {
        $columns = array(
            0 => 'users.id',
			1 => '',
            2 => 'users.fname',
            3 => 'users.email',
			4 => 'users.role',
            5 => 'users.created_at',
        );
		
		$query = User::notVerified()->whereIn('role', ['user','instructor']);

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
					$q->where('email', 'LIKE', "%{$search}%")
					  ->orWhereDate('created_at', 'LIKE', "%{$search}%")
					  ->orWhere('fname', 'LIKE', "%{$search}%")
					  ->orWhere('lname', 'LIKE',"%{$search}%");
			});
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
                $nestedData['id'] = ++$start;
				$nestedData['choose'] = '<input type="checkbox" name="email_verify_ids[]" value="'.$single->id.'" required>';
				$nestedData['name'] = $single->fname.' '.$single->lname;
				$nestedData['email'] = $single->email;
				$nestedData['role'] = __('backend.'.$single->role);
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				
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
	* @action Send Verification Email
	* @param  Illuminate\Http\Request  $request
    * @return redirect to emailVerifyPage
    */
	public function sendEmailVerify(Request $request)
    {
		if(isset($request->email_verify_ids) and !empty($request->email_verify_ids))
		{
			$users = User::notVerified()->whereIn('role', ['user','instructor'])->whereIn('id', $request->email_verify_ids)->get();
			if($users->count())
			{
				foreach($users as $user)
				{
					$user->sendEmailVerificationNotification();
				}
				Session::flash('success', __('backend.sent_successfully'));
			}
			else Session::flash('error', __('backend.record_not_found'));
		}
		else Session::flash('error', __('backend.wrong_request_data'));
		return redirect()->route('users.email.verify');
	}

    public function viewAllUser()
    {
        /*if((Auth::user()->role == 'partner'))
		{
			$users = User::with('country', 'instructor', 'student', 'studentpackage')->wherehas('student', function($query) { $query->where('partner_id', Auth::user()->id); })->get();
			$tutors = Instructor::with('user')->wherehas('tutor', function($query) { $query->where('partner_id', Auth::user()->id); })->get();
			$packages = Packages::where(['organization_flag'=>1])->get();
		}
		else
		{
			$users = User::with('country', 'instructor')->get();
			$tutors = '';
			$packages = '';
		}
		
        return view('admin.user.index', compact('users', 'tutors', 'packages'));*/
		
		$countries = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->select('users.country_id as id','allcountry.name as name')
					->distinct()
					->groupBy('users.country_id')
					->get();
		return view('admin.user.index' ,compact('countries'));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getusers(Request $request)
    {
		if(Auth::user()->role == 'partner')
		{
        $columns = array(
            0 =>'id', 
            //1 =>'image',
            2=> 'fname',
            3=> 'email',
			//4=> 'paid',
            5=> 'role',
			6=> 'mobile',
			//7=> 'country',
			//8=> 'CountryOfResidence',
			9=> 'created_at',
			//10=> 'status',
			//11=> 'edit',
			//12=> 'delete',
			//13=> 'actions',
        );
		}
		else
		{
		$columns = array(
            0 =>'id', 
            //1 =>'image',
            2=> 'fname',
            3=> 'email',
            4=> 'role',
			//5=> 'instructorstatus',
			6=> 'mobile',
			//7=> 'country',
			//8=> 'CountryOfResidence',
			9=> 'created_at',
			//10=> 'status',
			//11=> 'edit',
			//12=> 'delete',
        );
		}
		
		if(Auth::user()->role == 'partner') $totalData = User::wherehas('student', function($q) { $q->where('partner_id', Auth::user()->id); })->where('id', '!=', Auth::user()->id)->count();
		else $totalData = User::where('id', '!=', Auth::user()->id)->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		
		if(Auth::user()->role == 'partner') $query = User::with('country', 'instructor')->wherehas('student', function($q) { $q->where('partner_id', Auth::user()->id); })->where('id', '!=', Auth::user()->id);
		else $query = User::with('country', 'instructor')->where('id', '!=', Auth::user()->id);
		
		if(!empty($request->input('search.value')))
		{
			$search = $request->input('search.value'); 
			$query->where(function($q) use ($search) {
					$q->where('id', 'LIKE', "%{search}%")
					  ->orWhere('fname', 'LIKE',"%{$search}%")
					  ->orWhere('lname', 'LIKE',"%{$search}%")
					  ->orWhere('email', 'LIKE',"%{$search}%")
					  ->orWhere('role', 'LIKE',"%{$search}%")
					  ->orWhere('mobile', 'LIKE',"%{$search}%")
					  ->orWhere('created_at', 'LIKE',"%{$search}%")
					  ->orWhereHas('country', function($qq) use ($search) {
							$qq->where('nicename', 'LIKE',"%{$search}%");
						});
			});
			$totalFiltered = $query->count();
		}
		
		if(!empty($request->input('role')))
		{
			$role = $request->input('role'); 
			$query->where(function($q) use ($role) {
					$q->where('role', 'LIKE',"%{$role}%");
			});
			$totalFiltered = $query->count();
		}
		
		if(!empty($request->input('tutorStatus')))
		{
			$tutorStatus = ($request->input('tutorStatus') == 1)? 1:0; 
			$query->where(function($q) use ($tutorStatus) {
					$q->whereHas('instructor', function($qq) use ($tutorStatus) {
							$qq->where('status', '=',$tutorStatus);
						});
			});
			$totalFiltered = $query->count();
		}
		
		if(!empty($request->input('country')))
		{
			$country = $request->input('country'); 
			$query->where(function($q) use ($country) {
					$q->where('country_id', '=',$country);
			});
			$totalFiltered = $query->count();
		}
		
		$users = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($users))
        {
			$setting = Setting::first();
			$tutors = Instructor::with('user')->wherehas('tutor', function($query) { $query->where('partner_id', Auth::user()->id); })->get();
			$packages = Packages::where(['organization_flag'=>1])->get();
            foreach ($users as $user)
            {
                $nestedData['id'] = ++$start;
				$nestedData['image'] = ($user->user_img != null || $user->user_img !='')? '<img src="'.url("/images/user_img/$user->user_img").'" class="img-responsive">':'<img src="'.asset("images/default/user.jpg").'" class="img-responsive" alt="User Image">';
                $nestedData['fname'] = $user->fname;
				$nestedData['email'] = $user->email;
				
				if(Auth::user()->role == 'partner')
				{
					$nestedData['paid'] = '';
					if($user->studentpackage->where('paid',1)->count())
					{
						foreach($user->studentpackage->where('paid',1) as $key => $studentpackage)
						{
							if($studentpackage->package->organization_flag == 1)
							{
								$nestedData['paid'] .=($key+1).'-'.$studentpackage->package->name.'<br>';
							}
						}
					}
				}
				
				$nestedData['role'] = __('backend.'.$user->role);
				
				if(Auth::user()->role == 'admin')
				{
					if(isset($user->instructor->status))
						if($user->instructor->status == 1)
							$nestedData['instructorstatus'] = __('backend.approved');
						else
							$nestedData['instructorstatus'] = __('backend.pending');
					else
						$nestedData['instructorstatus'] = '';
				}
				
				$nestedData['mobile'] = $user->mobile;
				$nestedData['country'] = ($user->country)? $user->country['name']:'';
				$nestedData['CountryOfResidence'] = ($user->country_residence)? $user->country_residence['name']:'';
                //$nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
                $nestedData['created_at'] = date('j M Y h:i a',strtotime($user->created_at));
				if($user->status != 1) $nestedData['status'] = '<form action="'.route('user.quick',$user->id).'" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'" /><button  type="Submit" class="btn btn-xs btn-danger">'.__('backend.deactive').'</button></form>';
				else $nestedData['status'] = '<form action="'.route('user.quick',$user->id).'" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'" /><button  type="Submit" class="btn btn-xs btn-success">'.__('backend.active').'</button></form>';
				$nestedData['edit'] = '<a class="btn btn-success btn-sm" href="'.route('user.update',$user->id).'"><i class="glyphicon glyphicon-pencil"></i></a>';
				$nestedData['delete'] = '<form  method="post" action="'.route('user.delete',$user->id).'" data-parsley-validate class="form-horizontal form-label-left"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" name="_method" value="DELETE"><button onclick="return confirm('."'".__('backend.are_you_sure_you_want_to_delete')."'".')"  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button></form>';
				
				if(Auth::user()->role == 'partner')
				{
					$count = 0;
					if($user->studentpackage->where('paid',0)->count())
					{
						$nestedData['actions'] = '';
						foreach($user->studentpackage->where('paid',0) as $studentpackage)
						{
							if($studentpackage->package->organization_flag == 1)
							{
								$count = $count + 1;
							
								$cartRecord = Cart::where(['student_package_id'=>$studentpackage->id])->first();
								if($cartRecord)
								{
								$transaction_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 3.8 ) / 100);
								$transaction_fees = number_format(($transaction_fees )  , 2, '.', '');
    
								$bank_fees = ((($cartRecord->offer_price - $cartRecord->disamount) * 1.4 ) / 100);
								$bank_fees = number_format(($bank_fees )  , 2, '.', '');
								
								if($setting->payment_getway == 2) 
								{	$act= '<form method="post" action="payment/makePayment">';
									$act.=csrf_field();
									$act.='<input type="hidden" name="type" value="dashboard"><input type="hidden" name="page" value="/user"><input type="hidden" name="email" value="'.$user->email.'">';
									$act.='<input type="hidden" name="mobile" value="'.$user->mobile.'"><input type="hidden" name="name" value="'.$user->fname.' '.$user->lname.'">';
									$act.='<input type="hidden" name="tx_ref" value="'.base64_encode($cartRecord->id.'-'.$cartRecord->appointment_id.'-'.$cartRecord->user_id.'-'.$studentpackage->tutor_id.'-'.$studentpackage->package_id.'-myfatoora').'">';
									$amountFees=$cartRecord->offer_price - $cartRecord->disamount + $transaction_fees - $bank_fees;
									$act.='<input type="hidden" name="amount" value="'.$amountFees.'">';
									$act.='<input type="submit" class="btn btn-xs btn-danger" style="margin:5px;" value="'.__('adminstaticword.buypackage').'"></form>';
									$nestedData['actions'].=$act;
								}
								elseif($setting->payment_getway == 1) {
									$nestedData['actions'] .= '<button type="button" class="btn btn-xs btn-danger" style="margin:5px;" id="buypackage'.$studentpackage->id.'">'.__('adminstaticword.buypackage').'</button>';
								/*	$nestedData['actions'] .= '<script type="text/javascript">$(document).ready(function () {	$("#buypackage'.$studentpackage->id.'").on("click", function(){	  makePayment();	}); function makePayment() {
					FlutterwaveCheckout({
						public_key: "'.env('RAVE_PUBLIC_KEY').'",
						tx_ref: "'.base64_encode($cartRecord->id.'-'.$cartRecord->appointment_id.'-'.$cartRecord->user_id.'-'.$studentpackage->tutor_id.'-'.$studentpackage->package_id.'-flutterwave').'",
						amount: "'.$cartRecord->offer_price - $cartRecord->disamount + $transaction_fees - $bank_fees.'",
						currency: "USD",
						country: "US",
						payment_options: " ",
						redirect_url:"https://www.arabie.live/payment/dashboard",
						meta: {
							consumer_id: "'.$user->id.'",
							consumer_mac: "92a3-912ba-1192a",
						},
						customer: {
							email: "'.$user->email.'",
							phone_number: "'.$user->mobile.'",
							name: "'.$user->fname.$user->lname.'",
						},
						callback: function (data) {
							console.log(data);
						},
						onclose: function() {
							// close modal
						},
						customizations: {
							title: "Arabie",
							description: "Payment for items in cart",
							logo: "https://arabie.live/images/logo/logo.png",
						},
					});
					} });</script>';*/
								}
								}
							}
						}
					}
					else $nestedData['actions'] = '';
					
					if(!$count)
					{
						$nestedData['actions'] .= '<button type="button" class="btn btn-xs btn-success" style="margin:5px;" data-toggle="modal" data-target="#addpackage'.$user->id.'">'.__('adminstaticword.addpackage').'</button>';
						$nestedData['actions'] .= '<div class="modal fade" id="addpackage'.$user->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="/partner/addpackage" method="post">
										'.csrf_field().'
										<input type="hidden" name="user_id" value="'.$user->id.'" />
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">'.__('adminstaticword.addpackage') .'</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-6">
													<label for="tutor">'. __('adminstaticword.Tutors') .': <sup class="redstar">*</sup></label>
													<br>
													<select class="form-control js-example-basic-single" name="tutor_id" required>
														<option value="none" selected disabled hidden>'. __('adminstaticword.SelectanOption') .'</option>';
						foreach ($tutors as $tutor)	{ $nestedData['actions'] .= '<option value="'. $tutor->id .'" >'. $tutor->user->fname.' '.$tutor->user->lname .'</option>'; }
						$nestedData['actions'] .= '</select>
												</div>
												<div class="col-md-6">
													<label for="package">'. __('adminstaticword.packages') .': <sup class="redstar">*</sup></label>
													<br>
													<select class="form-control js-example-basic-single" name="package_id" required>
														<option value="none" selected disabled hidden>'. __('adminstaticword.SelectanOption') .'</option>';
						foreach ($packages as $package)	{ $nestedData['actions'] .= '<option value="'. $package->id .'" >'. $package->name .'</option>'; }
						$nestedData['actions'] .= '</select>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-success">'. __('adminstaticword.addpackage') .'</button>
										</div>
										</form>
									</div>
								</div>
							</div>';
					}
				}
				//else $nestedData['actions'] = '';
				//$nestedData['delete'] = '<form  method="post" action="" data-parsley-validate class="form-horizontal form-label-left"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" name="_method" value="DELETE"><button onclick="return confirm('."'".'Are you sure you want to delete?'."'".')"  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button></form>';
                //$nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>&emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
                
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
		$organizations = Organization::where(['active'=>1])->get();
        return view('admin.user.adduser')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries, 'organizations' => $organizations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|digits_between:9,15',
            'address' => 'required|max:2000',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
			'detail' => 'required',
            'role' => 'required',
			'organization' => 'required_if:role,==,partner',
        ]);


        $input = $request->all();
        if ($request->hasFile('user_img'))
        {
			$file = $request->file('user_img');
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['user_img'] = $image;

        }

        $input['password'] = Hash::make($request->password);
        $input['detail'] = $request->detail;
        $input['email_verified_at'] = \Carbon\Carbon::now()->toDateTimeString();
		/**
		* logged in partner user can create student user only
		**/
		$input['role'] = (Auth::user()->role == 'partner')? 'user':$request->role;
        $data = User::create($input);
        $data->save();
        if ($request->role == "admin"){
        if(env('MAIL_USERNAME')!=null) {
            try{
                Mail::send([], [], function($message) use ($request) {
                    $message->to($request->email, $request->fname . " " . $request->lname)
                        ->subject(__('backend.arabie_role'))
                        ->setBody(__('backend.arabie_role_message', ['param'=>'an Admin']));
                    $message->from(env('MAIL_FROM_ADDRESS'), 'Arabie');
                });
            }catch (\Swift_TransportException $e){
		//                    return back()->with('success','Status Changed Successfully ! but Mail will not sent because of error in mail configuration !');
            }
        }
        }
		if(Auth::user()->role == 'partner' && $request->role == 'user')
		{
			$partnerstudent = new PartnerStudent;
			$partnerstudent->create([
				'partner_id' => Auth::user()->id,
				'student_id' => $data->id,
				'created_by' => Auth::user()->id,
			]);
		}
		if($request->role == 'partner')
		{
			$userorganization = new UserOrganization;
			$userorganization->create([
				'user_id' => $data->id,
				'organization_id' => $request->organization,
				'created_by' => Auth::user()->id,
			]);
		}
        Session::flash('success',__('backend.created_successfully'));
        return redirect('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $user = User::findorfail($id);
        return view('admin.user.edit',compact('cities','states','countries','user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
		//dd($request->all());
        $user = User::findorfail($id);
		//dd($user);

        $request->validate([
              'email' => 'required|email|unique:users,email,'.$user->id,
			  'mobile' => 'required|digits_between:9,15',
//              'uploadVideo' => 'max:20480', //20MB
        ]);

		if($user->role == 'instructor')
		{
			$tutor = Instructor::where('user_id', $id)->first();
			//dd($tutor);
			if($request->detail != NULL) $tutor->detail=$request->detail;
			
			if($request->hasFile('uploadVideo'))
			{
				$file = $request->file('uploadVideo');
				$input = $request->uploadVideo;
				$name = time().$file->getClientOriginalName();
				$file->move('files/instructor/',$name);
				$tutor->video = $name;
				$user = User::findorfail($id);

				$user->update(['youtube_url' => null]);
			}
			$tutor->update();
		}

		$user = User::findorfail($id);

	
        $input = $request->all();


        if ($request->hasFile('user_img')) {
			$file = $request->file('user_img');
			
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
		
		if ($request->hasFile('national_id_img')) {
			$file = $request->file('national_id_img');
			
            if($user->user_details != null)
			{
				if($user->user_details->national_id_image != null) {
					$content = @file_get_contents(public_path().'/images/national_id/'.$user->user_details->national_id_image);
					if ($content) {
					unlink(public_path().'/images/national_id/'.$user->user_details->national_id_image);
					}
				}
            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/national_id/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            UserDetails::where('user_id', $id)->update(['national_id_image'=>$image]);
        }


        if(isset($request->update_pass)){

            $input['password'] = Hash::make($request->password);
        }
        else{
            $input['password'] = $user->password;
        }

        if(Auth::user()->role == 'admin')
		{
		if(isset($request->status))
        {
            $input['status'] = '1';
			//            $notification = new Notifications();
			//            $notification->create([
			//                'type' => 'status',
			//                'notifiable_type' => 'tutor',
			//                'notifiable_id' => $id,
			//                'data' => 'Your profile status has been changed to Active'
			//            ]);
            if(env('MAIL_USERNAME')!=null) {
                try{
            Mail::send([], [], function($message) use ($request) {
                $message->to($request->email, $request->fname . " " . $request->lname)
                    ->subject(__('backend.status_set_to', ['param'=>__('backend.active')]))
                    ->setBody(__('backend.status_set_to_message', ['param'=>__('backend.active')]));
                $message->from(env('MAIL_FROM_ADDRESS'), __('backend.arabie'));
            });
        }catch (\Swift_TransportException $e){
				//                    return back()->with('success','Status Changed Successfully ! but Mail will not sent because of error in mail configuration !');
                }catch(\Swift_RfcComplianceException $e){
                // Assume $_POST['email'] is invalid, abort processing, notify the user
                }
            }
            }
        else
        {
            $input['status'] = '0';
				//            $notification = new Notifications();
				//            $notification->create([
				//                'type' => 'status',
				//                'notifiable_type' => 'tutor',
				//                'notifiable_id' => $id,
				//                'data' => 'Your profile status has been changed to Blocked'
				//            ]);
            try {


                Mail::send([], [], function ($message) use ($request) {
                    $message->to($request->email, $request->fname . " " . $request->lname)
                        ->subject(__('backend.status_set_to', ['param'=>__('backend.deactive')]))
                        ->setBody(__('backend.status_set_to_message', ['param'=>__('backend.deactive')]));
                    $message->from(env('MAIL_FROM_ADDRESS'), __('backend.arabie'));
                });
            }catch (\Swift_TransportException $e){
//                return back()->with('success','Status Changed Successfully ! but Mail will not sent because of error in mail configuration !');
            }catch(\Swift_RfcComplianceException $e){
                // Assume $_POST['email'] is invalid, abort processing, notify the user
                }
        }

        if(isset($request->visibility)) {

            $input['visibility'] = '1';

        }else{

            $input['visibility'] = '0';

        }

        if(isset($request->verified)) {

            $input['verified'] = '1';

        }else{

            $input['verified'] = '0';

        }


        if(isset($request->archive)) {

            $input['archive'] = '0';

            try {

                Mail::send([], [], function ($message) use ($request) {
                    $message->to($request->email, $request->fname . " " . $request->lname)
                        ->subject(__('backend.status_set_to', ['param'=>__('backend.unarchived')]))
                        ->setBody(__('backend.status_set_to_message', ['param'=>__('backend.unarchived')]));
                    $message->from(env('MAIL_FROM_ADDRESS'), __('backend.arabie'));
                });
            }catch (\Swift_TransportException $e){
//                return back()->with('success','Status Changed Successfully ! but Mail will not sent because of error in mail configuration !');
            }catch(\Swift_RfcComplianceException $e){
                // Assume $_POST['email'] is invalid, abort processing, notify the user
                }

        }else{

            $input['archive'] = '1';
            try {

                Mail::send([], [], function ($message) use ($request) {
                    $message->to($request->email, $request->fname . " " . $request->lname)
                        ->subject(__('backend.status_set_to', ['param'=>__('backend.archived')]))
                        ->setBody(__('backend.status_set_to_message', ['param'=>__('backend.archived')]));
                    $message->from(env('MAIL_FROM_ADDRESS'), __('backend.arabie'));
                });
            }catch (\Swift_TransportException $e){
//                return back()->with('success','Status Changed Successfully ! but Mail will not sent because of error in mail configuration !');
            }
        }
		}
        $input['turor_order'] = $request->turor_order ? $request->turor_order : 100000;
        $user->update($input);

        Session::flash('success',__('backend.updated_successfully'));
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if(config('app.demolock') == 0){

            if ($user->user_img != null && $user->user_img != 'general.png')
            {

                $image_file = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);

                if($image_file)
                {
                    unlink(public_path().'/images/user_img/'.$user->user_img);
                }
            }

            Course::where('user_id', $id)->delete();
            Wishlist::where('user_id', $id)->delete();
            Cart::where('user_id', $id)->delete();
            Order::where('user_id', $id)->delete();
            ReviewRating::where('user_id', $id)->delete();
            Question::where('user_id', $id)->delete();
            Answer::where('ans_user_id', $id)->delete();
            Meeting::where('user_id', $id)->delete();
            BundleCourse::where('user_id', $id)->delete();
            BBL::where('instructor_id', $id)->delete();            
            CourseProgress::where('user_id', $id)->delete();
			/**
			** Delete all tutor records from relationship with partners
			**/
			if($user->role == 'instructor')
			{
				$tutor = Instructor::where('user_id', $id)->first();
				if(isset($tutor->id))
				{
					PartnerTutor::where('tutor_id', $tutor->id)->delete();
					Student_package::where('tutor_id', $tutor->id)->delete();
					TutorPackage::where('tutor_id', $tutor->id)->delete();
					UserTutorBalance::where('tutor_id', $tutor->id)->delete();
					UserTutorBalanceLog::where('tutor_id', $tutor->id)->delete();
					TutorCommission::where('tutor_id', $tutor->id)->delete();
					TutorCommissionLog::where('tutor_id', $tutor->id)->delete();
					TutorPreferedStudentAge::where('tutor_id', $tutor->id)->delete();
					TutorPreferedStudentLevel::where('tutor_id', $tutor->id)->delete();
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
				}
			}
			
			if($user->role == 'user')
			{
				PartnerStudent::where('student_id', $user->id)->delete();
				Student_package::where('user_id', $user->id)->delete();
				StudentCoupon::where('user_id', $user->id)->delete();
				UserOrganization::where('user_id', $user->id)->delete();
				UserTutorBalance::where('user_id', $user->id)->delete();
				UserTutorBalanceLog::where('user_id', $user->id)->delete();
				TutorCommission::where('user_id', $user->id)->delete();
				TutorCommissionLog::where('user_id', $user->id)->delete();
			}
			/**
			** Delete all partner records from relationship with tutors
			**/
			if($user->role == 'partner') PartnerTutor::where('partner_id', $id)->delete();
			
			$value = $user->delete();
			Instructor::where('user_id', $id)->delete();

            if($value)
            {
                session()->flash("delete",__('backend.deleted_successfully'));
                return redirect("user");
            }
        }
        else
        {
            return back()->with('delete',__('backend.cant_delete_record'));
        }
    }
	
	public function delete_file($path, $file)
	{
		if($file and file_exists($path.$file)) unlink($path.$file);
	}

    public function step1(){
		//dd('hiiiiiii');
         $countries = Allcountry::all();
		//dd($countries);

        $timeZones = DB::table('time_zones')->get();
        $allLanguages = DB::table('all_languages')->get();
        $days = Carbon::getDays();
        $user = \Illuminate\Support\Facades\Auth::user();
        $tutor = Instructor::where('user_id', $user->id)->first();
        $languagesSpoken = DB::table('user_language')
            ->where('user_language.user_id', $user->id)
            ->join('all_languages', 'all_languages.id', '=','user_language.language_id')
            ->select('user_language.language_id', 'user_language.level_id', 'all_languages.isoName As language')->get();
	//dd($languagesSpoken);
        return view('frontend.steps', compact('countries', 'allLanguages', 'timeZones','days', 'user', 'tutor', 'languagesSpoken')); 
    }

}
