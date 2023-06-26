<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinancialTransDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_trans_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financial_tran_id');
            $table->unsignedBigInteger('module_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('head_id');
            $table->enum('crdr', ['C', 'D']);
            $table->unsignedBigInteger('br_id');
            $table->string('head_name');
            $table->timestamps();

            $table->foreign('financial_tran_id')->references('id')->on('financial_trans')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('head_id')->references('id')->on('feetypes');
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
       Schema::dropIfExists('financial_trans_details');
    }
}
