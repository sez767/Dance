<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekdays extends Model
{


    protected $table = 'weekdays';
    protected $primaryKey = 'id';
    protected $fillable = ['day', 'start_time', 'finish_time','dayable_id', 'dayable_type'];
    protected $attributes = [
        'dayable_id' => false,
        'dayable_type' => false,
];
//        public static $VALIDATION_RULES = [
        
//            'changed_day'=>['required'],
          
//  ];
      public function dayable()
    {
        return $this->morphTo();
    }
                  
}

