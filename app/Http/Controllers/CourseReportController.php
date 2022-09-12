<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseReport;
use DB;
use Auth;
use Session;

class CourseReportController extends Controller
{

	public function index()
    {
    	$items = CourseReport::orderBy('id','desc')->get();
    	return view('admin.report_course.index',compact('items'));
    }

    public function create()
    {

    }

    public function store(Request $request, $id)
    {
        if ($request->email == null){

            DB::table('course_reports')->insert(
                array(
                    'course_id'=>$id,
                    'user_id'=>Auth::User()->id,
                    'title'=>implode(" , ",$request->title),
                    'email'=> null,
                    'detail'=>$request->detail,
                    'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                )
            );
        }else {
            DB::table('course_reports')->insert(
                array(
                    'course_id' => $id,
                    'user_id' => Auth::User()->id,
                    'title' => $request->title,
                    'email' => $request->email,
                    'detail' => $request->detail,
                    'created_at' => \Carbon\Carbon::now(),
                )
            );
        }
        Session::flash('success',__('backend.created_successfully'));
        return back();
    }

    public function show($id)
    {
        $show = CourseReport::where('id', $id)->first();
        return view('admin.report_course.edit',compact('show'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
    	$data = CourseReport::findorfail($id);
    	$input = $request->all();
    	$data ->update($input);

        Session::flash('success',__('backend.updated_successfully'));
    	return redirect("user/course/report");
    }

    public function destroy($id)
    {
        DB::table('course_reports')->where('id',$id)->delete();
        Session::flash('delete',__('backend.deleted_successfully'));
        return redirect("user/course/report");
    }
}
