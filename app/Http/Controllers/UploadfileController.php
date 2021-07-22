<?php

namespace App\Http\Controllers;

use App\Image;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UploadfileController extends Controller
{
    function index()
    {
        return view('admin.teachers.upload');
    }

    function upload(Request $request)
    {
         $this->validate($request, [
            'select_file' => 'required|image|mimes:jpeg, png,jpg,gif|max:4096'
        ]);
        $picture = $request->file('select_file');
        $filename = $picture->getClientOriginalName();
        $picture->move(storage_path("uploads"), $filename);
        $image = new Image;
        $image->path = $filename;
        $image->save();
        dd($image);
        
        return redirect('admin/teachers/create')->with('path', $filename)->with('imageable_id',$image->imageable_id);
    }

     function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->hasFile('file')) {
            $picture = $request->file('file');
            $name = $picture->getClientOriginalName();
            $size = $picture->getClientSize();
            $image = new Image;
            $image->path = $name;
            $image->save;
        }
    }
    public function destroy($id)
    {
        $data = Image::find($id);
        $data->delete();
        
        return redirect('admin/teachers')->with('flash_message', 'Teachers deleted!');
    }
}

