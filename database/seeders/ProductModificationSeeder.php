<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductModification;
use Illuminate\Database\Seeder;

class ProductModificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelProduct = Product::query()->where('slug', 'product_1')->first();

        Product::withoutEvents(function () use($modelProduct) {
            $modelProductModificationFirst = new ProductModification();
            $modelProductModificationFirst->product_id = $modelProduct->id;
            $modelProductModificationFirst->name = 'Глянец';
            $modelProductModificationFirst->price = 5000;
            $modelProductModificationFirst->price_type = ProductModification::PRICE_TYPE_ONE;
            $modelProductModificationFirst->save();
        });

        Product::withoutEvents(function () use($modelProduct) {
            $modelProductModificationSecond = new ProductModification();
            $modelProductModificationSecond->product_id = $modelProduct->id;
            $modelProductModificationSecond->name = 'Свинец';
            $modelProductModificationSecond->price = 10000;
            $modelProductModificationSecond->price_type = ProductModification::PRICE_TYPE_TWO;
            $modelProductModificationSecond->save();
        });

    }
}
