<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserOrderRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //desac foreign / supp table 
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_has_order');

        Schema::table('order', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
        Schema::enableForeignKeyConstraints();

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //recreer les relations
        Schema::create('user_has_order', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('order');
        });
        Schema::disableForeignKeyConstraints();
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropIfExists('id_user');
        });
        Schema::enableForeignKeyConstraints();
    }
}
