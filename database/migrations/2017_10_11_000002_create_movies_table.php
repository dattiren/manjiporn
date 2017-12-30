<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      movies
     * Columns:
     *      id              - unsigned int, auto_increment
     *      title           - varchar(255)
     *      url             - varchar(255)
     *      played_count    - unsigned int, default = 1
     *      created_at      - timestamp
     *      updated_at      - timestamp
     *      deleted_at      - timestamp, nullable, default = null
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('title', 255);
            $table->string('url', 255);
            $table->string('thumbnail_url', 255);
            $table->integer('played_count')
                    ->unsigned()
                    ->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')
                    ->nullable()
                    ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
