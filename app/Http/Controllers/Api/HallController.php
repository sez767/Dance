<?php

namespace App\Http\Controllers\Api;

use App\Hall;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request){   
        $halls = Hall::with('images');

        if ($request->has('addres')) {
            $halls=$halls->whereHas('schools', function($q){
                $q->where('addres', '=', request('addres', 0));
            }); 
        }
        if ($request->has('type')) {
            $halls=$halls->where('type', $request->type);
        }
        if ($request->has('area')) {
            $halls=$halls->where('area', $request->area);
        }
        if ($request->has('price')) {
            $halls=$halls->where('price', $request->price);
        }
        if ($request->has('limit')) {
            $halls=$halls->paginate($request->limit);
        } 
        else{
            $halls=$halls->get();
        }
        return response()->json($halls);
    }
    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $hall = Hall::with('images')->findOrFail($id);
        return response()->json($hall);
    }
}
