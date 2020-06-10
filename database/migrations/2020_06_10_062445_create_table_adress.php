<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse', function (Blueprint $table) {
            $table->id();
            $table->string('pays');
            $table->string('ville');
            $table->integer('code_postal');
            $table->string('adresse');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->unsignedBigInteger('id_adresse_livraison')->nullable();
            $table->foreign('id_adresse_livraison')->references('id')->on('adresse');
            $table->unsignedBigInteger('id_adresse_facturation')->nullable();
            $table->foreign('id_adresse_facturation')->references('id')->on('adresse');
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
        Schema::dropIfExists('adresse');
        Schema::enableForeignKeyConstraints();
    }
}
