<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maisons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nom_maison');
            $table->integer('prix');
            $table->string('description');
            $table->string('photo');
            $table->unsignedBigInteger('id_bailleur');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_bailleur')
                ->references('id')
                ->on('bailleurs')
                ->onDelete('cascade');
            $table->foreign('id_type')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maisons');
    }
}
