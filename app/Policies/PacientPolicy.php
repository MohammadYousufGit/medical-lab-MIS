<?php

namespace App\Policies;

use App\User;
use App\pacient;
use Illuminate\Auth\Access\HandlesAuthorization;

class PacientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pacient.
     *
     * @param  \App\User  $user
     * @param  \App\pacient  $pacient
     * @return mixed
     */
    public function view(User $user)
    {
        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 27) return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create pacients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->getPermission($user ,19);
    }

    /**
     * Determine whether the user can update the pacient.
     *
     * @param  \App\User  $user
     * @param  \App\pacient  $pacient
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermission($user , 7);
    }

    /**
     * Determine whether the user can delete the pacient.
     *
     * @param  \App\User  $user
     * @param  \App\pacient  $pacient
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermission($user , 8);
    }
    protected function getPermission($user , $id){

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == $id) return true;
            }
        }
        return false;
    }

    public function add_test(User $user){
        return $this->getPermission($user , 28);
    }
}
