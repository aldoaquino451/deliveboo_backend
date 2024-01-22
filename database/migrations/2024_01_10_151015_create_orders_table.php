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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->integer('order_number')->unique()->unsigned();
      // $table->dateTime('date_delivery');
      $table->decimal('total_price', 6, 2);
      $table->string('name', 45);
      $table->string('lastname', 45);
      $table->string('email', 45);
      $table->string('address', 120);
      $table->string('phone_number', 14);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('orders');
  }
};
