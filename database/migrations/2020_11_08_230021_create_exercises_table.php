<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('instruction')->nullable();
            $table->string('tags')->nullable();
            $table->string('photo_start')->nullable();
            $table->string('photo_end')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('exercises');
    }
}
