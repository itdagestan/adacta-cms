<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelUser = User::query()->where('email', 'adacta@ariumdev.com')->first();

        ProductCategory::withoutEvents(function () use($modelUser) {
            $modelProductCategoryFirst = new ProductCategory();
            $modelProductCategoryFirst->unsetEventDispatcher();
            $modelProductCategoryFirst->name = 'Категория 1';
            $modelProductCategoryFirst->slug = 'category_1';
            $modelProductCategoryFirst->is_active = true;
            $modelProductCategoryFirst->created_by = $modelUser->id;
            $modelProductCategoryFirst->updated_by = $modelUser->id;
            $modelProductCategoryFirst->save();
        });

        ProductCategory::withoutEvents(function () use($modelUser) {
            $modelProductCategorySecond = new ProductCategory();
            $modelProductCategorySecond->unsetEventDispatcher();
            $modelProductCategorySecond->name = 'Категория 2';
            $modelProductCategorySecond->slug = 'category_2';
            $modelProductCategorySecond->is_active = true;
            $modelProductCategorySecond->created_by = $modelUser->id;
            $modelProductCategorySecond->updated_by = $modelUser->id;
            $modelProductCategorySecond->save();
        });
    }
}
