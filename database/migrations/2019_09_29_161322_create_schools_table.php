<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
//            $table->text('teachers')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->string('time_work')->nullable();
            $table->string('age_groups')->nullable();
            $table->string('price')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schools');
    }
}
