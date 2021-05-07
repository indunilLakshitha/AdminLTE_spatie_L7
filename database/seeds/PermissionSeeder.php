<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_array =[


            //Users Section
            ['name' => 'users.index'],
            ['name' => 'users.create'],
            ['name' => 'users.store'],
            ['name' => 'users.block'],
            ['name' => 'users.update'],
            ['name' => 'users.edit'],
            ['name' => 'users.direct.Permissions'],


            //Roles Section
            ['name' => 'roles.index'],
            ['name' => 'roles.create'],
            ['name' => 'roles.store'],
            ['name' => 'roles.delete'],
            ['name' => 'roles.update'],
            ['name' => 'roles.edit'],





        ];



        //************ UNCOMMENT THESE SECTION ON FIRST SEED************//
        // $user ['name']='Super admin';
        // $user ['email']='suadmin@gmail.com';
        // $user ['password']=Hash::make('Abcd@1234');


        $role = Role::where('name','Super Admin')->first();
        foreach($permission_array as $permission){

            $check_has_permission = Permission::where('name', $permission['name'])->first();
            if(!isset($check_has_permission)){
                Permission::create($permission);
            }

            $role->givePermissionTo($permission);
        }

        // $user = User::create($user);
        // $user->assignRole('Super Admin');

    }
}
