<?php

namespace App\Http\Controllers\Api;

use App\Choreographer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChoreographerController extends Controller
{
    public function show($id){
        $choreographer = Choreographer::with(['images','dances'])->findOrFail($id);
        return response()->json($choreographer);
    }
}
