<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Inventory extends Model
{
    use CreateImage;
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'subcategory_id',
        'category_id',
        'school_id'
        ];
    public static $VALIDATION_RULES =[
        'title'=>['required', 'string', 'min:3'],
        'description'=>['required', 'string', 'min:3'],
        'price'=>['required', 'string', 'min:3'],
        'type'=>['required', 'string', 'min:3']
    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
