<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $category=Category::find($id);
        
        return view('admin.subcategories.create')
        ->with('category',$category);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {   
        $data = $request->validate([
            'subcategory' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u','min:3|max:30',
            ]);
        $subcategory = new Subcategory;
        $subcategory->subcategory = $request->input('subcategory');
        $subcategory->category_id=$id;
        $subcategory->save();
        
        return redirect('admin/categories/'.$id)
            ->with('flash_message', 'Subategory added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $subcategory = Subcategory::find($id);
        
        return view('admin.subcategories.edit')
        ->with('subcategory', $subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $data = $request->validate([
            'subcategory' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u','min:3|max:30',
            ]);
        $subcategory = Subcategory::find($id);
        $subcategory->update($request->all());
            
        return back()->with('flash_message', 'Subcategory updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Subcategory::destroy($id);

        return back()->with('flash_message', 'Subategory deleted!');
    }
}
