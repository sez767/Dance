<?php

namespace App;
use App\Traits\CreateImage;

use Illuminate\Database\Eloquent\Model;

class Dancepartner extends Model
{   
    use CreateImage;
    
    protected $table = 'dancepartners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'apellido',
        'living_place',
        'age',
        'gender',
        'experience',
        'participation',
        'about_yourself',
        'number',
        'facebook',
        'instagram',
        'twitter',
        'school_id'];
    public static $VALIDATION_RULES = [
        'apellido'=>['required','regex:/^[\pL\s\-]+$/u', 'min:3'],
        'dance_style'=>['required'],
        'living_place'=>['required', 'string', 'min:3'],
        'age'=>['required', 'string', 'min:3'],
        'experience'=>['required', 'string', 'min:3'],
        'participation'=>['required', 'string', 'min:3'],
        'about_yourself'=>['required', 'string', 'min:3', 'max:10000'],
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
    // for api age filter - dont del pls
    // public function getAge() {
    //     $dob=\Carbon\Carbon::parse($this->age);
    //     return $dob->diffInYears(\Carbon\Carbon::now());
    // }
}
