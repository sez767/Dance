<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SchoolController extends Controller
{
    public function index(Request $request) {
        $schools = School::with('images');
        
        if ($request->has('addres')) {
            $schools=$schools->where('addres', $request->addres);
        }
        if ($request->has('style')) {
            $schools=$schools->where('dance_style', $request->style);
        }
        if ($request->has('age')) {
            $schools =$schools->whereHas('agegroups', function($q){
                $q->where('begin', '<=', request('age', 0))
                ->where('end', '>=', request('age', 0));
            });  
            //if not found ??????
        }          
        if ($request->has('limit')) {
            $schools=$schools->paginate($request->limit);
        } 
        else{
            $schools=$schools->get();
        }
        return response()->json($schools);
    }

    public function show($id) {
        $school = School::with(['images','dances','agegroups','weekdays',
        'choreographers' => function($query) {
            $query->with('images');
        },'halls'=> function($query) {
            $query->with('images');
        },'dancepartners'=> function($query) {
            $query->with('images');
        }])->findOrFail($id);
       
        return response()->json($school);
    }   
}
