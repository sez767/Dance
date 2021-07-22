<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.categories.create');
    }

    public function show(Category $category)
    {   
        return view('admin.subcategories.index')
            ->with('category',$category);
            
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->validate([
            'maincategory' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u|min:3|max:30',
            ]);
        $category = Category::create($request->all());
        
        return redirect('admin/categories')
        ->with('success','Упішно. Не забудьте обов\'язково створити Підкатегорію');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function findSubcategory($id)
    {
        $data = Subcategory::select('subcategory', 'id')
            ->where('category_id', $id)->take(100)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {   
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'maincategory' => 'required|string|alpha|min:3|max:30'
            ]);
        $category->update($request->all());
            
        return redirect('admin/categories')
            ->with('flash_message', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->subcategories->each->delete();
        $category->delete();

        return redirect('admin/categories')
            ->with('flash_message', 'Category deleted!');
    }
}
