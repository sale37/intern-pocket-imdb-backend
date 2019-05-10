<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchlistMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchlist_movie', function (Blueprint $table) {
            $table->integer('watchlist_id')->unsigned();
            $table->integer('movie_id')->unsigned();
            $table->foreign('watchlist_id')->references('id')->on('watchlists');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->boolean('watched')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watchlist_movie');
    }
}
