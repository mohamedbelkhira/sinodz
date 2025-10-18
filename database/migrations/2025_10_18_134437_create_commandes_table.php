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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('commandNumber')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_model_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed', 'purchased', 'in_shipping', 'arrived', 'delivered', 'cancelled'])->default('pending');
            $table->decimal('totalPrice', 10, 2);
            $table->decimal('deposit', 10, 2);
            $table->decimal('remainingAmount', 10, 2);
            $table->enum('paymentStatus', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->text('comments')->nullable();
            $table->foreignId('container_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('deliveredAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
