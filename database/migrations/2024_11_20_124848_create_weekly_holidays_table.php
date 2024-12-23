<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weekly_holidays', function (Blueprint $table) {
            $table->id();
            $table->json('days_of_week')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });

        DB::table('weekly_holidays')->insert([
            'days_of_week' => json_encode(['saturday', 'sunday']),
            'created_by' => '2',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_holidays');
    }
};
