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
    Schema::create('order', function (Blueprint $table) {
      $table->id('order_id');
      $table->unsignedBigInteger('user_id');
      $table->string('order_status')->comment('주문완료,결제완료,배송완료,주문취소');
      $table->unsignedInteger('total_price');
      $table->timestamp('created_at')->useCurrent();

      $table->index('user_id');
      $table->index('order_status');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order');
  }
};
