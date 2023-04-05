<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function today_report(User $user){

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 20) return true;
            }
        }
        return false;
    }


    public function tabular_report(User $user){

        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->id == 21) return true;
            }
        }
        return false;
    }
public function sale_summary(User $user){
    foreach ($user->roles as $role){
        foreach ($role->permissions as $permission){
            if ($permission->id == 22) return true;
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
