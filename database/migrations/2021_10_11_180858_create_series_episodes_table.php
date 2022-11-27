<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('order');
            $table->string('name');
            $table->string('desc');
            $table->string('image');
            $table->string('url');
            $table->string('file');
            $table->integer('series_id');
            $table->integer('created_by');
            $table->integer('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_episodes');
    }
}
