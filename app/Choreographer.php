<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Choreographer extends Model
{   
    use CreateImage;

    protected $table = 'choreographers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'living_place',
        'experience',
        'services',
        'number',
        'facebook',
        'instagram',
        'twitter',
        'school_id'
        ];
    public static $VALIDATION_RULES = [
        'title'=>['required','regex:/^[\pL\s\-]+$/u', 'min:3'],
        'dance_style'=>['required'],
        'living_place'=>['required', 'string', 'min:3'],
        'experience'=>['required', 'string', 'min:3'],
        'services'=>['required', 'string', 'min:3'],
        'number'=>['required','numeric', 'digits_between:6,20']
    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
    public function dances()
    {
        return $this->morphToMany('App\Dance', 'dancable');
    }
}
