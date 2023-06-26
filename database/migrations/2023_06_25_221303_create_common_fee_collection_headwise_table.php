<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonFeeCollectionHeadwiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_fee_collection_headwise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('head_id');
            $table->string('head_name');
            $table->unsignedBigInteger('br_id');
            $table->decimal('amount', 8, 2);
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('receipt_id')->references('id')->on('common_fee_collections');
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
        Schema::dropIfExists('common_fee_collection_headwise');
    }
}
