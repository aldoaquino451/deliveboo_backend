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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->string('slug', 52);
            $table->decimal('price', 5, 2);
            $table->string('image')->nullable();
            $table->string('image_original_name')->nullable();
            $table->boolean('is_visible')->default(0);
            $table->boolean('is_vegan')->default(0);
            $table->text('ingredients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
