<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\School;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'title',
        'feedback'
    ];

    public function school()
{
    return $this->belongsTo('App\School', 'school_id' );
}
}
