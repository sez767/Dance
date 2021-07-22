<?php

namespace App\Http\Controllers\Api;

use App\Competition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request){   
        
        $comp = Competition::with('images');
        
        if ($request->has('city')) {
            $comp=$comp->where('city', $request->city);
        }
        // if ($request->has('style')) {
        //     $comp=$comp->where('dance_style', $request->style);
        // }
        if ($request->has('date')) {
            $comp=$comp->where('date', $request->date);
        }        
        if ($request->has('limit')) {
            $comp=$comp->paginate($request->limit);
        } 
        else{
            $comp=$comp->get();
        }
        return response()->json($comp);
    }

    public function show($id)
    {
        $com = Competition::with('images')->findOrFail($id);
        return response()->json($com);
        
    }
}
