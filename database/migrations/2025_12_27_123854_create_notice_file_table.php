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
    Schema::create('notice_file', function (Blueprint $table) {
      $table->id('notice_file_id');
      $table->unsignedBigInteger('notice_id');
      $table->string('saved_file', 255);
      $table->string('origin_file', 100);
      $table->string('file_path', 255);
      $table->timestamp('created_at')->useCurrent();

      $table->index('notice_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('notice_file');
  }
};
