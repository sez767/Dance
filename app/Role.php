<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Role
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    const ROLE_ADMIN = 2;
    const ROLE_MODERATOR = 1;
    const ROLE_SCHOOL_MASTER= 3;
    const ROLE_USER = 4;
    const ROLE_ID = array(self::ROLE_ADMIN => 'Admin', self::ROLE_MODERATOR => 'Moderator', self::ROLE_SCHOOL_MASTER => 'School_Master', self::ROLE_USER => 'User');

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'password',
        'role_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;


    public static function roleId($role){
        return Role::where('name',$role)->value('id');
    }

}

