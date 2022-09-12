<?php

namespace App\Http\Controllers;

use App\TutorPackage;
use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TutorPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TutorPackage::with('tutor')->orderBy('id','DESC')->get();
        return view('admin.tutorPackage.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$tutors = Instructor::where(['status'=>1])->with('user')->get()->sortBy('user.fname');
        return view('admin.tutorPackage.add',compact('tutors'));
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
            'tutor_id' => 'required|integer',
			'name' => 'required|max:255',
			'title' => 'required|max:255',
			'about' => 'required|max:255',
            'description' => 'required',
            'numOfHours' => 'required|integer',
            'origenalPrice' => 'required|numeric',
			'discountPrice' => 'required|numeric',
			'pricePerHour' => 'required|numeric',
			'totalPrice' => 'required|numeric',
            'status' => 'required|integer',
			'featured' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
        $input = $request->all();
        $input['created_by'] = auth()->id();

        $new = new TutorPackage;
        $new->create($input);

        return redirect('admins/tutor-packages')->with('success',__('adminstaticword.recordHasBeenCreated'));
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = TutorPackage::find($id);
		if(!$package) return redirect('admins/tutor-packages')->with('error',__('adminstaticword.recordIsNotFound'));
		$tutors = Instructor::where(['status'=>1])->with('user')->get()->sortBy('user.fname');
        return view('admin.tutorPackage.edit',compact('tutors','package'));
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
            'tutor_id' => 'required|integer',
			'name' => 'required|max:255',
			'title' => 'required|max:255',
			'about' => 'required|max:255',
            'description' => 'required',
            'numOfHours' => 'required|integer',
            'origenalPrice' => 'required|numeric',
			'discountPrice' => 'required|numeric',
			'pricePerHour' => 'required|numeric',
			'totalPrice' => 'required|numeric',
            'status' => 'required|integer',
			'featured' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		$input = $request->all();
        $input['updated_by'] = auth()->id();

        $old = TutorPackage::find($id);
		$old->update($input);

        return redirect('admins/tutor-packages')->with('success',__('adminstaticword.recordHasBeenUpdated'));
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = TutorPackage::find($id);
        if($package)
		{
            $package->delete();
            return back()->with('success',__('adminstaticword.recordHasBeenDeleted'));
        }
		else return back()->with('error',__('adminstaticword.recordIsNotFound'));
    }
	
	/**
     * Change Status or Featured
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
			'package' => 'required|integer',
			'value' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
        $package = TutorPackage::find($request->package);
		if($package)
		{
			$package->update([$request->type=>$request->value, 'updated_by'=>auth()->id()]);
			return redirect('admins/tutor-packages')->with('success',__('adminstaticword.recordChangedSuccessfully'));
		}
		else return redirect('admins/tutor-packages')->with('error',__('adminstaticword.recordIsNotFound'));
    }
}
