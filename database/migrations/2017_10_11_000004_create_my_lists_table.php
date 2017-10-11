<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyListsTable extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      my_lists
     * Columns:
     *      id          - unsigned int, auto_increment
     *      user_id     - unsigned mediumint, FK -> users:id
     *      movie_id    - unsigned mediumint, FK -> movies:id
     *      created_at  - timestamp
     *      updated_at  - timestamp
     * @return void
     */
    public function up()
    {
        Schema::create('my_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('user_id')
                    ->unsigned();
            $table->mediumInteger('movie_id')
                    ->unsigned();
            $table->timestamps();
        });
        Schema::table('my_lists', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            $table->foreign('movie_id')
                    ->references('id')
                    ->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_lists');
    }
}
