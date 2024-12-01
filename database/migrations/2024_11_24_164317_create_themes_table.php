<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color')->default('#04a9f5');
            $table->string('card_dark')->default('#1b232d');
            $table->string('card_light')->default('#fca311');
            $table->string('sidebar_dark')->default('#1d2630');
            $table->string('sidebar_light')->default('#ffffff');
            $table->string('header_dark')->default('#0f1215');
            $table->string('header_light')->default('#f8f9fa');
            $table->string('body_dark')->default('#131920');
            $table->string('body_light')->default('#f4f7fa');
            $table->string('font_family')->default('Inter');
            $table->string('text_light')->default('#090606');
            $table->string('text_dark')->default('#cfd3d0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
};