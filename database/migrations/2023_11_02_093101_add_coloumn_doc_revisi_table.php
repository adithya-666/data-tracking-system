<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnDocRevisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doc_patients', function (Blueprint $table) {
            $table->string('doc_note_revisi', 255)->nullable()->after('doc_note_val');
            $table->bigInteger('doc_revisi')->unsigned()->nullable()->after('doc_note_val');
            $table->dateTime('doc_time_revisi')->nullable()->after('doc_note_val');
            $table->bigInteger('doc_user_revisi')->unsigned()->nullable()->after('doc_note_val');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('=doc_ptients', function (Blueprint $table) {
            //
        });
    }
}
