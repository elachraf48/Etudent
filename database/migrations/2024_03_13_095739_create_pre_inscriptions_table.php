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
        Schema::create('pre_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEtudiant');
            $table->unsignedBigInteger('idSession');
            $table->string('AnneeUniversitaire', 10);
            $table->foreign('idSession')->references('id')->on('calendrier_sessions');
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
        Schema::dropIfExists('pre_inscriptions');
    }
};