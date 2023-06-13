<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('soal')->nullable();
            $table->text('jenis_soal')->nullable();
            $table->text('opsi')->nullable();
            $table->text('jumlah_opsi')->nullable();
            $table->text('validasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('date');
            $table->boolean('status');
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
        Schema::dropIfExists('survey_sessions');
    }
}
