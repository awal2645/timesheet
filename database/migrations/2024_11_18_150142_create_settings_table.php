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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('logo')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('copyright');
            $table->string('facebook_url')->nullable()->default('https://www.facebook.com/yourcompany');
            $table->string('instagram_url')->nullable()->default('https://www.instagram.com/yourcompany');
            $table->string('linkedin_url')->nullable()->default('https://www.linkedin.com/company/yourcompany');
            $table->string('twitter_url')->nullable()->default('https://www.twitter.com/yourcompany');
            $table->string('youtube_url')->nullable()->default('https://www.youtube.com/channel/yourcompany');
            $table->timestamps();
        });
        DB::table('settings')->insert([
            'email' => 'admin@mail.com',
            'phone' => '+123 456 7890',
            'address' => '1234 Main St, Anytown, USA',
            'logo' => 'images/logo-inv.png',
            'dark_logo' => 'images/dark_logo.png',
            'favicon' => 'images/logo_symbol.png',
            'copyright' => '&copy; 2024 Your Company Name',
            'facebook_url' => 'https://www.facebook.com/yourcompany',
            'instagram_url' => 'https://www.instagram.com/yourcompany',
            'linkedin_url' => 'https://www.linkedin.com/company/yourcompany',
            'twitter_url' => 'https://www.twitter.com/yourcompany',
            'youtube_url' => 'https://www.youtube.com/channel/yourcompany',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
