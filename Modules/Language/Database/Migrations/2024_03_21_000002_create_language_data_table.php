<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageDataTable extends Migration
{
    public function up()
    {
        Schema::create('language_data', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_data');
    }
} 