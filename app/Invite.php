<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use Invitetrait;
    protected $fillable = [
        'email', 'token','new_user','new_user_id'
    ];
}
