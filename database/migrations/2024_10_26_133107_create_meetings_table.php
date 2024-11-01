<?php

use App\Models\User;
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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->text('meeting_id')->comment('zoom meeting has an id');
            $table->text('meeting_uuid')->comment('zoom meeting has an uuid');
            $table->text('host_id')->comment('zoom meeting has host_id');
            $table->string('host_email')->comment('zoom meeting has host_email');
            $table->string('topic');
            $table->longText('description')->nullable()->comment('zoom meeting call agenda');
            $table->integer('type');
            $table->enum('meeting_type', ['zoom_meet', 'google_meet'])->default('zoom_meet');
            $table->string('status');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->string('timezone')->nullable();
            $table->longText('meeting_start_url');
            $table->longText('meeting_join_url');
            $table->string('password')->nullable();
            $table->string('encrypted_password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
