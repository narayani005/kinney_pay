<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('country_code')->nullable();
            $table->string('mobile')->unique();
            $table->string('profile_img')->default('default.png');
            $table->string('qrcode')->nullable();
            $table->enum('is_admin', ['0','1'])->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('trans_type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
}
