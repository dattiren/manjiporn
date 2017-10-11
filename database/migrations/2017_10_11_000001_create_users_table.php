<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Table:
     *      users
     * Columns:
     *      id          - unsigned int, auto_increment
     *      name        - varchar(255)
     *      email       - unique, varchar(255)
     *      password    - varchar(255)
     *      created_at  - timestamp
     *      updated_at  - timestamp
     *      deleted_at  - timestamp, nullable, default = null
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')
                    ->nullable()
                    ->default(null);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
