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
        Schema::create('price_plans', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->text('description')->nullable();
            $table->float('price');
            $table->integer('employee_limit');
            $table->integer('client_limit');
            $table->integer('project_limit');
            $table->boolean('recommended')->default(false);
            $table->boolean('frontend_show')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_plans');
    }
};
