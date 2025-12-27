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
    Schema::create('order_history', function (Blueprint $table) {
      $table->id('order_history_id');
      $table->unsignedBigInteger('order_id');
      $table->timestamp('created_at')->useCurrent();

      $table->index('order_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_history');
  }
};
