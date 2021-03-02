<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title', 30);
            $table->string('description', 100);
            $table->tinyInteger('featured')->default(0);    //1 - featured, 0 - non-featured
            $table->unsignedInteger('unit_id');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->string('photo', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('updated_by', 100)->default('');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('unit_id')->references('id')->on('units');
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
