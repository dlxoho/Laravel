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
    Schema::create('product', function (Blueprint $table) {
      $table->id('product_id');
      $table->string('product_name', 45);
      $table->string('product_status', 45)->comment('판매예정, 판매중, 종료');
      $table->unsignedInteger('price')->default(0);
      $table->unsignedInteger('purchase_price')->default(0);
      $table->unsignedInteger('hits')->default(0);
      $table->timestamp('created_at')->usecurrent();

      $table->index('product_name');
      $table->index('product_status');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('product');
  }
};
