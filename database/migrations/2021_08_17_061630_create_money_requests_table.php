<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('req_user_id');
            $table->foreign('req_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('req_amt', 10, 2)->nullable()->default('0.00');
            $table->string('req_to_acc')->nullable();
            $table->string('acc_unique_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('money_requests');
    }
}
