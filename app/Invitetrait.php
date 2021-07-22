<?php

namespace App;


use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait Invitetrait{
    public function makeInvite($email_user, $school): void
    {
        for($i=0;$i<10;$i++) {
            if ($email_user[$i]) {
                //$email_user = $request->email_user[$i];

                $email_value = $email_user[$i];
                $password = rand(1, 999) . time();
                $new_user = $email_user[$i];
                $user = User::create(['name' => $new_user,
                    'email' => $email_value,
                    'password' => $password,
                ]);
                $supervisor=$school->supervisors()->sync($user->id);

                do {
                    //generate a random string using Laravel's str_random helper
                    $token = Str::random();
                    $user_id=$user['id'];
                } //check if the token already exists and if it does, try again
                while (Invite::where('token', $token)->first());

                //create a new invite record
                $invite = Invite::create([
                    'email' => $email_user[$i],
                    'new_user_id' => $user_id,
                    'token' => $token
                ]);
                Mail::to($email_user[$i])->send(new InviteCreated($invite));
            }
        }
    }

}
