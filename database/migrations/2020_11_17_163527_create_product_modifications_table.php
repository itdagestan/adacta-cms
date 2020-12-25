<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductModificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_modifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('Товар');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->string('name')->comment('Название');
            $table->decimal('price', 10, 2)->comment('Цена');
            $table->enum('price_type', ['Цена за количество товара + цена за модификацию', 'Цена товара + цена модификации'])->comment('Тип подсчета стоимости');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_modifications');
    }
}
