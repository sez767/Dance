<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invite;
use App\Mail\InviteCreated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    public function invite()
    {
       $key= Session::get('key');
        if(!$key){
            return view('admin.invites.invite');
        }
        return redirect()->action('Admin\\InviteController@process2');
    }

    public function process(Request $request)
    {
        $email= Session::get('key');
        $user_all=User::all();

        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random();
            $user=User::orderBy('id', 'desc')->first();
          if(!$email){
              $user->email=$request->get('email');
              $user->save();
          }

            $user_id=$user['id'];
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        if(!$email){
            $invite = Invite::create([
                'email' => $request->get('email'),
                'new_user_id' => $user_id,
                'token' => $token
            ]);
            Mail::to($request->get('email'))->send(new InviteCreated($invite));
        }else{
            $invite = Invite::create([
                'email' => $email,
                'new_user_id' => $user_id,
                'token' => $token
            ]);
            Mail::to($email)->send(new InviteCreated($invite));
        }

        // redirect back where we came from
        return redirect('admin/schools');
    }

    public function accept($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            dd('Error, no token');
            abort(404);
        }

        // delete the invite so it can't be used again
        $invite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect('login');
    }
}
