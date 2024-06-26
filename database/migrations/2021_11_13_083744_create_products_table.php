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
            $table->timestamps();
            $table->unsignedBigInteger('category_id');
            $table->string('title'); 
            $table->string('name');
            $table->string('p_code')->nullable();
            $table->text('description');
            $table->double('price', 8, 2);
            $table->double('discount', 8, 2)->nullable();
            $table->string('image')->default('default.png');
            $table->tinyInteger('status');
            $table->tinyInteger('stock')->default(0);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
