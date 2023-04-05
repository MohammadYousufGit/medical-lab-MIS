<?php

namespace App\Policies;

use App\User;
use App\test;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the test.
     *
     * @param  \App\User  $user
     * @param  \App\test  $test
     * @return mixed
     */
    public function view(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create tests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 9) return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the test.
     *
     * @param  \App\User  $user
     * @param  \App\test  $test
     * @return mixed
     */
    public function update(User $user)
    {
        $this->getPermission($user,10);
    }

    /**
     * Determine whether the user can delete the test.
     *
     * @param  \App\User  $user
     * @param  \App\test  $test
     * @return mixed
     */
    public function delete(User $user)
    {

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 11) return true;
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
}
