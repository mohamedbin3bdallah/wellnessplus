<?php

namespace App\Http\Controllers;

use App\User;
use App\Instructor;
use App\PartnerTutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
    }
	
	/**
     * Assign tutor to partner page.
     *
     */
    public function assignpage()
    {
		$partners = User::select('id','fname','lname')->where('role','partner')->get();
		$tutors = Instructor::join('users', 'users.id', 'instructors.user_id')
            ->select('users.id','users.fname', 'users.lname', 'users.email')
			->where(['users.role'=>'instructor','instructors.status'=>1])
            ->get();
		return view('admin.assign.add', compact('partners', 'tutors'));
    }
	
	/**
     * Assign tutor to partner action.
     *
     */
    public function assignstore(Request $request)
    {

        if(Auth::User()->role == "admin")
        {
            $validData = $request->validate([]);
			$validData = [
				'partner_id' => 'required|integer',
				'tutor_id' => 'required|integer',
			];
			$validator = Validator::make($request->all(), $validData);
			if ($validator->fails()) {
				Session::flash('message', __('backend.error'));
				Session::flash('message-type', "danger");
				return redirect()->back()->withInput()->withErrors($validator);
			}

			$partner = User::where(['role'=>'partner', 'id'=>$request->partner_id])->first();
			$tutor = User::where(['role'=>'instructor', 'id'=>$request->tutor_id])->first();
			
			if($partner && $tutor)
			{
				$partnertutorexist = PartnerTutor::where(['partner_id'=>$request->partner_id, 'tutor_id'=>$tutor->instructor->id])->first();
				if($partnertutorexist)
				{
					Session::flash('error',__('adminstaticword.turoralreadyaddedtopartner'));
					return redirect()->route('assign.page');
				}
				else
				{
					$partnertutor = new PartnerTutor();
					$partnertutor->create([
						'partner_id' => $request->partner_id,
						'tutor_id' => $tutor->instructor->id,
						'created_by' => Auth::User()->id,
					]);

					Session::flash('success',__('adminstaticword.turoraddedtopartnersuccessfully'));
					return redirect()->route('assign.page');
				}
			}
			else
			{
				Session::flash('error',__('adminstaticword.wrongdata'));
				return redirect()->route('assign.page');
			}
        }
        else
        {
            Session::flash('error',__('adminstaticword.youarenotadmin'));
			return redirect()->route('assign.page');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
    }
}
