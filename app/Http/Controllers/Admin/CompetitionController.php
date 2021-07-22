<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Image;
use App\School;
use App\Dance;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

class CompetitionController extends Controller
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
            $competitions = Competition::where('title', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $competitions = Competition::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {   
        $dances = Dance::all();
        return view('admin.competitions.create', compact('dances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        
        $request->validate(Competition::$VALIDATION_RULES);        
        
        $id=AdminHomeController::chooseSchool();
        $competition = Competition::create($request->all());
        $competition->school_id=$id;
        $competition->save();
        $competition->storeImage($request);
        $competition->dances()->sync($request->dance_style);        
        return redirect('admin/competitions')->with('flash_message', 'competition added!');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id)
    {
        $competition = Competition::findOrFail($id);
        $competition_path= $competition->images()->get(['path'])->first();
        if(!$competition_path==null){
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Competition'],
            ])->get();
            $image=$image1[0];
        }
        else {$image=null;}

        return view('admin.competitions.show', compact(['competition', 'dances']), compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        
        $competition = Competition::findOrFail($id);
        $dances = Dance::all();
        return view('admin.competitions.edit', compact(['competition', 'dances']));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request,Competition $competition)
    {
        $request->validate(Competition::$VALIDATION_RULES);  
        $competition_path = $competition->images()->get(['path'])->first();
        if(!$competition_path==null){
            $competition->update($request->all());
        }else{
            $image1=null;
            $competition->update($request->all());
        }
        $competition->storeImage($request);    
        $competition->dances()->sync($request->dance_style);
        return redirect('admin/competitions')->with('flash_message', 'Competition updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Competition $competition)
    {
        $competition->deleteImage();
        $competition->delete();

        return redirect('admin/competitions')->with('flash_message', 'Teachers deleted!');
    }
}
