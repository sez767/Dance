<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConquersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conquers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('address')->nullable();
            $table->text('contacts')->nullable();
            $table->text('organizers')->nullable();
            $table->text('contribution')->nullable();
            $table->text('conditions')->nullable();
            $table->date('date')->nullable();
            $table->text('price')->nullable();
            $table->text('program')->nullable();
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
        Schema::dropIfExists('conquers');
    }
}
