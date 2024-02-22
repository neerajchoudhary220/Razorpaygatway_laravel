<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        return view('location.index');
    }

    public function store(Request $request){
        $input['ip'] = $request->ip();
        $input['coordinates'] = $request->coordinates;
        Location::create($input);
        return response()->json([
            'msg'=>'success',
        ]);
    }
}
