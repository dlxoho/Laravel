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
    Schema::create('notice_comment', function (Blueprint $table) {
      $table->id('notice_comment_id');
      $table->unsignedBigInteger('notice_id');
      $table->unsignedBigInteger('user_id');
      $table->longText('comment');

      $table->index('notice_id');
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
    Schema::dropIfExists('notice_comment');
  }
};
