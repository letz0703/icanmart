<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode',50)->nullable();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->dateTimeTz('expire_date')->nullable();
            $table->string('channel')->nullable();
            $table->unsignedInteger('box_id')->nullable();
            $table->unsignedInteger('seller_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->integer('buy_price')->nullable();
            $table->integer('sell_price')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
