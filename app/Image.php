<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Imagestrait;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['path','imageable_id','imageable_type'];
    protected $attributes = [
    'imageable_id' => false,
        'imageable_type' => false,
];
      public function imageable()
    {
        return $this->morphTo();
    }

}
