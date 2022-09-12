<?php

namespace App\Http\Controllers;

use App\TutorCountryPricePerHour;
use App\Instructor;
use App\Allcountry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use DB;

class TutorCountryPricePerHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tutorCountryPricePerHour.index');
    }
	
	/**
	* Get All Data
	*/
	public function get(Request $request)
    {
        $columns = array(
            0 => 'tutor_country_prices_per_hour.id', 
            1 => 'users.fname',
			2 => 'users.mobile',
			3 => 'users.email',
            4 => 'allcountry.nicename',
            5 => 'tutor_country_prices_per_hour.pricePerHour',
			6 => 'tutor_country_prices_per_hour.status',
			7 => 'tutor_country_prices_per_hour.created_at',
			8 => '',
			9 => '',
        );
		
		$query = DB::table('tutor_country_prices_per_hour')
				->leftJoin('allcountry', 'tutor_country_prices_per_hour.country_id', '=', 'allcountry.id')
				->leftJoin('instructors', 'tutor_country_prices_per_hour.tutor_id', '=', 'instructors.id')
				->leftJoin('users', 'instructors.user_id', '=', 'users.id')
				->select('tutor_country_prices_per_hour.id as id','users.fname as fname','users.lname as lname','users.mobile as mobile','users.email as email','allcountry.nicename as country','tutor_country_prices_per_hour.pricePerHour as price','tutor_country_prices_per_hour.currency as currency','tutor_country_prices_per_hour.status as status','tutor_country_prices_per_hour.created_at as created_at');

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
					  ->orWhere('users.lname', 'LIKE', "%{$search}%")
					  ->orWhere('users.mobile', 'LIKE', "%{$search}%")
					  ->orWhere('users.email', 'LIKE',"%{$search}%")
					  ->orWhere('allcountry.nicename', 'LIKE',"%{$search}%")
					  ->orWhere('tutor_country_prices_per_hour.pricePerHour', 'LIKE',"%{$search}%")
					  ->orWhereDate('tutor_country_prices_per_hour.created_at', 'LIKE', "%{$search}%");
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
				$nestedData['tutor'] = $single->fname.' '.$single->lname;
				$nestedData['mobile'] = $single->mobile;
				$nestedData['email'] = $single->email;
				$nestedData['country'] = $single->country;
				$nestedData['price'] = $single->price.' '.$single->currency;
				if($single->status) $nestedData['status'] = '<span class="label label-success">'.__('adminstaticword.Active').'</span>';
				else $nestedData['status'] = '<span class="label label-danger">'.__('adminstaticword.Deactive').'</span>';
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($single->created_at));
				$nestedData['edit'] = '<a class="btn btn-success btn-sm" href="'.route('edit.tutor.country.pricePerHour', ['id'=>$single->id]).'"><i class="glyphicon glyphicon-pencil"></i></a>';
				$nestedData['delete'] = '<form method="post" action="'.route('delete.tutor.country.pricePerHour', ['id'=>$single->id]).'" data-parsley-validate class="form-horizontal form-label-left">'.csrf_field().method_field('DELETE').'<button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button></form>';
				
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
		$tutors = Instructor::where(['status'=>1])->with('user')->get()->sortBy('user.fname');
		$countries = Allcountry::all();
        return view('admin.tutorCountryPricePerHour.add',compact('tutors','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tutor_id' => [
				'required',
				'integer',
				Rule::unique('tutor_country_prices_per_hour')->where(function ($query) use($request) {
					return $query->where('tutor_id', $request->tutor_id)->where('country_id', $request->country_id);
				}),
			],
			'country_id' => [
				'required',
				'integer',
				Rule::unique('tutor_country_prices_per_hour')->where(function ($query) use($request) {
					return $query->where('tutor_id', $request->tutor_id)->where('country_id', $request->country_id);
				}),
			],
			'pricePerHour' => 'required|numeric|max:99999999',
            'status' => 'required|integer|max:1',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
        $input = $request->all();
        $input['created_by'] = auth()->id();

        $new = new TutorCountryPricePerHour;
        $new->create($input);

        return redirect('admins/tutor-country-pricePerHour')->with('success',__('adminstaticword.recordHasBeenCreated'));
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TutorCountryPricePerHour::find($id);
		if(!$data) return redirect('admins/tutor-country-pricePerHour')->with('error',__('adminstaticword.recordIsNotFound'));
		$tutors = Instructor::where(['status'=>1])->with('user')->get()->sortBy('user.fname');
		$countries = Allcountry::all();
        return view('admin.tutorCountryPricePerHour.edit',compact('tutors','countries','data'));
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tutor_id' => [
				'required',
				'integer',
				Rule::unique('tutor_country_prices_per_hour')->where(function ($query) use($request, $id) {
					return $query->where('tutor_id', $request->tutor_id)->where('country_id', $request->country_id)->where('id', '!=', $id);
				}),
			],
			'country_id' => [
				'required',
				'integer',
				Rule::unique('tutor_country_prices_per_hour')->where(function ($query) use($request, $id) {
					return $query->where('tutor_id', $request->tutor_id)->where('country_id', $request->country_id)->where('id', '!=', $id);
				}),
			],
			'pricePerHour' => 'required|numeric|max:99999999',
            'status' => 'required|integer|max:1',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		$input = $request->all();
        $input['updated_by'] = auth()->id();

        $old = TutorCountryPricePerHour::find($id);
		if(!$old) return redirect('admins/tutor-country-pricePerHour')->with('error',__('adminstaticword.recordIsNotFound'));
		$old->update($input);

        return redirect('admins/tutor-country-pricePerHour')->with('success',__('adminstaticword.recordHasBeenUpdated'));
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TutorCountryPricePerHour::find($id);
        if($data)
		{
            $data->delete();
            return back()->with('success',__('adminstaticword.recordHasBeenDeleted'));
        }
		else return back()->with('error',__('adminstaticword.recordIsNotFound'));
    }
}
