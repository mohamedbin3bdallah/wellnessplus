<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VapulusController extends Controller
{

    public function handleGatewayCallback(Request $request){

        dd($request);

    }
}
