<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterclass extends Model
{
    protected $table = 'masterclasses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'path',
        'address',
        'contacts',
        'age',
        'kind',
        'duration',
        'price',
        'recording',
        'lat',
        'lng',
        'school_id'];
    public static $VALIDATION_RULES =[
        'title'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3', 'max:300'],
         'path'=>['required', 'string', 'min:3', 'max:300'],
        'address'=>['required', 'string', 'min:3', 'max:300'],
        'contacts'=>['required', 'numeric', 'min:3', 'max:300'],
        'age'=>['date_format:"Y-m-d"'],
        'kind'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3', 'max:300'],
        'duration'=>['regex:/^[\w\- \p{Cyrillic}]*$/u'],
        'price'=>['required', 'numeric', 'min:3', 'max:300'],
        'recording'=>['required', 'numeric', 'min:3', 'max:300'],
    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
