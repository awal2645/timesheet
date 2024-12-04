<?php

use App\Models\Employer;
use App\Models\User;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Employer::class)->constrained()->cascadeOnDelete();
            $table->string('employee_name')->nullable();
            $table->boolean('status')->default(true);
            $table->string('phone')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('employee_share')->nullable();
            $table->decimal('billing_rate', 10, 2)->nullable();
            $table->decimal('monthly_salary', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->string('total_leave')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
