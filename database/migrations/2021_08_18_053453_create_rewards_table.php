<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trans_to');
            $table->foreign('trans_to')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('trans_by');
            $table->foreign('trans_by')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('reward_amt', 10, 2)->nullable()->default('0.00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
