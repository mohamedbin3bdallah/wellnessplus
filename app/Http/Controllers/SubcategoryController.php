<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Categories;
use Session;
use App\ChildCategory;
use App\Course;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = SubCategory::all();
        return view('admin.category.subcategory.index',compact("subcategory"));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = Categories::all();
        return view('admin.category.subcategory.insert',compact('category')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validate($request,[
            "title"=>"required",
                 ],[
            "title.required"=>__('backend.please_enter_subcategory_title'),
        ]);

        $input = $request->all();
        //$slug = str_slug($input['title'],'-');
		$slug = str_replace(' ', '-', strtolower($input['title']));
        $input['slug'] = $slug;
        $data = SubCategory::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        $data->save();

        Session::flash('success',__('backend.created_successfully'));
        return redirect ('subcategory');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  

        $cate = SubCategory::find($id);
        $category = Categories::all();
        return view('admin.category.subcategory.update',compact('cate','category'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(subcategory $subcategory)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $data = SubCategory::findorfail($id);
        $input = $request->all();
        
        //$slug = str_slug($input['title'],'-');
		$slug = str_replace(' ', '-', strtolower($input['title']));
        $input['slug'] = $slug;

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        
        $data->update($input);
        Session::flash('success',__('backend.updated_successfully'));
        return redirect ('subcategory');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::User()->role == "admin"){


            $course = Course::where('subcategory_id', $id)->get();

            if(!$course->isEmpty())
            {
                return back()->with('delete',__('backend.cant_delete_record').' '.__('backend.there_is_relation_with_other_records'));
            }
            else
            {

                DB::table('sub_categories')->where('id',$id)->delete();
                ChildCategory::where('subcategory_id', $id)->delete();

                return back()->with('delete',__('backend.deleted_successfully'));

            }
        }
     
        return redirect('subcategory');
    }
     
    public function SubcategoryStore(Request $request)
    {

        $cat = new SubCategory;

        $cat->category_id = $request->categories;

        $cat->title = $request->title;

        $cat->icon = $request->icon;
           
        $cat->status = $request->status;

        //$slug = str_slug($request['title'],'-');
		$slug = str_replace(' ', '-', strtolower($input['title']));
        $cat['slug'] = $slug;

        $cat->save();


        return back()->with('success',__('backend.created_successfully'));

    }
}
