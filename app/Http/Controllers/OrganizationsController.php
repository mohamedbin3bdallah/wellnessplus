<?php

namespace App\Http\Controllers;

use App\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Image;
use Auth;
use DB;

class OrganizationsController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.organizations.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:organizations',
            'commission' => 'required|integer|min:1|max:100',
            'active' => 'required|integer|min:0|max:1'
        ]);
		
		if($validator->fails()) {
            return redirect('admins/organizations/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $organization = Organization::create([
			'name' => $request->name,
            'commission' => $request->commission,
            'active' => $request->active,
            'created_by' => Auth::user()->id,
		]);
		Session::flash('success', __('adminstaticword.organizationhasbeenadded'));
        return redirect('/admins/organizations');
    }


    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:organizations,name,'.$id,
            'commission' => 'required|integer|min:1|max:100',
            'active' => 'required|integer|min:0|max:1'
        ]);
		
		if($validator->fails()) {
            return redirect('admins/organization/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $organization = Organization::findOrFail($id);
        $organization->update([
            'name' => $request->name,
            'commission' => $request->commission,
            'active' => $request->active,
            'updated_by' => Auth::user()->id,
        ]);

        Session::flash('success', __('adminstaticword.organizationhasbeenupdated'));
        return redirect('/admins/organizations');
    }

    public function destroy($id)
    {

        $organization = Organization::findOrFail($id);
        $organization->delete();

        Session::flash('delete', __('adminstaticword.organizationhasbeendeleted'));
        return redirect('/admins/organizations');
    }
}
