<?php

namespace App\Policies;

use App\User;
use App\testparameter;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParameterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the testparameter.
     *
     * @param  \App\User  $user
     * @param  \App\testparameter  $testparameter
     * @return mixed
     */
    public function view(User $user)
    {
        $this->getPermission($user,24);
    }
    protected function getPermission($user , $id){

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == $id) return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create testparameters.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $this->getPermission($user ,23 );
    }

    /**
     * Determine whether the user can update the testparameter.
     *
     * @param  \App\User  $user
     * @param  \App\testparameter  $testparameter
     * @return mixed
     */
    public function update(User $user)
    {
        $this->getPermission($user , 25);
    }

    /**
     * Determine whether the user can delete the testparameter.
     *
     * @param  \App\User  $user
     * @param  \App\testparameter  $testparameter
     * @return mixed
     */
    public function delete(User $user, testparameter $testparameter)
    {
        $this->getPermission($user ,26 );
    }
}
