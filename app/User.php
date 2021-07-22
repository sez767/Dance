<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';
    public function isAdmin()    {
        return $this->type === self::ADMIN_TYPE;
    }

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function supervisor_schools()
    {
        return $this->belongsToMany(School::class,'role_school_user')
            ->wherePivot( 'role_id',Role::roleId('Moderator'));
    }

    public function supervisor_clothescategory()
    {
        return $this->belongsToMany(Clothescategory::class,'role_clothescategory_user')
            ->wherePivot( 'role_id',Role::roleId('Moderator'));
    }


}
