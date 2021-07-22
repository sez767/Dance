<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Competition extends Model
{
    use CreateImage;
    
    protected $table = 'competitions';
    protected $primaryKey = 'id';
    protected $fillable = ['title',
    'city',
    'date',
    'date_begin',
    'date_end',
    'address',
    'contacts',
    'organizers',
    'contribution',
    'conditions',
    'school_id'
    ];

    public static $VALIDATION_RULES = [
        'title'=>['required', 'string', 'min:3'],
        'city'=>['required', 'string', 'min:3'],
        'date'=>['required','date_format:"Y-m-d"'],
        'date_begin'=>['required','date_format:"Y-m-d"'],
        'date_end'=>['required','date_format:"Y-m-d"'],
        'address'=>['required', 'string', 'min:3'],
        'contacts'=>['required','numeric', 'digits_between:6,20'],
        'organizers'=>['required', 'string', 'min:3'],
        'contribution'=>['required', 'string', 'min:3'],
        'conditions'=>['required', 'string', 'min:3']
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
