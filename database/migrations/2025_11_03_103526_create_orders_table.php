<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('subtotal', 13, 2);
            $table->decimal('tax', 13, 2)->nullable()->default(0);
            $table->decimal('discount', 13, 2)->nullable()->default(0);
            $table->decimal('shipping_charge', 13, 2)->nullable()->default(0);
            $table->decimal('total', 13, 2);
            $table->enum('order_status',['pending','confirmed','processing','shipped','delivered'])->default('pending');
            $table->enum('payment_method',['cod','bkash'])->default('cod');
            $table->enum('payment_status',['pending','cancel','success'])->default('pending');
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('cancel_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
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
