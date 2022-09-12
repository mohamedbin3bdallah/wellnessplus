<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchLog;
use Auth;

class FilterLogController extends Controller
{
    public function index()
    {
        if(Auth::User()->role == "admin")
        {
            $items = SearchLog::all();
            return view('admin.filter_log.index',compact('items'));
        }
        else
        {
            abort(404, __('backend.page_not_found'));
        }

        
    }
}
