<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Categories;
use App\Course;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupans = Coupon::with('creator', 'updater')->orderBy('id','DESC')->get();
//        dd($coupans);
        return view("admin.coupan.index",compact("coupans"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::all();
        $product = Course::all();
        $coupon_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7);
        return view("admin.coupan.add",compact('coupon_code','category','product'));
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
            'name' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:300',
            'maxusage' => 'required|min:1',
            'limitationForSingleUser' => 'required|min:1',
            'minamount' => 'required|min:0',
            'code' => 'required|min:2|max:100',
            'distype' => 'required',
            'status' => 'required' ,
        ]);
//dd($validator);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['created_by'] = auth()->id();

        $newc = new Coupon;

        if($request->link_by == 'product'){
            $input['minamount'] = NULL;
        }else{
            $input['pro_id'] = NULL;
        }

        $newc->create($input);

        return redirect("coupon")->with("success",__('backend.created_successfully'));
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $coupan = Coupon::findOrFail($id);
        return view("admin.coupan.edit",compact("coupan"));
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:300',
            'maxusage' => 'required|min:1',
            'limitationForSingleUser' => 'required|min:1',
            'minamount' => 'required|min:0',
            'code' => 'required|min:2|max:100',
            'distype' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['updated_by'] = auth()->id();
        $newc = Coupon::find($id);

        if($request->link_by == 'product'){
            $input['minamount'] = NULL;
        }else{
            $input['pro_id'] = NULL;
        }

        $newc->update($input);

        return redirect("coupon")->with("success",__('backend.updated_successfully'));
    }

    public function destroy($id)
    {
        $newc = Coupon::find($id);
        if(isset($newc)){
            $newc->delete();
            return back()->with('success',__('backend.deleted_successfully'));
        }else{
            return back()->with('delete',__('backend.record_not_found'));
        }
    }
}
