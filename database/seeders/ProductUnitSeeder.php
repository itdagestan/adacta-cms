<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
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
            $modelProductUnitFirst = new ProductUnit();
            $modelProductUnitFirst->product_id = $modelProduct->id;
            $modelProductUnitFirst->count = 100;
            $modelProductUnitFirst->unit_type = 'шт.';
            $modelProductUnitFirst->price = 5000;
            $modelProductUnitFirst->save();
        });

        Product::withoutEvents(function () use($modelProduct) {
            $modelProductUnitSecond = new ProductUnit();
            $modelProductUnitSecond->product_id = $modelProduct->id;
            $modelProductUnitSecond->count = 100;
            $modelProductUnitSecond->unit_type = 'шт.';
            $modelProductUnitSecond->price = 10000;
            $modelProductUnitSecond->save();
        });

    }
}
