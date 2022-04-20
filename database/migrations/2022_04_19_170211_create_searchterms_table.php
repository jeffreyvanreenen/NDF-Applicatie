<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchtermsTable extends Migration
{
    public function up()
    {
        Schema::create('searchterms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('searchterm')->nullable();
            $table->string('name');

            //

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('searchterms');
    }
}
