<?php

namespace App;
use App\Traits\CreateImage;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{   
    use CreateImage;

    protected $table = 'halls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'type',
        'area',
        'coating',
        'price',
        'school_id'];
    public static $VALIDATION_RULES = [
        'title'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3','max:300'],
        'type'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3','max:300'],
        'area'=>['required', 'string', 'min:3','max:300'],
        'coating'=>['required', 'string', 'min:3','max:300'],
        'price'=>['required', 'string', 'min:3','max:300'],

    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
    public function weekdays()
    {
        
        return $this->morphMany('App\Weekdays', 'dayable');
    }
}
