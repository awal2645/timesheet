<?php

use App\Models\Cms;
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
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image')->nullable();
            $table->string('approach_image')->nullable();
            $table->string('client_image1')->nullable();
            $table->string('client_image2')->nullable();
            $table->string('client_image3')->nullable();
            $table->string('client_image4')->nullable();
            $table->string('client_image5')->nullable();
            $table->timestamps();
        });
        Cms::insert([
            'banner_image' => 'images/home_banner.png',
            'approach_image' => 'images/approach.png',
            'client_image1' => 'images/client1.png',
            'client_image2' => 'images/client2.png',
            'client_image3' => 'images/client3.png',
            'client_image4' => 'images/client4.png',
            'client_image5' => 'images/client5.png',
        ]); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
