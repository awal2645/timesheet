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
        Schema::create('email_reminders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type'); // task_deadline, timesheet_submission, project_milestone, meeting, custom
            $table->string('frequency'); // once, daily, weekly, monthly
            $table->integer('reminder_days_before')->default(1); // Days before the event to send reminder
            $table->time('reminder_time')->default('09:00:00'); // Time to send reminder
            $table->json('recipients'); // Array of email addresses or user IDs
            $table->string('recipient_type')->default('specific'); // specific, role, department, all
            $table->unsignedBigInteger('template_id')->nullable();
            $table->json('conditions')->nullable(); // Conditions for when to trigger reminder
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sent_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('reminder_templates')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index(['type', 'is_active']);
            $table->index(['next_run_at', 'is_active']);
            $table->index('frequency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_reminders');
    }
};
