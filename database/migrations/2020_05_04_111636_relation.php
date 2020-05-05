<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relation extends Migration
{
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producer');
            $table->foreign('id_producer')->references('id')->on('producer');
        });

       

        Schema::table('user', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id')->on('role');
        });

        Schema::table('product_has_reward', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
            $table->unsignedBigInteger('id_reward');
            $table->foreign('id_reward')->references('id')->on('reward');
        });

        Schema::table('product_has_fruit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
            $table->unsignedBigInteger('id_fruit');
            $table->foreign('id_fruit')->references('id')->on('fruit');
        });

        Schema::table('order_has_product', function (Blueprint $table) {
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('order');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
        });

        Schema::table('user_has_order', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('product', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['id_producer']);
            $table->dropIfExists('id_producer');
        });


        Schema::table('user', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['id_role']);
            $table->dropIfExists('id_role');
        });

        Schema::table('product_has_reward', function (Blueprint $table) {
            $table->dropForeign(['id_product']);
            $table->dropIfExists('id_product');
            $table->dropForeign(['id_reward']);
            $table->dropIfExists('id_reward');
        });

        Schema::table('product_has_fruit', function (Blueprint $table) {
            $table->dropForeign(['id_product']);
            $table->dropIfExists('id_product');
            $table->dropForeign(['fruit_name']);
            $table->dropIfExists('fruit_name');
        });

        Schema::table('order_has_product', function (Blueprint $table) {
            $table->dropForeign(['id_order']);
            $table->dropIfExists('id_order');
            $table->dropForeign(['id_product']);
            $table->dropIfExists('id_product');
        });

        Schema::table('user_has_order', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropIfExists('id_user');
            $table->dropForeign(['id_order']);
            $table->dropIfExists('id_order');
        });
        
    }
}
