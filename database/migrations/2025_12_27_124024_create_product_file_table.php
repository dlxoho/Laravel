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
    Schema::create('product_file', function (Blueprint $table) {
      $table->id('product_file_id');
      $table->unsignedBigInteger('product_id');
      $table->string('file_path',255);
      $table->string('saved_file',255);
      $table->string('origin_file',45);

      $table->index('product_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('product_file');
  }
};
