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
            $table->string('no_sep')->nullable(false)->change();
            $table->date('birthdate');
            $table->enum('gender', ['F','M']);
            $table->string('medrec');
            $table->unsignedBigInteger('room_id')->unsigned();
            $table->string('no_order');
            $table->dateTime('date_in');
            $table->dateTime('date_out');
            $table->integer('status_submission');
            $table->integer('status_ver');
            $table->integer('status_val');
            $table->integer('status_grouping');
            $table->dateTime('time_submission');
            $table->dateTime('time_ver');
            $table->dateTime('time_val');
            $table->dateTime('time_grouping');
            $table->text('note_sub');
            $table->text('note_ver');
            $table->text('note_val');
            $table->text('note_grouping');
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
