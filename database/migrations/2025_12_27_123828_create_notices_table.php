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
    Schema::create('notice', function (Blueprint $table) {
      $table->id('notice_id');
      $table->string('title',45);
      $table->longText('contents');
      $table->string('category',45);
      $table->string('status',45);
      $table->unsignedBigInteger('user_id');
      $table->unsignedInteger('hits')->default(0);
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

      $table->index('title');
      $table->index('category');
      $table->index('status');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('notice');
  }
};
