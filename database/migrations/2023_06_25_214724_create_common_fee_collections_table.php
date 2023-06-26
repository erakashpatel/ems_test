<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_fee_collections', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('trans_id')->nullable();
            $table->string('admno');
            $table->string('rollno');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('br_id');
            $table->string('academic_year');
            $table->string('financial_year');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('module_id')->references('id')->on('modules');
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
        Schema::dropIfExists('common_fee_collections');
    }
}
