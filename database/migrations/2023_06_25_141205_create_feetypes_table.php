<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feetypes', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('fee_category');
            $table->string('f_name');
            $table->unsignedBigInteger('Collection_id');
            $table->unsignedBigInteger('br_id');
            $table->unsignedBigInteger('Seq_id')->default(0);
            $table->string('Fee_type_ledger')->nullable();
            $table->unsignedBigInteger('Fee_headtype')->default(0);
            $table->timestamps();

            $table->foreign('fee_category')->references('id')->on('feecategory');
            $table->foreign('Collection_id')->references('id')->on('feecollectiontype');
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
        Schema::dropIfExists('feetypes');
    }
}
