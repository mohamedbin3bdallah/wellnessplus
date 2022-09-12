<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Tax;
use Illuminate\Support\Facades\Session;
class TaxController extends Controller
{

    public function index(){

        $taxes = Tax::all();

        return view('admin.tax.show', compact('taxes'));

    }

    public function create(){


        return view('admin.tax.create');

    }

    public function store(Request $request){

        $taxes = Tax::all();

        $request->validate([
            'name' => 'required',
            'rate' => 'required'
        ]);

        $input = $request->all();
//dd($input);
        Tax::create($input);

        Session::flash('success',__('backend.created_successfully'));
        return redirect('/admins/tax');
    }


    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('admin.tax.edit', compact('tax'));

    }

    public function update(Request $request, $id){

        $tax = Tax::findOrFail($id);

        $new_tax = Tax::where('id', $id)->update(['name' => $request->name, 'rate' => $request->rate, 'status' => $request->status, 'updated_at' => Carbon::now()]);

        Session::flash('success',__('backend.updated_successfully'));
        return redirect('/admins/tax');
    }

    public function destroy($id){

        $tax = Tax::findOrFail($id);

        $tax->delete();

        Session::flash('delete',__('backend.deleted_successfully'));
        return redirect('/admins/tax');
    }
}
