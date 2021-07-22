<?php

namespace App\Http\Controllers\Admin;

use App\Conquer;
use App\Http\Controllers\Controller;
use App\Image;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ConquerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        $school=School::findorfail($id);
        if (!empty($keyword)) {
            $conquer = Conquer::where('title', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $conquer = Conquer::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.conquers.index', compact('conquer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('admin.conquers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $request->validate(Conquer::$VALIDATION_RULES); 
        $id=AdminHomeController::chooseSchool();
        $conquer=Conquer::create($request->all());
        $conquer->school_id=$id;
        $conquer->save();
        $conquer->storeImage($request);
        
        return redirect('admin/conquers')->with('flash_message', 'conquer added!');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id)
    {
        $conquer = Conquer::findOrFail($id);
               
        return view('admin.conquers.show', compact('conquer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Conquer $conquer)
    {
        return view('admin.conquers.edit', compact('conquer'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request,Conquer $conquer)
    {
        $request->validate(Conquer::$VALIDATION_RULES);
        $conquer_path = $conquer->images()->get(['path'])->first();
        if(!$conquer_path==null){
            $conquery->update($request->all());
        }else{
            $image1=null;
            $conquer->update($request->all());
        }
        $conquer->storeImage($request);   

        return redirect('admin/conquers')->with('flash_message', 'Conquer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Conquer $conquer)
    {
        $conquer->deleteImage();
        $conquer->delete();

        return redirect('admin/conquers')->with('flash_message', 'Conquer deleted!');
    }
}
