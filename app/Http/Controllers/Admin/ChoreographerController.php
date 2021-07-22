<?php

namespace App\Http\Controllers\Admin;

use App\Choreographer;
use App\Http\Controllers\Controller;
use App\Image;
use App\School;
use App\Dance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ChoreographerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id = AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $choreographer = Choreographer::where('title', 'LIKE', "%$keyword%")
                ->orWhere('living_place', 'LIKE', "%$keyword%")
                ->orWhere('experience', 'LIKE', "%$keyword%")
                ->orWhere('dance_style', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $choreographer = Choreographer::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.choreographers.index', compact('choreographer'));
    }

    public function create()
    {   
        $dances = Dance::all();
        return view('admin.choreographers.create',compact('dances'));
    }

    public function store(Request $request)
    {
        $request->validate(Choreographer::$VALIDATION_RULES);
        $id = AdminHomeController::chooseSchool();
        $choreographer = Choreographer::create($request->all());
        $choreographer->school_id=$id;
        $choreographer->save();
        $choreographer->dances()->sync($request->dance_style);
        $choreographer->storeImage($request);
                
        return redirect('admin/choreographers')->with('flash_message', 'party added!');
    }
    public function show($id)
    {
        $choreographer = Choreographer::findOrFail($id);
        $choreographer_path= $choreographer->images()->get(['path'])->first();
        if(!$choreographer_path==null){
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Choreographer'],
            ])->get();
            $image=$image1[0];
        }
        else {$image=null;}

        return view('admin.choreographers.show', compact('choreographer'), compact('image'));
    }
    public function edit($id)
    {
        $choreographer = Choreographer::findOrFail($id);
        $choreographer_path= $choreographer->images()->get(['path'])->first();
        if(!$choreographer_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Choreographer'],
            ])->get();
        }
        else {$image1=null;}
        if($image1){
            $image=$image1[0];
            $image_path = $image1[0]->path;
        }
        else {$image=null;}
        $dances = Dance::all();
        return view('admin.choreographers.edit', compact(['choreographer','dances']),compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, $id)
    {
        $request->validate(Choreographer::$VALIDATION_RULES);
        $requestData = $request->all();

        $choreographer= Choreographer::findOrFail($id);
        $choreographer_path= $choreographer->images()->get(['path'])->first();
        if(!$choreographer_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Choreographer'],
            ])->get();
            $image2=$image1[0];
            $image_path2 = $image1[0]->path;
            $choreographer->update($requestData);
        }
        else {$image1=null; $choreographer->update($requestData);}
        $choreographer->storeImage($request);
        $choreographer->dances()->sync($request->dance_style);
        return redirect('admin/choreographers')->with('flash_message', 'Conquer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Choreographer $choreographer)
    {
        $choreographer->deleteImage();
        $choreographer->delete();;

        return redirect('admin/choreographers')->with('flash_message', 'Conquer deleted!');
    }
}
