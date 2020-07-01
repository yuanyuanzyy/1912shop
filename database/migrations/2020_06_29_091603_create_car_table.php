<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('car')) {
            Schema::create('car', function (Blueprint $table) {
                $table->increments('car_id');
                $table->integer('user_id');
                $table->integer('goods_id');
                $table->integer('buy_num');
                $table->string('goods_name');
                $table->string('goods_img');
                $table->string('goods_price');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car');
    }
}
