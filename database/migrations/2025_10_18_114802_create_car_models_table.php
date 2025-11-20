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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->enum('transmission', ['automatic', 'manual']);
            $table->enum('fuelType', ['gasoline', 'diesel', 'electric', 'hybrid']);
            $table->string('engine');
            $table->integer('mileage');
            $table->decimal('price', 10, 2);
            $table->decimal('delivery_price', 10, 2);
            $table->json('features')->nullable();
            $table->boolean('isAvailable')->default(true);
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
