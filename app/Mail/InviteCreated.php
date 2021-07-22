<?php

namespace App\Mail;

use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
        //dd($invite);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       //$tk=InviteCreated::get('token');
        $token=$this->invite['token'];
        $new_user_id=$this->invite['new_user_id'];
       // dd($this->invite['token']);
        return $this->from('prodance50@gmail.com')
            ->view('admin.emails.invite')->with('token',$token)->with('new_user_id',$new_user_id);
    }
}
