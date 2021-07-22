<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'maincategory',
        
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
