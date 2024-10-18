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
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employers')->onDelete('cascade');
            $table->foreignId('price_plans_id')->constrained('price_plans')->onDelete('cascade');
            $table->unsignedBigInteger('employee_limit')->default(0);
            $table->unsignedBigInteger('client_limit')->default(0);
            $table->unsignedBigInteger('project_limit')->default(0);
            $table->boolean('free_plan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_plans');
    }
};
