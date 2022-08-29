<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("password");
            $table->tinyInteger("no_order_6months")->nullable();
            $table->string("full_address")->nullable();
            $table->string("state")->nullable();
            $table->tinyInteger("status");
            $table->bigInteger("user_id")->nullable();
            $table->dateTime("checked_out")->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
