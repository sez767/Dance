<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\Masterclass;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MasterclassesController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $masterclasses = Masterclass::where('title', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('contacts', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $masterclasses = Masterclass::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.masterclasses.index', compact('masterclasses'));
    }
    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
       

        return view('admin.masterclasses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param $masterclasses
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate(Masterclass::$VALIDATION_RULES);

        $id=AdminHomeController::chooseSchool();
        $masterclasses = Masterclass::create($request->all());
        $masterclasses->school_id=$id;
        $masterclasses->save();


        return redirect('admin/masterclasses')->with('flash_message', 'masterclass added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $masterclasses = Masterclass::findOrFail($id);

        return view('admin.masterclasses.show', compact('masterclasses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $masterclasses = Masterclass::findOrFail($id);

        return view('admin.masterclasses.edit', compact('masterclasses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate(Masterclass::$VALIDATION_RULES);
        $requestData = $request->all();
        $masterclasses= Masterclass::findOrFail($id);
        $masterclasses->update($requestData);

        return redirect('admin/masterclasses')->with('flash_message', 'Masterclass updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $masterclasses= Masterclass::findOrFail($id);
        Masterclass::destroy($id);

        return redirect('admin/masterclasses')->with('flash_message', 'Masterclasses deleted!');
    }
}
