<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayHistories extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      play_histories
     * Columns:
     *      id          - unsigned int, auto_increment
     *      user_id     - unique, unsigned mediumint, FK -> users:id
     *      movie_id    - unique, unsigned mediumint, FK -> movies:id
     *      created_at  - timestamp
     *      updated_at  - timestamp
     * @return void
     */
    public function up()
    {
        Schema::create('play_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumIntegers('user_id')
                    ->unsigned();
            $table->mediumIntegers('movie_id')
                    ->unsigned();
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            $table->foreign('movie_id')
                    ->references('id')
                    ->on('movies');
            $table->unique(['user_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_histories');
    }
}
