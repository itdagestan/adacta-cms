<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $createProduct = new Permission();
        $createProduct->name = 'Создать товар';
        $createProduct->slug = 'create-product';
        $createProduct->save();
    }
}
