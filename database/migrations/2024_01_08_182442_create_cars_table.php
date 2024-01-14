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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->string('gearbox');
            $table->string('fuel_type');
            $table->string('fuel_consumption_city');
            $table->string('fuel_consumption_urban');
            $table->string('fuel_consumption_combined');
            $table->string('price_1');
            $table->string('price_2');
            $table->string('price_3');
            $table->string('price_week');
            $table->string('price_month');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
