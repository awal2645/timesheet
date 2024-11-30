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
            $table->string('primary_color')->default('#8e02d9');
            $table->string('secondary_color')->default('#fca311');
            $table->string('sidebar_dark')->default('#0c0f12');
            $table->string('sidebar_light')->default('#ffffff');
            $table->string('header_dark')->default('#0f1215');
            $table->string('header_light')->default('#f8f9fa');
            $table->string('body_dark')->default('#0f1215');
            $table->string('body_light')->default('#f8f9fa');
            $table->string('font_family')->default('Inter');
            $table->string('text_light')->default('#090606');
            $table->string('text_dark')->default('#cfd3d0');


            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
};