<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('link')->nullable();
            $table->timestamp('pubDate')->nullable();
            $table->longText('description')->nullable();
            $table->string('source')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_articles');
    }
}
