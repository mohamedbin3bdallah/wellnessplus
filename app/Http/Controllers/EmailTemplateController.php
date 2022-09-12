<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\EmailTemplate;
use Illuminate\Support\Facades\Session;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->role == "admin")
        {
            $email_templates = EmailTemplate::first();
            return view('admin.email_templates.edit' , compact('email_templates'));
        }
        else
        {
            abort(404, __('backend.page_not_found'));
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if(Auth::User()->role == "admin")
        {
            try {
                $email_templates = EmailTemplate::first();
                $email_templates->booked_successfully_studnet_email = $request->booked_successfully_studnet_email;
                $email_templates->booked_successfully_tutor_email = $request->booked_successfully_tutor_email;
                $email_templates->refund_request_email = $request->refund_request_email;
                $email_templates->save();
                Session::flash('success',__('backend.updated_successfully'));
                return view('admin.email_templates.edit' , compact('email_templates'));

            } catch (\Exception $e) {
                return redirect()->back();
            }
        }
        else
        {
            abort(404, __('backend.page_not_found'));
        }

    }
}
