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
    Schema::create('user_login_history', function (Blueprint $table) {
      $table->id('user_login_history_id');
      $table->unsignedBigInteger('user_id');
      $table->string('ip_address', 45);
      $table->timestamp('created_at')->useCurrent();

      $table->index('user_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_login_history');
  }
};
