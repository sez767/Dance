<?php

namespace App\Http\Controllers\Admin;

use App\Dance;
use App\Http\Controllers\Controller;
use App\Image;
use App\School;
use App\User;
use App\Inventory;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $inventories = Inventory::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $inventories = Inventory::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }
        return view('admin.inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.inventories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'title' => ['required','regex:/^[\w\- \p{Cyrillic}]*$/u','min:3','max:30'],
            'description' => ['required','min:3','max:10000'],
            'price' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            ]);
        
        $id = AdminHomeController::chooseSchool();
        $inventory = Inventory::create($request->all());
        $inventory->school_id=$id;
        $inventory->save();
        $inventory->storeImage($request);
            
        return redirect('admin/inventories')
            ->with('flash_message', 'Inventory added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {   
        return view('admin.inventories.show')
            ->with('inventory',$inventory);
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $categories = Category::all();    

        return view('admin.inventories.edit')
        ->with('categories', $categories)
        ->with('inventory',$inventory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validatedData = $request->validate([
            'title' => ['required','min:3','regex:/^[\w\- \p{Cyrillic}]*$/u','max:30'],
            'description' => ['required','min:3','max:10000'],
            'price' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            
            ]);
        
        $inv_path = $inventory->images()->get(['path'])->first();
        if(!$inv_path==null){
            $inventory->update($request->all());
        }else{
            $image1=null;
            $inventory->update($request->all());
        }
        $inventory->storeImage($request);
            
        return redirect('admin/inventories')
            ->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->deleteImage();
        $inventory->delete();

        return redirect('admin/inventories')
            ->with('flash_message', 'Stuff deleted!');
    }
}
