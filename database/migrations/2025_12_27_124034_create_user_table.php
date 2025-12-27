<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user', function (Blueprint $table) {
      $table->id('user_id');
      $table->string('id',45);
      $table->string('name',45);
      $table->string('password', 255);
      $table->string('email')->unique();
      $table->string('phone')->unique();
      $table->string('address',45);
      $table->string('address2',45);
      $table->string('grade',45);

      $table->index('id');
      $table->index('name');
      $table->index('email');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user');
  }
};
