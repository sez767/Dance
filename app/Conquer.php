<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Conquer extends Model
{   
    use CreateImage;

    protected $table = 'conquers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'address',
        'contacts',
        'organizers',
        'contribution',
        'conditions',
        'date',
        'price',
        'program',
        'school_id'
    ];
    public static $VALIDATION_RULES =[
        'title'=>['required', 'string', 'min:3'],
        'address'=>['required', 'string', 'min:3'],
        'contacts'=>['required','numeric', 'digits_between:6,20'],
        'organizers'=>['required', 'string', 'min:3'],
        'contribution'=>['required', 'string', 'min:3'],
        'conditions'=>['required', 'string', 'min:3'],
        'date'=>['date_format:"Y-m-d"'],
        'price'=>['required', 'string', 'min:3'],
        'program'=>['required', 'string', 'min:3']
    ];
    
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
