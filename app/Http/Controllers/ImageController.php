<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Image;

class ImageController extends Controller
{
   public function upload(Request $request)
   {
       $path = $request->file('image')->store('uploads', 'public');

       return view('default', ['path' => $path]);

   }
}
