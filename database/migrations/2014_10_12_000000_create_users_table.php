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
      $table->string('nama');
      $table->string('no_hp');
      $table->enum ('jk', ['P','L']);
      $table->string('alamat');
      $table->string('username');
      $table->string('password');
      $table->enum ('role', ['admin', 'kasir', 'owner']);
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
    }
}
