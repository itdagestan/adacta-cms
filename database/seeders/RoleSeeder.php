<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator = new Role();
        $moderator->name = 'Модератор';
        $moderator->slug = 'moderator';
        $moderator->save();

        $admin = new Role();
        $admin->name = 'Админ';
        $admin->slug = 'admin';
        $admin->save();

        $superAdmin = new Role();
        $superAdmin->name = 'Супер пользователь';
        $superAdmin->slug = 'super-admin';
        $superAdmin->save();
    }
}
