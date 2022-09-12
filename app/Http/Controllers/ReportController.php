<?php

namespace App\Http\Controllers;

use App\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
	
    /**
	* Report Users Country
    */
    public function users_country(Request $request)
    {
        $countries = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->select('users.country_id as id','allcountry.name as name')
					->distinct()
					->groupBy('users.country_id')
					->get();
		$query = DB::table('users')
				->join('allcountry', 'allcountry.id', '=','users.country_id')
				->select(DB::raw('COUNT(users.country_id) AS count'), 'allcountry.name AS name');
		if($request->role) $query->where(['users.role'=>$request->role]);
		if($request->country) $query->where(['users.country_id'=>$request->country]);
		if($request->date) $query->whereDate('users.created_at','=',$request->date);
		$result = $query->groupBy('users.country_id')->get();
		return view('admin.reports.users_country', compact('countries', 'result'));
    }
	
	/**
	* Report Tutors Organization
    */
    public function tutors_organization()
    {
        $countries = DB::table('users')
					->join('allcountry', 'users.country_id', '=', 'allcountry.id')
					->join('instructors', 'users.id', '=', 'instructors.user_id')
					->join('partner_tutors', 'instructors.id', '=', 'partner_tutors.tutor_id')
					->select('users.country_id as id','allcountry.name as name')
					->where(['users.role'=>'instructor', 'instructors.status'=>1])
					->distinct()
					->groupBy('users.country_id')
					->get();
		$organizations = DB::table('organizations')
				->join('user_organization', 'organizations.id', '=', 'user_organization.organization_id')
				->join('partner_tutors', 'user_organization.user_id', '=', 'partner_tutors.partner_id')
				->join('instructors', 'partner_tutors.tutor_id', '=', 'instructors.id')
				->select('organizations.id as id','organizations.name as name')
				->where(['instructors.status'=>1])
				->distinct()
				->groupBy('organizations.id')
				->get();
		$packages = Packages::where(['organization_flag'=>1])->get();
		return view('admin.reports.tutors_organization', compact('countries', 'organizations', 'packages'));
    }
	
	/**
	* Report GET Tutors Organization
	*/
	public function get_tutors_organization(Request $request)
    {
		$packages = Packages::where(['organization_flag'=>1])->get();
        $columns = array(
            0 =>'id', 
            1 =>'tutor',
            2=> 'organization',
            3=> 'country',
			4 => 'pricePerHour',
        );
		foreach($packages as $package) { $columns[] = $package->id; }
		$columns[] = 'created_at';
		
		$query = DB::table('organizations')
				->join('user_organization', 'organizations.id', '=', 'user_organization.organization_id')
				->join('partner_tutors', 'user_organization.user_id', '=', 'partner_tutors.partner_id')
				->join('instructors', 'partner_tutors.tutor_id', '=', 'instructors.id')
				->join('users', 'instructors.user_id', '=', 'users.id')
				->join('allcountry', 'users.country_id', '=', 'allcountry.id')
				->select('users.fname as fname','users.lname as lname','organizations.name as organization','instructors.PricePerHour as pricePerHour','allcountry.name as country','users.created_at as created_at');
		
		$totalData = $query->count();
		$totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
				
		if(!empty($request->input('search')))
		{
			$search = $request->input('search');
			$query->where(function($q) use ($search) {
					$q->where('users.fname', 'LIKE', "%{$search}%")
					  ->orWhere('users.lname', 'LIKE',"%{$search}%")
					  ->orWhere('instructors.PricePerHour', 'LIKE',"%{$search}%");
			});
		}
		
		if(!empty($request->input('organization')))
		{
			$organization = $request->input('organization'); 
			$query->where('organizations.id', '=',$organization);
		}
		
		if(!empty($request->input('country')))
		{
			$country = $request->input('country'); 
			$query->where('allcountry.id', '=',$country);
		}
		
		if(!empty($request->input('date')))
		{
			$date = $request->input('date'); 
			$query->whereDate('users.created_at', '=',$date);
		}
		
		$totalFiltered = $query->count();
		$query_data = $query->orderBy($order, $dir)->limit($limit)->offset($start)->get();
		
		$data = array();
        if(!empty($query_data))
        {
            foreach ($query_data as $single)
            {
                $nestedData['id'] = ++$start;
				$nestedData['tutor'] = $single->fname.' '.$single->lname;
                $nestedData['organization'] = $single->organization;
				$nestedData['country'] = $single->country;
				$nestedData['pricePerHour'] = $single->pricePerHour;
				
				foreach($packages as $package)
				{
					$nestedData[$package->id] = number_format($single->pricePerHour - number_format(($package->discountPercentage)*($single->pricePerHour)/(100), 2), 2).'<br>';
				}
				
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
}
