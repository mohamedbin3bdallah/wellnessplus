<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Cart;
use App\Packages;
use App\Student_package;
use App\UserTutorBalance;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use Auth;
use DB;

class PackagesController extends Controller
{
    public function index()
    {

        $packages = Packages::all();

        return view('admin.packages.index', compact('packages'));

    }

    public function create()
    {


        return view('admin.packages.create');

    }

    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'numOfHours' => 'required',
            'discountPercentage' => 'required|numeric',
            'icon' => 'required'
        ]);

        if ($file = $request->file('icon')) {
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/icons/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);
            $input['icon'] = $image;

        }
		$input['organization_flag'] = (isset($input['organization_flag']))? 1:0;
        $package = Packages::create($input);
		Session::flash('success', __('backend.created_successfully'));
        return redirect('/admins/packages');
    }


    public function edit($id)
    {
        $package = Packages::findOrFail($id);
        return view('admin.packages.edit', compact('package'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'numOfHours' => 'required',
            'discountPercentage' => 'required|numeric',
            'icon' => 'required',
            'active' => 'required'
        ]);

        if ($file = $request->file('icon')) {
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/icons/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);

        }
		$request->organization_flag = (isset($request->organization_flag))? 1:0;
        $package = Packages::findOrFail($id);

        $new_package = Packages::where('id', $id)->update([
            'name' => $request->name,
            'numOfHours' => $request->numOfHours,
            'discountPercentage' => $request->discountPercentage,
			'organization_flag' => $request->organization_flag,
            'active' => $request->active,
            'icon' => $image
        ]);

        Session::flash('success', __('backend.updated_successfully'));
        return redirect('/admins/packages');
    }

    public function destroy($id)
    {

        $package = Packages::findOrFail($id);

        $package->delete();

        Session::flash('delete', __('backend.deleted_successfully'));
        return redirect('/admins/packages');
    }

    public function purchasePackage(Request $request)
    {
		//dd($request);
        $request->validate([
            'tutor_id' => 'required|int',
            'package_id' => 'required|int',
        ]);

        $package = Packages::find($request->package_id);
        $studentPackage = Student_package::where('package_id', $request->package_id)
            ->where('paid', 0)
            ->where('tutor_id', $request->tutor_id)
            ->where('user_id', Auth::user()->id)
            ->first();


        $tutor = Instructor::find($request->tutor_id);

        DB::beginTransaction();

        try {


            if (!isset($studentPackage)) {
                $studentPackage = new Student_package();
                $studentPackage->package_id = $package->id;
                $studentPackage->user_id = Auth::user()->id;
                $studentPackage->tutor_id = $request->tutor_id;
                $studentPackage->numOfHours = $package->numOfHours;
                $studentPackage->originalPricePerHour = $tutor->PricePerHour;
                $studentPackage->discountPercentage = $package->discountPercentage;
                $studentPackage->netPrice = $tutor->PricePerHour - (($tutor->PricePerHour * $package->discountPercentage) / 100);
                $studentPackage->paid = 0;
                $studentPackage->created_by = Auth::user()->id;
                $studentPackage->save();
            } else {
                $studentPackage->package_id = $package->id;
                $studentPackage->user_id = Auth::user()->id;
                $studentPackage->tutor_id = $request->tutor_id;
                $studentPackage->numOfHours = $package->numOfHours;
                $studentPackage->originalPricePerHour = $tutor->PricePerHour;
                $studentPackage->discountPercentage = $package->discountPercentage;
                $studentPackage->netPrice = $tutor->PricePerHour - (($tutor->PricePerHour * $package->discountPercentage) / 100);
                $studentPackage->paid = 0;
                $studentPackage->updated_by = Auth::user()->id;
                $studentPackage->save();
            }


            // delete old record from the cart if exists
            $cartRecord = Cart::where('user_id', Auth::User()->id)->where('student_package_id', $studentPackage->id)->first();

            if (!isset($cartRecord)) {


                $cartRecord = new Cart();
                $cartRecord->user_id = Auth::User()->id;
                $cartRecord->course_id = null;
                $cartRecord->student_package_id = $studentPackage->id;
                $cartRecord->category_id = null;
                $cartRecord->offer_price = $studentPackage->netPrice * $studentPackage->numOfHours;
                $cartRecord->save();
            }else{
                $cartRecord->user_id = Auth::User()->id;
                $cartRecord->course_id = null;
                $cartRecord->student_package_id = $studentPackage->id;
                $cartRecord->category_id = null;
                $cartRecord->offer_price = $studentPackage->netPrice * $studentPackage->numOfHours;
                $cartRecord->save();
            }

            $coupanapplieds = Session::get('coupanapplied');
            if (empty($coupanapplieds) == true) {

                Cart::where('user_id', Auth::user()
                    ->id)
                    ->update(['distype' => NULL, 'disamount' => NULL]);

            }

            DB::commit();
            $success = true;

        } catch (\Exception $e) {

            $success = false;
            DB::rollback();
            dd($e);
            return redirect()->back()->with('error', __('backend.error'));
        }

        $user = $tutor;


        /**
		** Get User Balance
		**/
		$setting = Setting::first();
		$package = $request->package_id;
		$tutor = $request->tutor_id;
		return view('frontend.payNow', compact('user', 'studentPackage', 'request', 'cartRecord', 'tutor', 'package', 'setting'));


    }
	
	public function partneraddpackage(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
			'tutor_id' => 'required|int',
            'package_id' => 'required|int',
        ]);

        $tutor = Instructor::find($request->tutor_id);
		$package = Packages::find($request->package_id);
		
		//print_r($package);

        $studentPackage = new Student_package();
        $studentPackage->package_id = $package->id;
        $studentPackage->user_id = $request->user_id;
        $studentPackage->tutor_id = $request->tutor_id;
        $studentPackage->numOfHours = $package->numOfHours;
        $studentPackage->originalPricePerHour = $tutor->PricePerHour;
        $studentPackage->discountPercentage = $package->discountPercentage;
        $studentPackage->netPrice = $tutor->PricePerHour - (($tutor->PricePerHour * $package->discountPercentage) / 100);
        $studentPackage->paid = 0;
        $studentPackage->created_by = Auth::user()->id;
        $studentPackage->save();

        $cartRecord = new Cart();
        $cartRecord->user_id = $request->user_id;
        $cartRecord->course_id = null;
        $cartRecord->student_package_id = $studentPackage->id;
        $cartRecord->category_id = null;
        $cartRecord->offer_price = $studentPackage->netPrice * $studentPackage->numOfHours;
        $cartRecord->save();

		return redirect()->back();
    }
}
