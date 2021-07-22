<?php

namespace App\Policies;

use App\Role;
use App\Clothescategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClothescategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function view(Clothescategory $clothescategory)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission=$user->roles()->where('name','Admin')->exists();
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function update(User $user, Clothescategory $Clothescategory)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        $permission=$clothescategory->supervisors()->where('user_id',$user->id)->where('role_id',Role::roleId('Moderator'))->exists();
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function delete(User $user, Clothescategory $Clothescategory)
    {
        $permission=$user->roles()->where('name','Admin')->exists();
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function restore(User $user, Clothescategory $clothescategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function forceDelete(User $user, Clothescategory $clothescategory)
    {
        //
    }
}
