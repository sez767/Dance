<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDancepartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dancepartners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('dance_style')->nullable();
            $table->text('living_place')->nullable();
            $table->text('age')->nullable();
            $table->text('experience')->nullable();
            $table->text('participation')->nullable();
            $table->text('about_yourself')->nullable();
            $table->text('number')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->integer('school_id')->nullable();
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
        Schema::dropIfExists('dancepartners');
    }
}
