<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Conquer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConquerController extends Controller
{
    public function index(Request $request) {
        $lim=0;
        if($request->limit) $lim=$request->limit;
        $conquers = Conquer::with('images')->paginate($lim);
        return response()->json($conquers);
    }

    public function show($id) {
        $conquers = Conquer::with('images')->findOrFail($id);
       
        return response()->json($conquers);
    }   
}