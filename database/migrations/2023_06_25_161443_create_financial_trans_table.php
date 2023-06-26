<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_trans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('tranid')->nullable();
            $table->string('admno')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('crdr', ['C', 'D']);
            $table->date('tranDate');
            $table->string('acadYear')->nullable();
            $table->unsignedBigInteger('entrymode_id');
            $table->string('voucherno')->nullable();
            $table->unsignedBigInteger('br_id');
            $table->string('type_of_concession')->nullable();
            $table->timestamps();


           $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('entrymode_id')->references('id')->on('entrymodes');
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
        Schema::dropIfExists('financial_trans');
    }
}
