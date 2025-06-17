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
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('description')->nullable()->after('task_name');
            $table->enum('task_type', ['task', 'story', 'bug', 'epic'])->default('task')->after('description');
            $table->json('labels')->nullable()->after('task_type');
            $table->decimal('estimated_hours', 8, 2)->nullable()->after('labels');
            $table->decimal('logged_hours', 8, 2)->default(0)->after('estimated_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['description', 'task_type', 'labels', 'estimated_hours', 'logged_hours']);
        });
    }
};
