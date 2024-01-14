<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idModule');
            $table->unsignedBigInteger('idEtudiant');
            $table->enum('etat', ['I', 'NI']);
            $table->string('AnneeUniversitaire', 10);
            $table->unsignedBigInteger('idSESSION');
            $table->foreign('idModule')->references('id')->on('modules');
            $table->foreign('idSESSION')->references('id')->on('calendrier_sessions');
            $table->foreign('idEtudiant')->references('id')->on('etudiants');
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
        Schema::dropIfExists('detail_modules');
    }
};
