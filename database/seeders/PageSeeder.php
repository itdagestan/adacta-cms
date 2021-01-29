<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelProductCategoryFirst = new Page();
        $modelProductCategoryFirst->name = 'Страница 1';
        $modelProductCategoryFirst->slug = 'page_1';
        $modelProductCategoryFirst->html = 'html 1';
        $modelProductCategoryFirst->is_active = true;
        $modelProductCategoryFirst->save();

        $modelProductCategorySecond = new Page();
        $modelProductCategorySecond->name = 'Страница 2';
        $modelProductCategorySecond->slug = 'page_2';
        $modelProductCategorySecond->html = 'html 2';
        $modelProductCategorySecond->is_active = true;
        $modelProductCategorySecond->save();
    }
}
