<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название');
            $table->string('slug')->comment('ЧПУ ссылка');
            $table->text('html')->comment('HTML верстка');
            $table->unsignedBigInteger('created_by')->comment('Пользователь создал');
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('updated_by')->comment('Пользователь обновил');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('pages');
    }
}
