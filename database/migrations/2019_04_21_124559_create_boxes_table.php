<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('seller_id')->nullable();
            $table->date('arrived_at')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('locked')->default(false);
            $table->integer('amount')->default(0);
            $table->boolean('paid')->default(false);
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
        Schema::dropIfExists('boxes');
    }
}
