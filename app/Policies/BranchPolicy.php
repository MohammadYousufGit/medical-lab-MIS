<?php

namespace App\Policies;

use App\User;
use App\branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the branch.
     *
     * @param  \App\User  $user
     * @param  \App\branch  $branch
     * @return mixed
     */
    public function view(User $user)
    {
        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 16) return true;
            }
        }
        return false;
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
     * Determine whether the user can create branches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->getPermission($user,30);

    }

    /**
     * Determine whether the user can update the branch.
     *
     * @param  \App\User  $user
     * @param  \App\branch  $branch
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermission($user,17);
    }

    /**
     * Determine whether the user can delete the branch.
     *
     * @param  \App\User  $user
     * @param  \App\branch  $branch
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermission($user,18);
    }
}
