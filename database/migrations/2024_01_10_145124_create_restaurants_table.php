<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('restaurants', function (Blueprint $table) {
      $table->id();
      $table->string('name', 45);
      $table->string('slug', 50)->unique();
      $table->string('email', 45)->unique();
      $table->string('password');
      $table->string('address', 120);
      $table->string('vat_number', 11)->unique();
      $table->string('image')->nullable();
      $table->text('description')->nullable();
      $table->time('opening_time');
      $table->time('closing_time');
      $table->string('day_off', 10)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('restaurants');
  }
};
