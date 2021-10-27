<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('unique_id')->unique();
            $table->string('acc_type')->nullable();
            $table->string('acc_id')->nullable();
            //$table->integer('ref_id')->index();
            //$table->unsignedBigInteger('ref_id');
           // $table->foreign('ref_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreignId('ref_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ref_id');
            $table->foreign('ref_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('users', function (Blueprint $table) {

        });
    }
}