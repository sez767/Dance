<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agegroup extends Model
{
    protected $fillable = [
        'title',
        'begin',
        'end',
        'price',
        'school_id',
    ];

    public function school(){

        return $this->belongsToMany('App\Models\School');

    }
}
