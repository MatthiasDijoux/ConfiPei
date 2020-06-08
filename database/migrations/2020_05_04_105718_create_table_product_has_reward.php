<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductHasReward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_reward', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
            $table->unsignedBigInteger('id_reward');
            $table->foreign('id_reward')->references('id')->on('reward');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product_has_reward');
        Schema::enableForeignKeyConstraints();

    }
}
