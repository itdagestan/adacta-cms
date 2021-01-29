<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название');
            $table->string('slug')->unique()->comment('ЧПУ');
            $table->decimal('price_old', 10, 2)->nullable()->comment('Старая цена');
            $table->decimal('price_new', 10, 2)->nullable()->comment('Новая цена');
            $table->unsignedBigInteger('category_id')->comment('Категория');
            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories');
            $table->text('description')->nullable()->comment('Описание');
            $table->string('thumbnail_path')->nullable()->comment('Путь к превью');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_active')->default(true)->comment('Показывать на сайте');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
