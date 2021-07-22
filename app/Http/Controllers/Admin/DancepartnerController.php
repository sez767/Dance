<?php

namespace App\Http\Controllers\Admin;

use App\Dancepartner;
use App\Http\Controllers\Controller;
use App\Image;
use App\School;
use App\Dance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DancepartnerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id = AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $dancepartner = Dancepartner::where('apellido', 'LIKE', "%$keyword%")
                ->orWhere('dance_style', 'LIKE', "%$keyword%")
                ->orWhere('experience', 'LIKE', "%$keyword%")
                ->orWhere('living_place', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $dancepartner = Dancepartner::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.dancepartners.index', compact('dancepartner'));
    }


    public function create()
    {   
        $dances = Dance::all();
        return view('admin.dancepartners.create', compact('dances'));
    }



    public function store(Request $request)
    {
        
        $request->validate(Dancepartner::$VALIDATION_RULES);
        $id = AdminHomeController::chooseSchool();
        
        $dancepartner = Dancepartner::create($request->all());
        $dancepartner->school_id=$id;
        $dancepartner->save();
        $dancepartner->storeImage($request);
        $dancepartner->dances()->sync($request->dance_style);
        return redirect('admin/dancepartners')
            ->with('flash_message', 'Dancer added!');
    }
    public function show($id)
    {
        $dancepartner = Dancepartner::findOrFail($id);
        $dancepartner_path= $dancepartner->images()->get(['path'])->first();
        if(!$dancepartner_path==null){
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Dancepartner'],
            ])->get();
            $image=$image1[0];
        }
        else {$image=null;}

        return view('admin.dancepartners.show', compact('dancepartner'), compact('image'));
    }
    public function edit($id)
    {
        $dancepartner = Dancepartner::findOrFail($id);
        $dances = Dance::all();
        $dancepartner_path= $dancepartner->images()->get(['path'])->first();
        if(!$dancepartner_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Dancepartner'],
            ])->get();
        }
        else {$image1=null;}
        if($image1){
            $image=$image1[0];
            $image_path = $image1[0]->path;
        }
        else {$image=null;}
        return view('admin.dancepartners.edit', compact(['dancepartner','dances']),compact('image'));
    }
    public function update(Request $request, Dancepartner $dancepartner)
    {
        $request->validate(Dancepartner::$VALIDATION_RULES);
        $dancepartner_path= $dancepartner->images()->get(['path'])->first();
        if(!$dancepartner_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $dancepartner->id],
                ['imageable_type', 'App\Dancepartner'],
            ])->get();
            $image2=$image1[0];
            $image_path2 = $image1[0]->path;

            $dancepartner->update($request->all());
        }
        else {$image1=null; $dancepartner->update($request->all());}
        $dancepartner->storeImage($request);
        $dancepartner->dances()->sync($request->dance_style);
        return redirect('admin/dancepartners')->with('flash_message', 'Conquer updated!');
    }
    public function destroy(Dancepartner $dancepartner)
    {
        $dancepartner->deleteImage();
        $dancepartner->delete();

        return redirect('admin/dancepartners')->with('flash_message', 'Conquer deleted!');
    }
}
