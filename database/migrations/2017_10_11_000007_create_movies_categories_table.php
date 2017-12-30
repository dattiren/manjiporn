<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      movies_categories
     * Columns:
     *      id          - unsigned int, auto_increment
     *      movie_id    - unsigned mediumint
     *      category_id - unsigned smallint
     * @return void
     */
    public function up()
    {
        Schema::create('movies_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('movie_id')
                    ->unsigned();
            $table->smallInteger('category_id')
                    ->unsigned();
            $table->timestamps();
            $table->foreign('movie_id')
                    ->references('id')
                    ->on('movies');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_categories');
    }
}
