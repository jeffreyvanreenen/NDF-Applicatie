<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('searchterms', function (Blueprint $table) {
            $table->integer('actief')->default(1);
            $table->string('telegram_chat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('searchterms', function (Blueprint $table) {
            $table->dropColumn('actief');
            $table->dropColumn('telegram_chat_id');
        });
    }
};
