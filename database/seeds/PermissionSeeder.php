<?php

use App\role;
use App\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** @var \App\permission_NAME $permission creates permission for user */
        //  1
        $permission = new \App\permission([
            'name'=>'user-crud',
            'for' =>'other'
        ]);
        $permission->save();
        // 2
        $permission = new \App\permission([
            'name'=>'doctor-create',
            'for' =>'doctor'
        ]);
        $permission->save();
        //  3
        $permission = new \App\permission([
            'name'=>'doctor-read',
            'for' =>'doctor'
        ]);
        $permission->save();
        //  4
        $permission = new \App\permission([
            'name'=>'doctor-update',
            'for' =>'doctor'
        ]);
        $permission->save();
        //  5
        $permission = new \App\permission([
            'name'=>'doctor-delete',
            'for' =>'doctor'
        ]);
        $permission->save();
        //  6
        $permission = new \App\permission([
            'name'=>'patient',
            'for' =>'nothing'
        ]);
        $permission->save();
        //  7
        $permission = new \App\permission([
            'name'=>'patient-update',
            'for' =>'patient'
        ]);
        $permission->save();
        //  8
        $permission = new \App\permission([
            'name'=>'patient-delete',
            'for' =>'patient'
        ]);
        $permission->save();
        //  9
        $permission = new \App\permission([
            'name'=>'test-create',
            'for' =>'test'
        ]);
        $permission->save();
        //  10
        $permission = new \App\permission([
            'name'=>'test-update',
            'for' =>'test'
        ]);
        $permission->save();
        //  11
        $permission = new \App\permission([
            'name'=>'test-delete',
            'for' =>'test'
        ]);
        $permission->save();
        //  12
        $permission = new \App\permission([
            'name'=>'stock-create',
            'for' =>'stock'
        ]);
        $permission->save();
        //  13
        $permission = new \App\permission([
            'name'=>'stock-read',
            'for' =>'stock'
        ]);
        $permission->save();
        //  14
        $permission = new \App\permission([
            'name'=>'stock-update',
            'for' =>'stock'
        ]);
        $permission->save();
        //  15
        $permission = new \App\permission([
            'name'=>'branch-create',
            'for' =>'branch'
        ]);
        $permission->save();
        //  16
        $permission = new \App\permission([
            'name'=>'branch-read',
            'for' =>'branch'
        ]);
        $permission->save();
        //  17
        $permission = new \App\permission([
            'name'=>'branch-update',
            'for' =>'branch'
        ]);
        $permission->save();
        //  18
        $permission = new \App\permission([
            'name'=>'branch-delete',
            'for' =>'branch'
        ]);
        $permission->save();
        //  19
        $permission = new \App\permission([
            'name'=>'patient-create',
            'for' =>'patient'
        ]);
        $permission->save();
        //  20
        $permission = new \App\permission([
            'name'=>'Today Report',
            'for' =>'other'
        ]);
        $permission->save();
        //  21
        $permission = new \App\permission([
            'name'=>'Tabular Report',
            'for' =>'other'
        ]);
        $permission->save();
        //  22
        $permission = new \App\permission([
            'name'=>'Sale Summary',
            'for' =>'other'
        ]);
        $permission->save();
        //  23
        $permission = new \App\permission([
            'name'=>'Parameter Create',
            'for' =>'test'
        ]);
        $permission->save();
        //  24
        $permission = new \App\permission([
            'name'=>'Parameter Read',
            'for' =>'test'
        ]);
        $permission->save();
        //  25
        $permission = new \App\permission([
            'name'=>'Parameter Update',
            'for' =>'test'
        ]);
        $permission->save();
        //  26
        $permission = new \App\permission([
            'name'=>'Parameter Delete',
            'for' =>'test'
        ]);
        $permission->save();
        //  27
        $permission = new \App\permission([
            'name'=>'Patient Discount',
            'for' =>'patient'
        ]);
        $permission->save();
        //  28
        $permission = new \App\permission([
            'name'=>'Add test to Patient',
            'for' =>'patient'
        ]);
        $permission->save();
        //  29
        $permission = new \App\permission([
            'name'=>'Edit test of Patient',
            'for' =>'patient'
        ]);
        $permission->save();
        //  30
        $permission = new \App\permission([
            'name'=>'Branch-Create',
            'for' =>'branch'
        ]);
        $permission->save();


        /** @var \App\branch $branch creates branch for user */
        $branch = new \App\branch([
            'name'=>'no_branch',
            'id'  => 49
        ]);
        $branch->save();
        $branch = new \App\branch([
            'name'=>'no_branch',
            'id'  => 100
        ]);
        $branch->save();

        // doctor self is related to rana lab
        $doctor = new \App\doctor([
            'name' => 'self',
            'phone'=> '0'
        ]);
        $doctor->save();
        /** @var role $role  assigns role for Admin */
        $role = new role;
        $role->name = 'super_admin';
        $role->save();
        $role->permissions()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26]);

        $admin = new \App\User([
            'name' =>'admin',
            'email'=>'admin@admin.com',
            'branch_id'=>49,
            'password' =>bcrypt('abc@673super_admin'),

        ]);
        $admin->save();

        $admin->roles()->sync([1]);


    }
}
