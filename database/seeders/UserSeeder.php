<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createProduct = Permission::where('slug','create-product')->first();

        $superAdmin = Role::where('slug','super-admin')->first();
        $userSuperAdmin = new User();
        $userSuperAdmin->name = 'Adacta';
        $userSuperAdmin->email = 'adacta@ariumdev.com';
        $userSuperAdmin->email_verified_at = date('Y-m-d');
        $userSuperAdmin->password = Hash::make('sW95slbVYci3jp8fzX2');
        $userSuperAdmin->created_at = date('Y-m-d');
        $userSuperAdmin->updated_at = date('Y-m-d');
        $userSuperAdmin->save();
        $userSuperAdmin->roles()->attach($superAdmin);
        $userSuperAdmin->permissions()->attach($createProduct);

        $admin = Role::where('slug','admin')->first();
        $userAdmin = new User();
        $userAdmin->name = 'Admin';
        $userAdmin->email = 'admin@ariumdev.com';
        $userAdmin->email_verified_at = date('Y-m-d');
        $userAdmin->password = Hash::make('Gx95sdbVYcf3jp8f3X2');
        $userAdmin->created_at = date('Y-m-d');
        $userAdmin->updated_at = date('Y-m-d');
        $userAdmin->save();
        $userAdmin->roles()->attach($admin);
        $userAdmin->permissions()->attach($createProduct);

        $moderator = Role::where('slug', 'moderator')->first();
        $userModerator = new User();
        $userModerator->name = 'Moderator';
        $userModerator->email = 'moderator@ariumdev.com';
        $userModerator->email_verified_at = date('Y-m-d');
        $userModerator->password = Hash::make('8hj5sll98ci3jp8fkT7');
        $userModerator->created_at = date('Y-m-d');
        $userModerator->updated_at = date('Y-m-d');
        $userModerator->save();
        $userModerator->roles()->attach($moderator);
        $userModerator->permissions()->attach($createProduct);
    }
}
