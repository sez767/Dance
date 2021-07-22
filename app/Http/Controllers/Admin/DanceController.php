<?php

namespace App\Http\Controllers\Admin;

use App\Dance;
use App\Http\Controllers\Controller;
use App\School;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DanceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $dances = Dance::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $dances = Dance::paginate($perPage);
        }

        return view('admin.dances.index', compact('dances'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dance = new Dance();

        return view('admin.dances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:300',
                'description' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:10000',
            ]
        );
        $dance = Dance::create($request->all());
        return redirect('admin/dances')->with('flash_message', 'dances added!');
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
        $dance = Dance::findOrFail($id);

        return view('admin.dances.show', compact('dance'));
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
        $dance = Dance::findOrFail($id);

        return view('admin.dances.edit', compact('dance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Dance $dance)
    {

  

        $this->validate(
            $request,
            [
                'title' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:300',
                'description' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:10000',
            ]
        );

        $dance->update($request->all());

        return redirect('admin/dances')->with('flash_message', 'Dance updated!');
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
        Dance::destroy($id);

        return redirect('admin/dances')->with('flash_message', 'Dances deleted!');
    }
}



