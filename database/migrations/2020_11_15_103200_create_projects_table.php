<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('exercise_id')->nullable(false);
            $table->string('created_by')->nullable();
            $table->integer('program_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('projects', function($table) {
            $table->foreign('program_id') // foreign key column name.
            ->references('id') // parent table primary key.
            ->on('programs') // parent table name.
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
