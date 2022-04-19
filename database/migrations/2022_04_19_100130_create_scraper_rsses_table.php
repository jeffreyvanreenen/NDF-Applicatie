<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScraperRssesTable extends Migration
{
    public function up()
    {
        Schema::create('scraper_rsses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link');
            $table->string('omschrijving');
            $table->string('logo');
            $table->integer('actief')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scraper_rsses');
    }
}
