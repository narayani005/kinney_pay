<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('wallet_id');
            $table->string('trans_to_name')->nullable();
            $table->string('trans_to_id')->nullable();
            $table->string('trans_id')->unique();
            $table->string('score')->nullable();
            $table->string('trans_by_id')->nullable();
            $table->string('trans_by_name')->nullable();
            $table->string('trans_type')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
