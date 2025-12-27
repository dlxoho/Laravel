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
    Schema::create('admin', function (Blueprint $table) {
      $table->id('admin_id');
      $table->string('admin_name', 45);
      $table->string('admin_email', 100)->unique();
      $table->string('admin_password', 255);
      $table->string('admin_phone', 20);
      $table->string('admin_level', 45)->default('1')->comment('1:일반, 2:매니저, 9:관리자');
      $table->timestamp('created_at')->useCurrent();

      $table->index('admin_name');
      $table->index('admin_email');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('admin');
  }
};
