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
            $table->integer('transcript_id')->nullable();
            $table->string('order_no')->nullable();
            $table->string('product')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_order_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');
            $table->text('payment_response')->nullable();
            $table->boolean('is_sketch')->default(0);
            $table->boolean('is_pdf')->default(0);
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
