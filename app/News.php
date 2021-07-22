<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class News extends Model
{
    use CreateImage;
    
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'school',
        'description', 
        'content', 
        'author', 
        'date'
    ];
    public static $VALIDATION_RULES =[
        'title'=>['required', 'string', 'min:3', 'max:60'],
        'content'=>['required', 'string', 'min:3', 'max:50000'], 
        'author'=>['required', 'string', 'min:3', 'max:60'], 
        'date'=>['date_format:"Y-m-d"']
    ];
    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }


}
