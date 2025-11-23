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
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->decimal('price', 13, 2);
            $table->decimal('discount', 13, 2)->default(0);
            $table->decimal('discount_price', 13, 2)->default(0);
            $table->string('SKU');
            $table->enum('stock_status', ['instock', 'outofstock'])->default('instock');
            $table->boolean('featured')->default(false);
            $table->boolean('flash_sales')->default(false);
            $table->boolean('popular')->default(false);
            $table->unsignedInteger('quantity')->default(10);
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
