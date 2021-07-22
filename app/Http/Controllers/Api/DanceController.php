<?php

namespace App\Http\Controllers\Api;

use App\Dance;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request){
        // and choreographers ???
        $lim=0;
        if($request->limit) $lim=$request->limit;
        $schools = School::with('images')->whereHas('dances', function($q){
            $q->where('title', 'LIKE', "%постановочн%");
        })->paginate($lim);
        return response()->json($schools);
    }
    
}
