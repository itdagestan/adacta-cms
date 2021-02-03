<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelProductCategory = ProductCategory::query()->where('slug', 'category_1')->first();

        $modelProductFirst = new Product();
        $modelProductFirst->name = 'Товар 1';
        $modelProductFirst->slug = 'product_1';
        $modelProductFirst->is_active = true;
        $modelProductFirst->type = Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS;
        $modelProductFirst->category_id = $modelProductCategory->id;
        $modelProductFirst->save();

        $modelProductSecond = new Product();
        $modelProductSecond->name = 'Товар 2';
        $modelProductSecond->slug = 'product_2';
        $modelProductSecond->is_active = true;
        $modelProductSecond->type = Product::TYPE_SINGLE_PRODUCT;
        $modelProductSecond->category_id = $modelProductCategory->id;
        $modelProductSecond->save();

    }
}
