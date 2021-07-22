<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Hall;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // Note I'm not overwriting the $request variable.
        // This method returns an array of the validated data.
        $keyword = $request->get('search');
        $perPage = 25;

        $id=AdminHomeController::chooseSchool();
        $school=School::findorfail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:1000'
        ]);
       Mail::to('prodance50@gmail.com')->send(new Contact($request));

        return back()->with('success', 'Your email has successfully been sent');
    }
    public function __invoke(Request $request)
    {
        return "Welcome to our homepage";
    }
}
