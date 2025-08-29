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
        Schema::table('time_reports', function (Blueprint $table) {
            // Activity tracking columns
            $table->dateTime('start_time')->nullable()->after('end_day');
            $table->dateTime('end_time')->nullable()->after('start_time');
            $table->integer('total_time')->default(0)->after('end_time'); // in seconds
            $table->integer('productive_time')->default(0)->after('total_time'); // in seconds
            $table->integer('idle_time')->default(0)->after('productive_time'); // in seconds
            $table->json('activity_data')->nullable()->after('idle_time'); // store application usage data
            $table->string('current_status')->default('offline')->after('activity_data'); // online/offline/idle
            $table->timestamp('last_activity')->nullable()->after('current_status');
            $table->float('productivity_score')->default(0)->after('last_activity'); // 0-100%
            $table->float('effectiveness_score')->default(0)->after('productivity_score'); // 0-100%
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_reports', function (Blueprint $table) {
            $table->dropColumn([
                'start_time',
                'end_time',
                'total_time',
                'productive_time',
                'idle_time',
                'activity_data',
                'current_status',
                'last_activity',
                'productivity_score',
                'effectiveness_score'
            ]);
        });
    }
};
