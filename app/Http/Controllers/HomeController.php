<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use App\Categories;
use App\Slider;
use App\SliderFacts;
use App\CategorySlider;
use App\Course;
use App\Meeting;
use App\BBL;
use App\BundleCourse;
use App\Testimonial;
use App\Trusted;
use App\PartnerStudent;
use App\TutorPackage;
use App\Instructor;
use App\SubCategory;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $category = Categories::orderBy('position','ASC')->get();
//        $sliders = Slider::orderBy('position', 'ASC')->get();
//        $facts = SliderFacts::limit(3)->get();
//        $categories = CategorySlider::first();
//        $cor = Course::all();
//        $bundles = BundleCourse::get();
//        $meetings = Meeting::where('link_by', NULL)->get();
//        $bigblue = BBL::where('is_ended','!=',1)->where('link_by', NULL)->get();
//        $testi = Testimonial::all();
//        $trusted = Trusted::all();
//
//

//        return view('home', compact('category', 'sliders', 'facts', 'categories', 'cor', 'bundles', 'meetings', 'bigblue', 'testi', 'trusted'));
//
        // check if its a tutor and filled registeration steps
        if($user = Auth::user()){
            if($user->role == "instructor"){
                if($user->fname == ""){
                    return redirect()->route('registration.steps');
                }
            }
        }
		
		
		$tutorPackages_query = TutorPackage::where(['status'=>1]);
		if(Auth::check() && Auth::user()->role == 'user')
		{
			$partnerstudent = PartnerStudent::select('partner_id')->where(['student_id'=>Auth::user()->id])->pluck('partner_id')->toArray();
			if(!empty($partnerstudent))
			{
				$tutorPackages_query = $tutorPackages_query->wherehas('tutor', function($q) use ($partnerstudent)
										{
											$q->wherehas('tutor', function($qq) use ($partnerstudent)
													{
														$qq->whereIn('partner_id', $partnerstudent);
													});
										});
			}
		}
		$tutorPackages = $tutorPackages_query->get();
		
		$categories = Categories::where(['status'=>1])->get();
		
		$countries = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->select('users.country_id as id','allcountry.name as name')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('users.country_id')
					->get();
					
		$allLanguages = DB::table('users')
					->join('user_language', 'users.id', '=', 'user_language.user_id')
					->join('all_languages', 'user_language.language_id', '=', 'all_languages.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->select('user_language.language_id as id','all_languages.isoName as isoName')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('user_language.language_id')
					->get();
		
		$tutors = Instructor::where(['status'=>1])
									->wherehas('user', function($q)
									{
										$q->where('status', 1);
									})->get();
		
        return view('frontend.homePage', ['tutorPackages'=>$tutorPackages, 'categories'=>$categories, 'countries'=>$countries, 'allLanguages'=>$allLanguages, 'tutors'=>$tutors]);
    }
	
	/**
     * Handle Specialty Tags
     *
     * @redirect to find tutor page
    */
	public function handleSpecialtyTags($tag)
	{
		$sub_categories = SubCategory::where('tags', 'LIKE', "%{$tag}%")->get()->pluck('id');
		if($sub_categories->count())
		{
			$sub_categories_array = $sub_categories->toArray();
			array_walk($sub_categories_array, function (&$value, $key) {
				$value="specialties%5B%5D=$value";
			});
			return redirect('/find/tutor?'.implode('&',$sub_categories_array).'&from=0+USD&to=100+USD&searchWord=&sort=');
		}
		else return redirect('/find/tutor');
	}
	
	/**
     * Handle Redirection VerifiesEmail
     *
     * @redirect to many pages
    */
	public function handleRedirectionVerifiesEmail()
	{
		if(Auth::guest()) return redirect('/');
		else
		{
			switch(Auth::user()->role)
			{
				case 'admin':
					return redirect('/admins');
					break;
				case 'user':
					return redirect('/profile/show/'.Auth::user()->id);
					break;
				case 'instructor':
					return redirect('/tutor/profile');
					break;
				default:
					return redirect('/');
			}
		}
	}
}
