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
        Schema::create('screenshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('time_report_id')->constrained()->onDelete('cascade');
            $table->string('file_path');  // Path to the screenshot file
            $table->string('thumbnail_path')->nullable();  // Path to thumbnail for faster loading
            $table->timestamp('taken_at');  // When the screenshot was taken
            $table->json('window_details')->nullable();  // Active window info when screenshot was taken
            $table->string('activity_type')->nullable();  // Type of activity (productive/unproductive)
            $table->timestamps();
            
            // Index for faster retrieval
            $table->index(['user_id', 'time_report_id', 'taken_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenshots');
    }
}; 