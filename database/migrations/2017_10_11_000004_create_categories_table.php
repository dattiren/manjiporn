<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      categories
     * Columns:
     *      id          - unsigned int
     *      name        - varchar(255)
     *      created_at  - timestamp
     *      updated_at  - timestamp
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('broad_category_id')
                        ->unsigned();
            $table->string('name', 255);
            $table->timestamps();
            $table->foreign('broad_category_id')
                    ->references('id')
                    ->on('broad_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
