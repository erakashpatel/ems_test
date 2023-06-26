<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeecollectiontypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feecollectiontype', function (Blueprint $table) {
            $table->id();
            $table->string('collectionhead')->nullable();
            $table->string('collectiondesc')->nullable();
            $table->unsignedBigInteger('br_id');
            $table->timestamps();

            $table->foreign('br_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feecollectiontype');
    }
}
