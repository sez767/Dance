<?php

namespace App\Http\Controllers;
use App\Categories;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index(){
        // $categories=Categories::all();

        return view('/main.index');
        // , compact('categories'));
    }

}
