<?php

namespace App\Policies;

use App\User;
use App\doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\doctor  $doctor
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->getPermission($user,3);
    }

    /**
     * Checks the permission for doctor the doctor.
     *
     * @param  \App\User  $user
     * @param             $id
     * @return boolean
     */
    protected function getPermission($user , $id){

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == $id) return true;
            }
        }
        return false;
    }
    /**
     * Determine whether the user can create doctors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->getPermission($user,2);
    }

    /**
     * Determine whether the user can update the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\doctor  $doctor
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermission($user,4);
    }

    /**
     * Determine whether the user can delete the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\doctor  $doctor
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermission($user,5);
    }
}
