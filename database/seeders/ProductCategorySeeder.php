<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelProductCategoryFirst = new ProductCategory();
        $modelProductCategoryFirst->unsetEventDispatcher();
        $modelProductCategoryFirst->name = 'Категория 1';
        $modelProductCategoryFirst->slug = 'category_1';
        $modelProductCategoryFirst->is_active = true;
        $modelProductCategoryFirst->save();

        $modelProductCategorySecond = new ProductCategory();
        $modelProductCategorySecond->unsetEventDispatcher();
        $modelProductCategorySecond->name = 'Категория 2';
        $modelProductCategorySecond->slug = 'category_2';
        $modelProductCategorySecond->is_active = true;
        $modelProductCategorySecond->save();
    }
}
