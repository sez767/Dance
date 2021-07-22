<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Dance;
use App\Feedback;
use App\Traits\CreateImage;

class School extends Model
{
    use CreateImage;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'address',
        'school_type',
        'email',
        'contact',
        'time_work',
        'age_groups',
        'price',
        'lat',
        'lng'];
        public static $VALIDATION_RULES =[
            'title'=>['required', 'string', 'min:3'],
            'description'=>['required', 'string', 'min:3', 'max:10000'],
            'email'=>['required', 'email'],
            'contact'=>['required', 'string', 'min:3'],
            
        ];    

    public function supervisors()
    {
        return $this->belongsToMany(User::class,'role_school_user')
            ->withPivotValue( 'role_id',Role::roleId('Moderator')
            );
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class,'role_school_user')
        ->withPivotValue( 'role_id',Role::roleId('School_Master')
        );
    }
    
    public function dances()
    {
        return $this->morphToMany('App\Dance', 'dancable');
    }
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
    public function masterclasses()
    {
        return $this->hasMany(Masterclass::class);
    }
    public function conquers()
    {
        return $this->hasMany(Conquer::class);
    }
    public function parties()
    {
        return $this->hasMany(Party::class);
    }
    public function halls()
    {
        return $this->hasMany(Hall::class);
    }
    public function choreographers()
    {
        return $this->hasMany(Choreographer::class);
    }
    public function dancepartners()
    {
        return $this->hasMany(Dancepartner::class);
    }
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function agegroups()
    {
        return $this->belongsToMany(Agegroup::class);
    }
    public function weekdays()
    {
        return $this->morphMany('App\Weekdays', 'dayable');
    }
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
    public function news()
    {
        return $this->belongsToMany(User::class,'role_school_user')
        ->withPivotValue( 'role_id',Role::roleId('School_Master')
        );
       
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
 
}
