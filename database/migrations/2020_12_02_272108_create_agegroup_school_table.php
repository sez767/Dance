<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgegroupSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agegroup_school', function (Blueprint $table) {
            $table->id();
            $table->integer('agegroup_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->foreign('agegroup_id')->references('id')->on('agegroups')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agegroup_school');
    }
}
