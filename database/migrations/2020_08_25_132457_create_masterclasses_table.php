<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterclasses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('path')->nullable();
            $table->text('address')->nullable();
            $table->text('contacts')->nullable();
            $table->text('age')->nullable();
            $table->text('kind')->nullable();
            $table->text('duration')->nullable();
            $table->text('price')->nullable();
            $table->text('recording')->nullable();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->text('school_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masterclasses');
    }
}
