<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Party extends Model
{   
    use CreateImage;
    
    protected $table = 'parties';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'date',
        'program',
        'price',
        'address', 
        'school_id'];
        public static $VALIDATION_RULES =[
            'title'=>['required', 'string', 'min:3'],
            'date'=>['date_format:"Y-m-d"'],
            'program'=>['required', 'string', 'min:3'],
            'price'=>['required', 'string', 'min:3'],
            'address'=>['required', 'string', 'min:3']
        ];


    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
