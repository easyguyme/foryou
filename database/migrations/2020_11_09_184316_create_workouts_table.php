<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('program_id')->nullable();
            $table->boolean('status')->default(false);
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
        Schema::table('workouts', function($table) {
//            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id') // foreign key column name.
            ->references('id') // parent table primary key.
            ->on('users') // parent table name.
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
        Schema::dropIfExists('workouts');
    }
}
