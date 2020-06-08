<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductHasFruit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_fruit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
            $table->unsignedBigInteger('id_fruit');
            $table->foreign('id_fruit')->references('id')->on('fruit');
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
        Schema::dropIfExists('product_has_fruit');
        Schema::enableForeignKeyConstraints();

    }
}
