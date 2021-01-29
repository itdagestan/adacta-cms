<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductUnit;

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

        $modelProductUnitFirst = new ProductUnit();
        $modelProductUnitFirst->product_id = $modelProduct->id;
        $modelProductUnitFirst->count = 100;
        $modelProductUnitFirst->unit_type = 'шт.';
        $modelProductUnitFirst->price = 5000;
        $modelProductUnitFirst->save();

        $modelProductUnitSecond = new ProductUnit();
        $modelProductUnitSecond->product_id = $modelProduct->id;
        $modelProductUnitSecond->count = 100;
        $modelProductUnitSecond->unit_type = 'шт.';
        $modelProductUnitSecond->price = 10000;
        $modelProductUnitSecond->save();

    }
}
