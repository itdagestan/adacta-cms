<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelUser = User::query()->where('email', 'adacta@ariumdev.com')->first();
        $modelProductCategory = ProductCategory::query()->where('slug', 'category_1')->first();

        Product::withoutEvents(function () use($modelUser, $modelProductCategory) {
            $modelProductFirst = new Product();
            $modelProductFirst->name = 'Товар 1';
            $modelProductFirst->slug = 'product_1';
            $modelProductFirst->is_active = true;
            $modelProductFirst->category_id = $modelProductCategory->id;
            $modelProductFirst->created_by = $modelUser->id;
            $modelProductFirst->updated_by = $modelUser->id;
            $modelProductFirst->save();
        });

        Product::withoutEvents(function () use($modelUser, $modelProductCategory) {
            $modelProductSecond = new Product();
            $modelProductSecond->name = 'Товар 2';
            $modelProductSecond->slug = 'product_2';
            $modelProductSecond->is_active = true;
            $modelProductSecond->category_id = $modelProductCategory->id;
            $modelProductSecond->created_by = $modelUser->id;
            $modelProductSecond->updated_by = $modelUser->id;
            $modelProductSecond->save();
        });

    }
}
