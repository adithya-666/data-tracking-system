<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_sep', 255);
            $table->bigInteger('no_pen', 255);
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['F','M']);
            $table->string('medrec')->nullable();
            $table->unsignedBigInteger('room_id')->unsigned()->nullable();
            $table->string('no_order')->nullable();
            $table->dateTime('date_in')->nullable();
            $table->dateTime('date_out')->nullable();
            $table->string('doctor')->nullable();
            $table->integer('status_submission')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('status_val')->nullable();
            $table->integer('status_grouping')->nullable();
            $table->dateTime('time_submission')->nullable();
            $table->dateTime('time_ver')->nullable();
            $table->dateTime('time_val')->nullable();
            $table->dateTime('time_grouping')->nullable();
            $table->string('insurance')->nullable();
            $table->text('note_sub')->nullable();
            $table->text('note_ver')->nullable();
            $table->text('note_val')->nullable();
            $table->text('note_grouping')->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
