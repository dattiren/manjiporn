<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBroadCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Table:
     *      broad_categories
     * Columns:
     *      id          - unsigned medium int, auto_increment
     *      name        - varchar(255)
     *      created_at  - timestamp
     *      updated_at  - timestamp
     * @return void
     */
    public function up()
    {
        Schema::create('broad_categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 255);
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
        Schema::dropIfExists('broad_categories');
    }
}
