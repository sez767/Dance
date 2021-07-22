<?php

namespace App\Http\Controllers\Api;

use App\Dancepartner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DancepartnerController extends Controller
{
    public function index(Request $request){   
        
        $dancepartners = Dancepartner::with('images','dances');
        
        if ($request->has('addres')) {
            $dancepartners=$dancepartners->where('living_place', $request->addres);
        }
        if ($request->has('style')) {
            $dancepartners=$dancepartners->where('dance_style', $request->style);
        }
        if ($request->has('gender')) {
            $dancepartners=$dancepartners->where('gender', $request->gender);
        }
        if ($request->has('age')) {
            $year = (\Carbon\Carbon::now()->year)-$request->age;
            $dancepartners=$dancepartners->where('age', $year);
        }        
        if ($request->has('limit')) {
            $dancepartners=$dancepartners->paginate($request->limit);
        } 
        else{
            $dancepartners=$dancepartners->get();
        }
        return response()->json($dancepartners);
    }

    public function show($id)
    {
        $dancepartner = Dancepartner::with(['images','dances'])->findOrFail($id);
        return response()->json($dancepartner);
        
    }
}
