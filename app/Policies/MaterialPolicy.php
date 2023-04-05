<?php

namespace App\Policies;

use App\User;
use App\material;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the material.
     *
     * @param  \App\User  $user
     * @param  \App\material  $material
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->getPermission($user,13);
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
     * Determine whether the user can create materials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->getPermission($user,12);
    }

    /**
     * Determine whether the user can update the material.
     *
     * @param  \App\User  $user
     * @param  \App\material  $material
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermission($user,14);
    }

    /**
     * Determine whether the user can delete the material.
     *
     * @param  \App\User  $user
     * @param  \App\material  $material
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermission($user,15);
    }
}
