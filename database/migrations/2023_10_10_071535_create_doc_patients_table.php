<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->unsigned();
            $table->string('doc_name');
            $table->string('doc_sub');
            $table->string('doc_user_sub');
            $table->dateTime('doc_time_sub');
            $table->string('doc_ver');
            $table->string('doc_user_ver');
            $table->dateTime('doc_time_ver');
            $table->string('doc_val');
            $table->string('doc_user_val');
            $table->dateTime('doc_time_val');
            $table->text('doc_note_sub');
            $table->text('doc_note_ver');
            $table->text('doc_note_val');
            $table->timestamps();



            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_patients');
    }
}
